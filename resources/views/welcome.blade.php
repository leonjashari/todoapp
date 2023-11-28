
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'To-Do App') }}</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
       body {
           margin: 0;
           padding: 0;
           font-family: 'Nunito', sans-serif;
       }

       .hero {
           background-color: #f2f2f2;
           background-image: url('{{ asset('images/hero.jpg') }}');
           height: 100vh;
           background-size: cover;
           background-position: center;
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
       }

       .hero h1 {
           font-size: 5rem;
           color: black;
           text-align: center;
       }

       .hero p {
           font-size: 1.5rem;
           color: black;
           text-align: center;
       }

       .button-container {
           position: absolute;
           top: 20px;
           right: 20px;
           display: flex;
           gap: 10px;
       }

       .button {
           background-color: #28a745;
           color: white;
           padding: 10px 20px;
           border: none;
           border-radius: 5px;
           cursor: pointer;
       }

       .button:hover {
           background-color: #1e7e34;
       }
    </style>
</head>
<body>
    <div class="hero">
        <h1>Welcome to To-Do App</h1>
        <p>Organize your tasks and stay on top of your goals with our easy-to-use to-do app.</p>
        <div class="button-container">
            <a href="{{ route('login') }}" class="button">Log In</a>
            <a href="/register" class="button">Register</a>
        </div>
    </div>
</body>
</html>
