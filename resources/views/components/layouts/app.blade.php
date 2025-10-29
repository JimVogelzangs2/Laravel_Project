<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Shop' }}</title>
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 0; }
        header { background: #111827; color: #fff; padding: 12px 16px; display:flex; align-items:center; justify-content:space-between; }
        header a { color: #fff; text-decoration: none; margin-right: 12px; }
        main { max-width: 960px; margin: 20px auto; padding: 0 16px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 16px; }
        .card { border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px; }
        .price { font-weight: bold; }
        .btn { display:inline-block; background:#2563eb; color:#fff; padding:8px 12px; border:none; border-radius:6px; cursor:pointer; text-decoration:none; }
        .btn.secondary { background: #6b7280; }
        .flash { background:#ecfccb; border:1px solid #84cc16; padding:8px 12px; border-radius:6px; margin-bottom:12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border-bottom: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        .right { text-align: right; }
    </style>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @endif
</head>
<body>
<header>
    <div>
        <a href="/">Home</a>
        <a href="{{ route('shop.index') }}">Shop</a>
        <a href="{{ route('shop.cart') }}">Winkelwagen ({{ collect(session('cart', []))->sum() }})</a>
    </div>
    <div>Basic Electronic Webshop</div>
</header>
<main>
    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif
    {{ $slot }}
</main>
</body>
</html>


