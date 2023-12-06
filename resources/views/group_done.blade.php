<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Completed Tasks - Group {{ $group }}</title>

    <!-- Fonts and stylesheets -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100 p-4">
    <!-- Header -->
    <div class="flex justify-between items-center border-b border-gray-200 py-4">
        <!-- User info -->
        <div class="flex items-center">
            <p class="font-bold text-lg mr-4">Welcome, {{ Auth::user()->name }}</p>
        </div>

        <!-- Navigation links in the middle -->
        <div class="flex-grow text-center">
            <a href="{{ url('/todos') }}"
                class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl">To Do</a>
            <a href="{{ route('todos.done') }}"
                class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl">Done</a>
            <a href="{{ route('todos.urgent') }}"
                class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl">Urgent</a>
        </div>

        <!-- Space between Logout and Search -->
        <div class="flex-grow"></div>

        <!-- Search form on the right -->
        <form method="GET" action="{{ route('todos.index') }}">
            <input type="text" name="search" placeholder="Search Tasks"
                class="px-4 py-2 rounded-xl border-gray-300 focus:border-blue-500" />
            <button type="submit" class="px-4 py-2 bg-gray-700 text-white rounded-xl">
                Search
            </button>
        </form>

        <!-- Add some space between Logout and Search -->
        <div class="w-4"></div>

        <!-- Logout button on the right -->
        <div class="flex items-center space-x-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex">
        <!-- List of Groups (moved to the very left) -->
        <div class="w-1/6 bg-gray-200 p-4 rounded-xl">
            <h3 class="font-bold text-lg mb-4">Task Groups</h3>
            <ul id="taskGroups" class="space-y-2 font-bold">
                <li>
                    <a href="{{ route('todos.urgent') }}"
                        class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl">Urgent</a>
                </li>
                @for ($i = 1; $i <= 4; $i++)
                    <li>
                        <a href="{{ route('todos.group', ['group' => $i]) }}">
                            Group {{ $i }}
                        </a>
                    </li>
                @endfor
                <li>
                    <a href="#">
                        Add Group
                    </a>
                </li>
            </ul>
        </div>

        <!-- Completed Task List for Specific Group -->
        <div class="flex-1 lg:w-4/5 p-4 overflow-auto">
            <div class="mb-4">
                <h2 class="font-bold text-2xl">Completed Tasks - Group {{ $group }}</h2>
            </div>
            <!-- Completed Task List Container with Limited Height -->
            <div class="flex flex-col h-screen overflow-hidden">
                <!-- Completed Task List Content -->
                <div class="flex-1 overflow-y-scroll">
                    <div class="space-y-4">
                        @forelse ($completedTodos as $completedTask)
                            <div
                                class="flex items-center border-b border-gray-300 py-4 px-3 bg-green-200">
                                <!-- Completed Task Details -->
                                <div class="flex-1 pr-8">
                                    <h3 class="text-lg font-semibold">{{ $completedTask->title }}</h3>
                                    <p class="text-gray-500">{{ $completedTask->description }}</p>
                                </div>
                                <!-- Task Actions -->
                                <div class="flex space-x-4">
                                    <!-- View Task Details -->
                                    <a href="{{ route('todos.show', ['todo' => $completedTask->id]) }}"
                                        class="text-blue-500 hover:underline">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">No completed tasks in this group.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>