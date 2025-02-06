<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #2c3e50, #4ca1af); /* Professional blue-gray gradient */
            color: white;
        }
        .container {
            margin-top:100px;
            margin-left: auto;
margin-right: auto;

            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 30px;
            width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .btn {
            display: block;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            transition: 0.3s ease;
            width: 100%;
            margin-top: 10px;
            text-decoration: none; /* Removes underline */
        }
        .btn-login {
            background-color: #3498db;
            color: white;
            border: none;
        }
        .btn-login:hover {
            background-color: #2980b9;
        }
        .btn-register {
            background-color: #2ecc71;
            color: white;
            border: none;
        }
        .btn-register:hover {
            background-color: #27ae60;
        }
        .features {
            margin-top: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }
        .features h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .features ul {
            list-style: none;
            padding: 0;
        }
        .features li {
            padding: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body class="antialiased flex items-center justify-center min-h-screen">

    <div class="container">
        <!-- Project Name -->
        <h1 class="text-3xl font-bold mb-6">
            {{ config('app.name', 'Task Management System') }}
        </h1>

        <!-- Task Management Features -->
        <div class="features">
            <h2>What Can You Do?</h2>
            <ul>
                <li>✅ Add New Tasks</li>
                <li>✅ Mark Tasks as Completed</li>
                <li>✅ View Pending Tasks</li>
            </ul>
        </div>

        <!-- Login & Register Buttons -->
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
    </div>

</body>
</html>
