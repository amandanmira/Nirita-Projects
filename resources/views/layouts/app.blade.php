<!DOCTYPE html>
<html>
<head>
    <title>Template Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('template_pesan.index') }}">Management Template Pesan WA</a>
        </div>
    </nav>

    @yield('content')
</body>
</html>
