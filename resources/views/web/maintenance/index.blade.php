<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        @media screen and (min-width: 640px) {
            .container {
                max-width: 700px;
            }
        }

        .maintenance-error {
            margin-top: -5px;
        }
    </style>
</head>
<body>
    <main class="container px-4 text-center">
        <i class="fas fa-hammer text-7xl"></i>
        <h1 class="mt-3 mb-0">We'll be back soon!</h1>
        <h3 class="text-muted mt-0">We're performing some maintenance at the moment.</h3>
        <form action="{{ route('maintenance.authenticate') }}" method="post">
            @csrf
            <div class="flex-container-lg gap-2 align-middle">
                <input class="form form-xs form-has-section-color mb-2" type="password" name="password" placeholder="Developer Password" required>
                <div class="flex-container flex-child-grow mb-2">
                    <button class="btn btn-xs btn-success w-100" type="submit">Login</button>
                </div>
            </div>
            <div class="maintenance-error text-danger text-start">{{ $errors->all()[0] ?? '' }}</div>
        </form>
        <div class="mt-4">
            @foreach (config('socials') as $data)
                <a href="{{ $data['url'] }}" target="_blank" class="footer-media text-5xl text-muted">
                    <i class="{{ $data['icon_class'] }}"></i>
                </a>
            @endforeach
        </div>
    </main>
</body>
</html>