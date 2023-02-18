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
	    <link href="view/css/style.css" rel="stylesheet" type="text/css" />
	    <script src="module/cars/model/validate_cars.js"></script>
		<!-- CARGAMOS LA LIBRERIA DE UTILS PROPIA -->
		<script src="view/js/utils.js"></script>
		
    </head>
    <body>