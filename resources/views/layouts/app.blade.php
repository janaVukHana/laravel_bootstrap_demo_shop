<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Alpine js --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Demo Shop</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    @vite(['resources/js/app.js'])

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
              <a class="navbar-brand" href="/"><i class="fa-brands fa-monero"></i> Logo Shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/about-us">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                  </li>
                </ul>
        
                <ul class="navbar-nav mr-0 mb-2 mb-md-0">
                  <li class="nav-item position-relative">
                    <a class="nav-link" href="/products/shopping-cart">
                        Shopping Cart <i class="fa-solid fa-cart-shopping"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{session()->get('cart') ? count(session()->get('cart')->items) : '0'}}
                        </span>
                    </a>
                  </li>
                  <!-- test -->
                  <!-- <button type="button" class="btn btn-primary position-relative">
                    Shopping Cart <i class="fa-solid fa-cart-shopping"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                    </span>
                  </button> -->
                  <!-- test -->
                  <!-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                  </li> -->
                  <li class="nav-item dropdown">
                    @auth
                      <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">{{'Wellcome back ' . auth()->user()->name }}</a>
                    @else
                      <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Wellcome guest</a>
                    @endauth
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/admin/products"><i class="fa-solid fa-gear"></i> Admin Panel</a></li>
                      <li><a class="dropdown-item" href="/users/logout"><i class="fa-solid fa-sign-out"></i> Logout</a></li>
                      <li><a class="dropdown-item" href="/users/login"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a></li>
                      <li><a class="dropdown-item" href="/users/register"><i class="fa-solid fa-user-plus"></i> Register</a></li>
                    </ul>
                  </li>
                </ul>
        
              </div>
            </div>
        </nav>
        
        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-dark text-light">
            <div class="container d-flex flex-wrap justify-content-between align-items-center py-3">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <i class="fa-brands fa-monero"></i>
                    </a>
                    <span class="text-muted">© 2021 Company, Inc</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-linkedin fa-xl"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-github fa-xl"></i></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-instagram fa-xl"></i></i></a></li>
                </ul>
            </div>
        </footer>
    </div>
    
    {{-- Flash Message --}}
    <x-flash-message />
</body>
</html>