<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Ecommerce')</title>

    @vite(['resources/css/app.css','resources/js/app.js']) 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    @inertiaHead

</head>
<body>
    @inertia
    @include('frontend.components.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.components.footer')

</body>
</html>