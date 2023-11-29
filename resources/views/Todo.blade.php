<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 p-4">
    <div class="lg:w-2/4 mx-auto py-8 px-6 bg-white rounded-xl">
        <div class="flex justify-end space-x-4"> <!-- Added space-x-4 for spacing between buttons -->
            <!-- Logout button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="py-2 px-4 bg-red-500 text-white rounded-xl hover:bg-red-600 focus:outline-none focus:ring focus:border-blue-300">
                    Logout
                </button>
            </form>
        </div>

        <h1 class="font-bold text-5xl text-center mb-8">Laravel + Tailwind</h1>

        <div class="mb-6">
            <form class="flex flex-col space-y-4" method="POST" action="{{ url('/') }}">
                @csrf
                <input type="text" name="title" placeholder="The todo title" class="py-3 px-4 bg-gray-100 rounded-xl">
                <textarea name="description" placeholder="The todo description"
                    class="py-3 px-4 bg-gray-100 rounded-xl"></textarea>
                <button class="w-28 py-4 px-8 bg-green-500 text-white rounded-xl">Add</button>
            </form>
        </div>

        <hr>

        <div class="mt-2">
            @foreach ($todos as $todo)
            <div class="py-4 flex items-center border-b border-gray-300 px-3 {{ $todo->isDone ? 'bg-green-200' : '' }}">
                <div class="flex-1 pr-8">
                    <h3 class="text-lg font-semibold">{{ $todo->title }}</h3>
                    <p class="text-gray-500">{{ $todo->description }}</p>
                </div>

                <div class="flex space-x-3">
      
                    <button class="py-2 px-2 bg-blue-500 text-white rounded-xl"
                        onclick="document.getElementById('editForm-{{ $todo->id }}').classList.remove('hidden')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 20h9M16 4l-8 8-4-4v10h10l-4-4 8-8" />
                        </svg>
                    </button>

              
                    <form method="POST" action="{{ url('/todos/' . $todo->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="py-2 px-2 {{ $todo->isDone ? 'bg-blue-500' : 'bg-green-500' }} text-white rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="{{ $todo->isDone ? 'M4.5 12.75l6 6 9-13.5' : 'M4.5 12.75l6 6 9-13.5' }}" />
                            </svg>
                        </button>
                    </form>

           
                    <form method="POST" action="{{ url('/todos/' . $todo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="py-2 px-2 bg-red-500 text-white rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="mt-2 ml-4">
                    <p>Added at: {{ $todo->created_at->format('Y-m-d H:i') }}</p>
                    @if ($todo->isDone)
                    <p>Completed at:
                        {{
                        is_string($todo->completed_at) ?
                        \Carbon\Carbon::parse($todo->completed_at)->format('Y-m-d H:i') :
                        ($todo->completed_at ? $todo->completed_at->format('Y-m-d H:i') : 'Not available')
                        }}
                    </p>
                    @endif
                </div>

            </div>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>