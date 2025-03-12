<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IEEE with Tailwind</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-blue-600">Welcome to IEEE CS Website</h1>
        <h1 class="text-3xl font-bold underline text-red-600">
            Hello world!
          </h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Click Me
        </button>
        <form action={{route('logout')}} method="post">
            {{-- <button></button> --}}
            @csrf
            <input type="submit" value="logout">
        </form>
    </div>
</body>
</html>
