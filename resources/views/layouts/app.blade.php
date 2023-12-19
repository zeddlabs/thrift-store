<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>{{ $title }} - {{ config('app.name') }}</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}" />
  <!-- Custom styles -->
  <style type="text/css">
    .icon-hover:hover {
      border-color: #3b71ca !important;
      background-color: white !important;
    }

    .icon-hover:hover i {
      color: #3b71ca !important;
    }
  </style>
</head>

<body>
  <!-- Start your project here-->
  <!--Main Navigation-->
  <header>
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
      <div class="container">
        <div class="row gy-3">
          <!-- Left elements -->
          <div class="col-lg-2 col-sm-4 col-4">
            <a href="{{ route('home') }}" class="float-start fw-bold fs-4">
              {{ config('app.name') }}
            </a>
          </div>
          <!-- Left elements -->

          <!-- Center elements -->
          <div class="order-lg-last col-lg-10 col-sm-8 col-8">
            <div class="d-flex float-end">
              @auth('customer')
                <div class="dropdown">
                  <a href="#"
                    class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center dropdown-toggle"
                    href="#" id="accountDropdown" role="button" data-mdb-dropdown-init data-mdb-ripple-init
                    aria-expanded="false">
                    <i class="fas fa-user-alt m-1 me-md-2"></i>
                    <p class="d-none d-md-block mb-0">{{ Auth::guard('customer')->user()->name }}</p>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">Keluar</a>
                    </li>
                  </ul>
                </div>
              @else
                <a href="{{ route('login') }}" class="me-1 border rounded py-1 px-3 nav-link d-flex align-items-center">
                  <i class="fas fa-user-alt m-1 me-md-2"></i>
                  <p class="d-none d-md-block mb-0">Masuk</p>
                </a>
              @endauth
            </div>
          </div>
          <!-- Center elements -->
        </div>
      </div>
    </div>
    <!-- Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <!-- Container wrapper -->
      <div class="container justify-content-center justify-content-md-between">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
          data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
          <!-- Left links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <!-- Navbar dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-mdb-dropdown-init data-mdb-ripple-init aria-expanded="false">
                Kategori
              </a>
              <!-- Dropdown menu -->
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach ($categories as $category)
                  <li>
                    <a class="dropdown-item"
                      href="{{ route('home.category', $category->slug) }}">{{ $category->name }}</a>
                  </li>
                @endforeach
              </ul>
            </li>
          </ul>
          <!-- Left links -->
        </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>

  @yield('content')

  <!-- Footer -->
  <footer class="text-center text-lg-start text-muted bg-primary mt-3">
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start pt-4 pb-4">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-12 col-lg-3 col-sm-12 mb-2">
            <!-- Content -->
            <a href="" class="text-white h2">
              {{ config('app.name') }}
            </a>
            <p class="mt-1 text-white">
              &copy; {{ date('Y') }} Copyright: {{ config('app.name') }}
            </p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <div class="">
      <div class="container">
        <div class="d-flex justify-content-between py-4 border-top">
          <!--- payment --->
          <div>
            <i class="fab fa-lg fa-cc-visa text-white"></i>
            <i class="fab fa-lg fa-cc-amex text-white"></i>
            <i class="fab fa-lg fa-cc-mastercard text-white"></i>
            <i class="fab fa-lg fa-cc-paypal text-white"></i>
          </div>
          <!--- payment --->
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer -->
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="{{ asset('mdb/js/mdb.umd.min.js') }}"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>
