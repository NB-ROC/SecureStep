<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col bg-gray-50">

<!-- Header / navbar -->
<header class=" shadow p-4 flex justify-between">
    <h1 class="text-center text-xl font-semibold">Register</h1>
    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-12">
</header>

<main class="flex-grow flex items-center justify-center p-4">
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="w-full max-w-md bg-white p-6 rounded-lg shadow space-y-4">
        @csrf
        <h1 class="text-center text-xl font-semibold">Register</h1>

        <input type="text" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required class="w-full p-3 border rounded">
        <input type="text" name="middlename" placeholder="Middle Name" value="{{ old('middlename') }}" class="w-full p-3 border rounded">
        <input type="text" name="lastname" placeholder="Last Name" value="{{ old('lastname') }}" required class="w-full p-3 border rounded">
        <input type="file" name="profilepicture" class="w-full p-3 border rounded">
        <input type="text" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" class="w-full p-3 border rounded">

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full p-3 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-3 border rounded">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full p-3 border rounded">

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Register</button>

        <div class="text-center pt-4 border-t">
            <a href="{{ route('login') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 inline-block mt-2">Already logged in?</a>
        </div>
    </form>

</main>

</body>
</html>
