<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? "{$title} | " . config('site.name') : config('site.name') }}</title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Meta -->
    <link rel="shortcut icon" href="{{ config('site.icon') }}">
    <meta name="author" content="{{ config('site.name') }}">
    <meta name="description" content="Explore {{ config('site.name') }}: A free online social hangout.">
    <meta name="keywords" content="{{ strtolower(config('site.name')) }}, {{ strtolower(str_replace(' ', '', config('site.name'))) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="{{ str_replace(' | ' . config('site.name'), '', $title) }}">
    <meta property="og:description" content="Explore {{ config('site.name') }}: A free online social hangout.">
    <meta property="og:image" content="{{ !isset($image) ? config('site.icon') : $image }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
   
	<link rel="stylesheet" href="https://beta.brickite.com/assets/css/style.css" />
	
	<main class="container px-4 text-center">
            
           
                        
                    </div>
                </div>
				            
        

                        @yield('content')
                    
</body>
</html>
