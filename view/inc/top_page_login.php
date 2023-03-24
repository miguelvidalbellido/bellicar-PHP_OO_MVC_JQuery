<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BelliCar</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Librerias fuera del template -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<!-- LIRERIAS PROPIAS PARA EL MODULO HOME -->
	    <script src="module/login/model/ctrl_login.js"></script>
		<!-- <link href="view/css/css_module_home.css" rel="stylesheets"> -->
		<!-- CARGAMOS LA LIBRERIA DE UTILS PROPIA -->
		<script src="view/js/utils.js"></script>

		<!-- TOASTR -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css"/>
		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    	<script type="text/javascript">
        	$(function() {
        		$('#fecha').datepicker({
        			dateFormat: 'dd/mm/yy', 
        			changeMonth: true, 
        			changeYear: true, 
        			yearRange: '1900:2016',
        			onSelect: function(selectedDate) {
        			}
        		});
        	});
	    </script>


  <!-- Favicons -->
  <link href="view/assets/img/favicon.png" rel="icon">
  <link href="view/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="view/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="view/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="view/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="view/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="view/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="view/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="view/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="view/assets/css/style.css" rel="stylesheet">

   <!-- Vendor JS Files -->
   <script src="view/assets/vendor/aos/aos.js"></script>
  <script src="view/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="view/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="view/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="view/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="view/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="view/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="view/assets/js/main.js"></script>

  <!-- LIBRERIAS CAROUSEL -->
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

  <!-- JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>

  <script src="view\swiperjs\slidehome.js"></script>


</head>

<body>
