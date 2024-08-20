<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Lele Ventures</title>

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}"  rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}"  rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}"  rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}"  rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}"  rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}"  rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <h1 class="logo me-auto"><a href="#">Arsha</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="#" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>
      <nav id="navbar" class="navbar">
      
        <ul>
          
       @foreach($menus as $menu)
               <li><a class="nav-link scrollto" href="{{$menu->link}}">{{$menu->title}}</a></li>
         @endforeach
        </ul>
             
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      @foreach($sliders as $slider)
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          
          <h1>{{$slider->title}}</h1>
          <h2>{{$slider->desc}}</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          {{-- <img src="assets/img/hero-img.png" class="img-fluid animated" alt=""> --}}
          <img src="{{ asset('user-uploads/sliders/' . $slider->image) }}" class="img-fluid animated" alt="">
        </div>
      </div>
      @endforeach
    </div>

  </section><!-- End Hero -->

 <!-- Main container -->
    @yield('content')
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Corporate Office</h4>
            <p>
              {{$global->address}} <br><br>
            </p>
            <h4>Branch Office</h4>
            <p>
              {{$global->branch_address}} <br><br>
              <strong>Phone:</strong> {{$global->company_phone}}<br>
              <strong>Email:</strong> {{$global->company_email}}<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              @foreach($menus as $menu)
              <li><i class="bx bx-chevron-right"></i> <a href="{{$menu->link}}">{{$menu->title}}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              @foreach($services as $service)
              <li><i class="bx bx-chevron-right"></i> {{$service->title}}</li>
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <div class="social-links mt-3">
              <a href="{{$global->facebook_url}}" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
              <a href="{{$global->instagram_url}}" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
              <a href="{{$global->linkedin_url}}" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; <?php echo date("Y"); ?> <strong><span>{{$global->company_name}}</span></strong> All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  {{-- <div id="preloader"></div> --}}
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/aos/aos.js') }}" ></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}" ></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}" ></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}" ></script>
  <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}" ></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}" ></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}" ></script>

</body>

</html>