<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCM Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>

<body  class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('products.index') }}">OCM Test</a>
    </div>
</nav>

<main class="flex-grow-1 container mt-4">
    @yield('content')
</main>

<footer class="bg-light py-4 mt-5 custom-footer">
    <div class="container text-center">
        <p class="mb-0">Basel Kaffoura, Copy @ {{ date('Y') }}</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
