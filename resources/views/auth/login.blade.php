<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

<header class="bg-gray-100 shadow p-4 flex justify-center">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12">
</header>

<main class="flex-grow flex items-center justify-center p-4">
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-md bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <h1 class="text-center text-xl font-semibold">Login</h1>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full p-3 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded">

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="remember" class="rounded border-gray-300">
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="underline">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Login</button>

        <div class="text-center pt-4 border-t">
            <a href="{{ route('register') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 inline-block mt-2">Register</a>
        </div>
    </form>
</main>

</body>
</html>
