<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Alta de Usuario</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" />
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
	    <!-- <link href="view/css/style.css" rel="stylesheet" type="text/css" /> -->
	    <script src="module/cars/model/validate_cars.js"></script>
		<!-- CARGAMOS LA LIBRERIA DE UTILS PROPIA -->
		<script src="view/js/utils.js"></script>

		<!-- PLANTILLA BURGER -->
			<!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="view/assets/css/bootstrap.css" />

<!--owl slider stylesheet -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<!-- nice select  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
<!-- font awesome style -->
<link href="view/assets/css/font-awesome.min.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="view/assets/css/style.css" rel="stylesheet" />
<!-- responsive style -->
<link href="view/assets/css/responsive.css" rel="stylesheet" />


		<!-- jQery -->
		<!-- <script src="js/jquery-3.4.1.min.js"></script> -->
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="view/assets/js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="view/assets/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->
		
    </head>
    <body>