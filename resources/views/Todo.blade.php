<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Todo App</title>

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
        class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl {{ !request()->get('group') ? 'font-bold' : '' }}">To
        Do</a>
    <a href="{{ route('todos.done') }}"
        class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl {{ request()->get('group') === 'done' ? 'font-bold' : '' }}">Done</a>
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
            <a href="{{ route('todos.urgent') }}" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl font-bold">
                Urgent
            </a>
        </li>
        @for ($i = 1; $i <= 4; $i++)
            <li>
                <a href="{{ route('todos.group', ['group' => $i]) }}">
                    Group {{ $i }}
                </a>
                <!-- Add a link to completed tasks for each group -->
                <a href="{{ route('todos.group.done', ['group' => $i]) }}" class="text-blue-500 hover:underline ml-2">
                    (Completed)
                </a>
            </li>
        @endfor
        <li>
            <!-- Add Group Form -->
            <form method="POST" action="{{ route('todos.addGroup') }}" class="flex items-center space-x-2">
                @csrf
                <input type="text" name="newGroup" placeholder="New Group" class="w-32 py-1 px-2 rounded-md border border-gray-300">
                <button type="submit" class="py-1 px-2 bg-blue-500 text-white rounded-md">Add</button>
            </form>
        </li>
    </ul>
</div>

        <!-- Task List -->
        <div class="flex-1 lg:w-4/5 p-4 overflow-auto">
            <div class="mb-4">
                <h2 class="font-bold text-2xl">Tasks</h2>
            </div>
            <!-- Task List Container with Limited Height -->
            <div class="flex flex-col h-screen overflow-hidden">
                <!-- Task List Content -->
                <div class="flex-1 overflow-y-scroll">
                    <div class="space-y-4">
                        @forelse ($todos as $todo)
                            @if (!$todo->completed_at)
                                <div
                                    class="flex items-center border-b border-gray-300 py-4 px-3 {{ $todo->isDone ? 'bg-green-200' : '' }}">
                                    <!-- Mark as Done Button -->
                                    <form method="POST" action="{{ route('todos.markAsDone', $todo->id) }}"
                                        class="mr-4">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex items-center focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-6 h-6 text-green-500">
                                                <circle cx="12" cy="12" r="10" stroke-width="2" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Task Details -->
                                    <div class="flex-1 pr-8">
                                        <h3 class="text-lg font-semibold">{{ $todo->title }}</h3>
                                        <p class="text-gray-500">{{ $todo->description }}</p>
                                        <p>(Group {{ $todo->group }})</p>
                                    </div>

                                    <!-- Task Action Buttons -->
                                    <div class="flex space-x-3">
                                        <!-- Edit Task Button -->
                                        <button class="py-2 px-2 bg-blue-500 text-white rounded-xl"
                                            onclick="toggleEditForm({{ $todo->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 20h9M16 4l-8 8-4-4v10h10l-4-4 8-8" />
                                            </svg>
                                        </button>

                                        <!-- Edit Task Form -->
                                        <div id="editForm-{{ $todo->id }}" class="hidden">
                                            <form method="POST" action="{{ url('/todos/' . $todo->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="text" name="title" value="{{ $todo->title }}"
                                                    class="py-3 px-4 bg-gray-100 rounded-xl">
                                                <textarea name="description"
                                                    class="py-3 px-4 bg-gray-100 rounded-xl">{{ $todo->description }}</textarea>
                                                <button type="submit"
                                                    class="w-28 py-4 px-8 bg-green-500 text-white rounded-xl">Update</button>
                                            </form>
                                        </div>

                                        <!-- Delete Task Button -->
                                        <form method="POST" action="{{ url('/todos/' . $todo->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="py-2 px-2 bg-red-500 text-white rounded-xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.02.165
                                                        m-1.02-.165l-2.758 7.144m0 0l-2.774-7.144c.342-.052.682-.107 1.02-.165l-1.02.165
                                                        m2.758-7.144l2.774 7.144" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <p class="text-gray-500">No tasks found.</p>
                        @endforelse
                    </div>
                </div>
                <!-- Separator Line -->
                <hr class="my-2 border-t-2 border-gray-300 mx-auto">

                <!-- Add New Task Form -->
                <div class="flex-1 lg:w-4/5 p-4 overflow-auto">
                    <div id="taskForm" class="pb-4">
                        <form method="POST" action="{{ url('/') }}" class="flex flex-col space-x-4">
                            @csrf
                            <!-- Task details input fields -->
                            <label for="title" class="font-bold">Title:</label>
                            <div class="flex items-center space-x-4">
                                <input type="text" name="title" id="title" placeholder="New Task Title"
                                    class="flex-1 px-4 py-2 border rounded-xl" required>
                                <!-- Add Task Button -->
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Task details input fields -->
                            <label for="description" class="font-bold">Description:</label>
                            <textarea name="description" id="description" class="px-4 py-2 border rounded-xl"
                                required></textarea>

                            <!-- Additional task options -->
                            <div class="flex items-center space-x-4">
                                <label for="urgent" class="font-bold">Urgent:</label>
                                <input type="checkbox" name="urgent" value="1">

                                <label for="group" class="font-bold">Select Group:</label>
                                <select name="group" id="group" class="px-4 py-2 border rounded-xl" required>
                                    @for ($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}">Group {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function toggleEditForm(id) {
            document.getElementById('editForm-' + id).classList.toggle('hidden');
        }

        function toggleTaskForm() {
            document.getElementById('taskForm').classList.toggle('hidden');
        }
    </script>
</body>

</html>
