<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h1 class="text-2xl font-bold mb-6">Login</h1>

            <form action="{{ route('login') }}" method="post">
                @csrf

                @if ($errors->has('message'))
                    <div class="mb-3">
                        <span class="text-red-500">{{ $errors->first('message') }}</span>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email address</label>
                    <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter email address" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter password" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Login</button>
            </form>

            <p class="mt-3 text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
        </div>
    </div>
</body>

</html>
