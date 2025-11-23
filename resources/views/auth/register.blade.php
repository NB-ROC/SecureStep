<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex flex-col">

<!-- Header / navbar -->
<header class=" shadow p-4 flex justify-between">
    <h1 class="text-center text-xl font-semibold">Register</h1>
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
        <h1 class="text-center text-xl  font-semibold">Login</h1>
        <input type="text" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required
               class="w-full p-3 border rounded">
        <input type="text" name="middlename" placeholder="Middle Name" value="{{ old('middlename') }}"
               class="w-full p-3 border rounded">
        <input type="text" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}" required
               class="w-full p-3 border rounded">
        <input type="file" name="profilepicture" class="w-full p-3 border rounded">
        <input type="text" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}"
               class="w-full p-3 border rounded">

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
               class="w-full p-3 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
               class="w-full p-3 border rounded">

        <button type="submit" class="w-full  bg-[#00E701] py-2 rounded hover:bg-[#00B401]">register</button>


        <a href="{{ route('login') }}" class=" hover:text-gray-300 inline-block mt-2">login</a>
    </form>
</main>

</body>
</html>
