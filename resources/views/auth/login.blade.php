<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/css/app.css', 'resources/js/login.js'])

</head>
<body class="min-h-screen flex flex-col">

<header class=" p-4 flex justify-end ">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12">
</header>

<main class="flex-grow flex items-center justify-center p-4">

    <div class="blob-layer">
        <div class="blob"></div>
    </div>

    <form id="authForm"
          method="POST"
          action="{{ route('login') }}"
          enctype="multipart/form-data"
          data-login-url="{{ route('login') }}"
          data-register-url="{{ route('register') }}"
          class="w-full max-w-md bg-white/30 backdrop-blur-md border border-white/30 p-6 rounded-lg shadow-lg space-y-4 relative z-10 overflow-hidden">


    @csrf
        <h1 id="formTitle" class="text-center text-xl font-semibold">Login</h1>

        <div id="formFields">
            <!-- Initial Login Fields -->
            <input type="email" name="email" placeholder="Email" required class="w-full p-3 border rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded">
        </div>

        <button type="submit" id="submitBtn" class="w-full bg-[#00E701]  py-2 rounded hover:bg-[#00B401]">
            Login
        </button>

        <div class="flex justify-between mt-2">
            <a href="#" id="formLink" class="hover:text-gray-300 inline-block">Register</a>
        </div>
    </form>


</main>



</body>
</html>
