<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<style>

</style>
<body class="font-sans antialiased">
    <x-banner />


    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
            {{-- @yield('content') --}}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    {{-- <footer class="footer">
        <div class="container">
          <div class="row">
            <!-- About Us Section -->
            <div class="col-lg-3 col-md-6 mb-4">
              <h5>About Us</h5>
              <p>Lorem ipsum dolor sit amet consectetur. Tellus amet vitae molestie mauris nunc malesuada.</p>
              <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/40" alt="Logo" class="mr-2">
                <span>CITSA-UCC</span>
              </div>
            </div>

            <!-- Useful Links Section -->
            <div class="col-lg-3 col-md-6 mb-4">
              <h5>Useful Links</h5>
              <p><a href="#">Program</a></p>
              <p><a href="#">Members</a></p>
              <p><a href="#">Resource</a></p>
              <p><a href="#">More</a></p>
            </div>

            <!-- Get in Touch Section -->
            <div class="col-lg-3 col-md-6 mb-4">
              <h5>Get In Touch</h5>
              <p>P.O.Box 4577 UCC Campus<br>Cape Coast, Ghana</p>
              <p><strong>Phone:</strong> Cape Coast, Ghana</p>
              <p><strong>Email:</strong> Cape Coast, Ghana</p>
              <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-xing"></i></a>
              </div>
            </div>

            <!-- Newsletter Section -->
            <div class="col-lg-3 col-md-6 mb-4">
              <h5>Join Our Newsletter</h5>
              <p>Lorem ipsum dolor sit amet consectetur. Tellus amet vitae.</p>
              <form class="form-inline">
                <input type="email" class="form-control newsletter-input" placeholder="Email Address">
                <button type="submit" class="newsletter-submit">SUBMIT</button>
              </form>
            </div>
          </div>
        </div>

        <!-- Footer Bottom Section -->
        <div class="footer-bottom">
          <div class="container">
            <div class="d-flex justify-content-between">
              <div>&copy; Copyright 2024</div>
              <div>
                <a href="#">Terms & Conditions</a> |
                <a href="#">Privacy & Policy</a>
              </div>
            </div>
          </div>
        </div>
      </footer> --}}
</body>

</html>
