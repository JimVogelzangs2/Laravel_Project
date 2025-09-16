<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel project</title>
</head>
<body>
    <h1>WELKOM BIJ MIJN LARAVEL project</h1>
    <p><a href="{{ route('shop.index') }}">Ga naar de shop</a></p>
</body>
</html>