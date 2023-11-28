<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-gray-800">Login</h1>

        <form action="{{ route('login') }}" method="post" class="mt-4">
            @csrf

            <div class="mb-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
                <input type="email" class="form-input w-full rounded-md shadow-sm border-gray-300 @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" class="form-input w-full rounded-md shadow-sm border-gray-300 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">Login</button>
        </form>

        <p class="mt-3 text-sm text-gray-600">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    </div>
</body>

</html>
