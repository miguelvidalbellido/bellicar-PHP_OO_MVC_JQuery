<?php
	if(isset($_GET['page'])){
		switch($_GET['page']){
			case "homepage";
				include("module/inicio/inicio.html");
				break;
			case "ctrl_home";
				include("module/home/ctrl/".$_GET['page'].".php");
				break;
			case "controller_cars";
				include("module/cars/controller/".$_GET['page'].".php");
				break;
			case "services";
				include("module/services/".$_GET['page'].".html");
				break;
			case "aboutus";
				include("module/aboutus/".$_GET['page'].".html");
				break;
			case "contactus";
				include("module/contact/".$_GET['page'].".html");
				break;
			case "404";
				include("view/inc/error".$_GET['page'].".php");
				break;
			case "503";
				include("view/inc/error".$_GET['page'].".php");
				break;
			default;
				include("module/inicio/inicio.php");
				break;
		}
	}else{
		include("module/inicio/inicio.html");
	}
?>