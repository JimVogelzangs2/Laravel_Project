@extends('layouts.app')

@section('title', 'Basic Electronic Webshop')

@section('content')
<style>
    .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-align: center; padding: 80px 20px; }
    .hero h1 { font-size: 3rem; margin-bottom: 1rem; font-weight: 300; }
    .hero p { font-size: 1.2rem; margin-bottom: 2rem; opacity: 0.9; }
    .btn { display: inline-block; background: #ff6b6b; color: white; padding: 15px 30px; text-decoration: none; border-radius: 50px; font-weight: 600; transition: transform 0.3s ease; }
    .btn:hover { transform: translateY(-2px); }

    .features { padding: 60px 20px; max-width: 1200px; margin: 0 auto; }
    .features h2 { text-align: center; margin-bottom: 3rem; font-size: 2.5rem; color: #2c3e50; }
    .feature-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
    .feature { text-align: center; padding: 2rem; }
    .feature-icon { font-size: 3rem; margin-bottom: 1rem; }
    .feature h3 { margin-bottom: 1rem; color: #34495e; }

    .cta { background: #f8f9fa; text-align: center; padding: 60px 20px; }
    .cta h2 { margin-bottom: 1rem; color: #2c3e50; }
    .cta p { margin-bottom: 2rem; color: #7f8c8d; }
</style>
    <section class="hero">
        <h1>Welkom bij Basic Electronic</h1>
        <p>Ontdek onze collectie van kwaliteitsvolle elektronische producten</p>
        @if(Auth::check())
            <a href="{{ route('shop.index') }}" class="btn">Bekijk onze producten</a>
        @else
            <a href="{{ route('login') }}" class="btn">Login/Register</a>
            <br><br>
            <a href="{{ route('login') }}" style="color: white; text-decoration: underline; font-size: 0.9rem;">Al een account? Login hier</a>
        @endif
    </section>
    
    <section class="features">
        <h2>Waarom kiezen voor ons?</h2>
        <div class="feature-grid">
            <div class="feature">
                <div class="feature-icon">⚡</div>
                <h3>Snelle levering</h3>
                <p>Bestellingen worden binnen 24 uur verzonden</p>
            </div>
            <div class="feature">
                <div class="feature-icon">🛡️</div>
                <h3>2 jaar garantie</h3>
                <p>Alle producten komen met volledige garantie</p>
            </div>
            <div class="feature">
                <div class="feature-icon">💰</div>
                <h3>Beste prijzen</h3>
                <p>Competitieve prijzen voor alle elektronica</p>
            </div>
        </div>
    </section>
    
    <section class="cta">
        <h2>Klaar om te shoppen?</h2>
        <p>Bekijk onze volledige collectie elektronische producten</p>
        @if(Auth::check())
            <a href="{{ route('shop.index') }}" class="btn">Start met winkelen</a>
        @else
            <a href="{{ route('login') }}" class="btn">Login om te winkelen</a>
        @endif
    </section>
@endsection