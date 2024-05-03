@include('customer.head')

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
  @include('customer.header')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    @include('customer.slider')
    @yield('latest')

    @include('customer.body')

    
  @include('customer.footer')
