@extends('layouts.front')

@section('content')
  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
      <div class="container">

        <div class="row" data-aos="zoom-in">

          @foreach($partners as $partner)
          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="{{asset('user-uploads/partners/').'/'.$partner->image}}" class="img-fluid" alt="{{$partner->slug}}">
          </div>
          @endforeach

        </div>

      </div>
    </section><!-- End Cliens Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
     
        </div>

        <div class="row content">
              @foreach($about as $abouts)
          <div class="col-lg-12">
          
            <p>
           
              {!! $abouts->desc !!}
            
            </p>
        

            {{-- <ul>
              <li><i class="ri-check-double-line"></i>{!! $a->desc !!}</li>
             
            </ul> --}}
               
          </div>
             @endforeach
          {{-- <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              We have been providing excellent services to customers in the past 8 years covering more than 500+ multi-category companies across Nepal and India. 
              We believe in our customer satisfactions, technical expertise & corporate value.
            </p>
            <p>
              We build a variety of cooperative products and continuously enhanced our programmers and technical support staffs over the time in 
              order to provide our clients with the greatest technical product that allows them to compete in the market with best available technology.
            </p>
          </div> --}}
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
        </div>

        <div class="row">
          <?php $time = 100 ;?>
          @foreach($services->take(4) as $service)
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="{{$time}}">
            <div class="icon-box">
              <div class="icon"><i class="{{$service->icon}}"></i></div>
              <h4><a href="">{{$service->title}}</a></h4>
              <p>{{$service->desc}}</p>
            </div>
          </div>
          <?php $time += 100; ?>
          @endforeach

        

        {{-- <div class="row">
          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Software Development</a></h4>
              <p>We ensure a complete system routine through an effective plan from the preliminary concept or idea to Quality assurance before the deployment of the project</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Web Development</a></h4>
              <p>We ensure a complete system routine through an effective plan from the preliminary concept or idea to Quality assurance before the deployment of the project</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Mobile Application Development</a></h4>
              <p>We ensure a complete system routine through an effective plan from the preliminary concept or idea to Quality assurance before the deployment of the project</p>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-layer"></i></div>
              <h4><a href="">Social Media Marketing</a></h4>
              <p>Social Media Marketing and Content Creation</p>
            </div>
          </div> --}}

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <h1 style="margin-bottom: 50px;">OFFICE ADDRESS</h1>

              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Corporate Office:</h4>
                <p>{{$global->address}}</p>
              </div>

              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Branch Office:</h4>
                <p>{{$global->branch_address}}</p>
              </div>

              <div style="margin-bottom: 50px;"></div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Phone:</h4>
                <p>{{$global->company_phone}}</p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>{{$global->company_email}}</p>
              </div>
            </div>
          </div>
 
        
          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
     
          <form action="{{ route('jobs.contact') }}" method="POST" role="form" class="php-email-form">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Your Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        <div class="form-group col-md-6">
            <label for="email">Your Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
    </div>
    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" name="subject" id="subject" required>
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" name="message" rows="5" required></textarea>
    </div>
    <div class="my-3">
        <div class="loading">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your message has been sent. Thank you!</div>
    </div>
    <div class="text-center"><button type="submit">Send Message</button></div>
</form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  @endsection

