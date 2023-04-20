<!-- <div id="menu"> -->


    <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Arsha</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php?page=ctrl_home&op=list">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php?page=services">Services</a></li>
          <li><a class="nav-link   scrollto" href="index.php?page=controller_cars&op=list">Coches</a></li>
          <li><a class="nav-link scrollto" href="index.php?page=ctrl_shop&op=list">Shop</a></li>
          <!-- <img src="view/assets/img/tienda.png" height="50vw" class="img-circle ml-2" id="avt_user"> -->
          <li><a class="nav-link scrollto men_login" href="index.php?page=ctrl_login&op=loginAndRegisterView">Register</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="index.php?page=contactus">Contact</a></li>
          <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
         
          <!-- MENU USUARIO -->
          <div class="dropdown" id="dropdown_user">
            
          </div>
          <div id="loadShopCart" class="p-3">

          </div>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      
      
        

      <!-- <img src="view/assets/img/tienda.png" height="50vw" class="img-circle ml-2" id="avt_user"> -->
    <!-- </nav> -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Tenemos el coche que buscas</h1>
          <h2>La mayor oferta de coches de km0 y segunda mano en España: sea cual sea tu estilo de vida, tenemos un coche para ti.</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started scrollto">Get Started</a>
            <a href="https://www.youtube.com/watch?v=xqrumTrBBQU" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="view/assets/img/tienda.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

<!-- </div> -->

<!-- IMPORTAMOS LA LIBRERIA JS DE SEARCH PARA SU FUNCIONAMIENTO -->

<script src="module/search/model/ctrl_search.js"></script>
<script src="view/js/utils.js"></script>
<script src="https://kit.fontawesome.com/238b18d4c2.js" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" href="https://kit.fontawesome.com/238b18d4c2.css" crossorigin="anonymous"> -->

<nav class="navbar_search">
  <i class="fa-solid fa-car-side"></i>
  <select class="navbar-select-search" id="selectBrand"></select>
  <select class="navbar-select-search" id="selectModel"></select>
  <i class="fa-solid fa-map-pin"></i>
  <div class="navbar-input-search">
    <input type="text" placeholder="Población" id="searchAutocomplete" list="populations">
    <datalist id="populations">
      <!-- <option value="Paco"></option> -->
    </datalist>
    <button id="button_search" class="button-86" role="button"><i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
</nav>
