<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo.png') }}" />
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @inertiaHead
</head>
<body class="hold-transition sidebar-mini">

    @inertia

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
