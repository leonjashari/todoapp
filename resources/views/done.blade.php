<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Done Tasks</title>
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
            <a href="{{ url('/todos') }}" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl">To Do</a>
            <a href="{{ route('todos.done') }}" class="px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-xl font-bold">Done</a>
        </div>
    </div>

    <!-- Completed Task List for All Groups -->
    <div class="flex-1 lg:w-4/5 p-4 overflow-auto">
        <div class="mb-4">
            <h2 class="font-bold text-2xl">Done Tasks</h2>
        </div>

        <div class="space-y-4">
            @forelse ($completedTodos as $completedTodo)
                <div class="flex items-center border-b border-gray-300 py-4 px-3 bg-green-200">
                    <!-- Completed Task Details -->
                    <div class="w-1/3">
                        <span class="font-bold">{{ $completedTodo->title }}</span>
                    </div>

                    <div class="w-1/3">
                        {{ $completedTodo->description }}
                    </div>

                    <p> Group{{ $completedTodo->group }}</p>

                    <div class="w-1/3 text-right">
                        <a href="{{ route('todos.show', $completedTodo->id) }}" class="text-gray-500 hover:underline">Details</a>
                    </div>
                </div>
            @empty
                <p>No completed tasks available.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
