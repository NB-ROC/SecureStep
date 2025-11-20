<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])

</head>
<body class="min-h-screen flex flex-col bg-gray-50">

<header class=" shadow p-4 flex justify-between">
    <h1 class="text-center text-xl font-semibold">Login</h1>
    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12">
</header>

<main class="flex-grow flex items-center justify-center p-4 ">


    <div class="absolute -z-10 w-160 h-160 bg-gradient-to-r from-[#10FF11] to-[#1070FF] opacity-30 blur-3xl"
         style="border-radius: 45% 55% 60% 40% / 50% 60% 40% 50%;">
    </div>



    </div>
    <form method="POST" action="{{ route('login') }}"
          class="w-full max-w-md bg-white/30 backdrop-blur-md border border-white/30 p-6 rounded-lg shadow-lg space-y-4 relative z-10">
        @csrf
        <h1 class="text-center text-xl text-black font-semibold">Login</h1>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full p-3 text-black border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 text-black border rounded">


        <button type="submit" class="w-full  bg-indigo-600 text-black py-2 rounded hover:bg-indigo-700">Login</button>


            <a href="{{ route('register') }}" class="text-black hover:text-gray-300 inline-block mt-2">Register</a>
    </form>
</main>

</body>
</html>
