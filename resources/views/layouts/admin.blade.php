<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin Dashboard')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-50/50 font-sans text-slate-800 antialiased">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    <div class="flex-1 flex flex-col min-w-0">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        <main class="p-8 flex-1">

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>