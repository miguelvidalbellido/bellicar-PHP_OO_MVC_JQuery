<?php
    if ((isset($_GET['page'])) && ($_GET['page']==="controller_cars") ){ // Ctrl module cars
		include("view/inc/top_page_car.php");
	}else if((isset($_GET['page'])) && ($_GET['page']==="ctrl_home") ){ // Ctrl module home
		include("view/inc/top_page_home.php");
	}else if((isset($_GET['page'])) && ($_GET['page']==="ctrl_shop") ){ // Ctrl module shop
		include("view/inc/top_page_shop.php");
	}else if((isset($_GET['page'])) && ($_GET['page']==="ctrl_login") ){ // Ctrl module shop
		include("view/inc/top_page_login.php");
	}else if((isset($_GET['page'])) && ($_GET['page']==="ctrl_dashboard") ){ // Ctrl module shop
		include("view/inc/top_page_dashboard.php");
	}else{
		include("view/inc/top_page.php");
	}
	// session_start();
?>
<div id="wrapper">		
    <!-- <div id="header">    	 -->
    	 <?php
    	//    include("view/inc/header.php");
    	?>         
    <!-- </div>   -->
    <div id="menu">
		<?php
		    include("view/inc/menu.php");
		?>
    </div>	
    <div id="">
    	<?php 
		    include("view/inc/pages.php"); 
		?>        
        <br style="clear:both;" />
    </div>
    <div id="footer">   	   
	    <?php
	        include("view/inc/footer.php");
	    ?>        
    </div>
</div>
<?php
    include("view/inc/bottom_page.php");
?>
    