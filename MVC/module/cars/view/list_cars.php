<div id="contenido">
    <div class="container">
    	<div class="row">
    			<h3>LISTA DE COCHES</h3>
    	</div>
    	<div class="row">
    		<p><a href="index.php?page=controller_cars&op=create"><img src="view/img/anadir.png"></a>
            <a href="index.php?page=controller_cars&op=dummies"><img src="view/img/dummies.png"></a>
            <a href="index.php?page=controller_cars&op=delete_all"><img src="view/img/delete_all.png"></a></p>    		
    		<table>
                <tr>
                <td width=125>id</td>
                <td width=125>numero_licencia</td>
                <td width=125>marca</td>
                <td width=125>modelo</td>
                <td width=125>matricula</td>
                <!-- <td width=125>km</td>
                <td width=125>categoria</td>
                <td width=125>tipo</td>
                <td width=125>comentarios</td>
                <td width=125>Feha de alta</td>
                <td width=125>Color</td>
                <td width=125>Extras</td>
                <td width=125>Car image</td>
                <td width=125>Precio</td>
                <td width=125>Nº puertas</td>
                <td width=125>Ciudad</td>
                <td width=125>latitud</td>
                <td width=125>longitud</td> -->
                </tr>
                <?php
                    if ($rdo->num_rows === 0){
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY NINGUN COCHE</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                       		echo '<tr>';
                            echo "<td width=125>".$row['id']."</td>";
                            echo "<td width=125>".$row['license_number']."</td>";
                            echo "<td width=125>".$row['brand']."</td>";
                            echo "<td width=125>".$row['model']."</td>";
                            echo "<td width=125>".$row['car_plate']."</td>";
                            // echo "<td width=125>".$row['km']."</td>";
                            // echo "<td width=125>".$row['category']."</td>";
                            // echo "<td width=125>".$row['type']."</td>";
                            // echo "<td width=125>".$row['comments']."</td>";
                            // echo "<td width=125>".$row['discharge_date']."</td>";
                            // echo "<td width=125>".$row['color']."</td>";
                            // echo "<td width=125>".$row['extras']."</td>";
                            // echo "<td width=125>".$row['car_image']."</td>";
                            // echo "<td width=125>".$row['price']."</td>";
                            // echo "<td width=125>".$row['doors']."</td>";
                            // echo "<td width=125>".$row['city']."</td>";
                            // echo "<td width=125>".$row['lat']."</td>";
                            // echo "<td width=125>".$row['lng']."</td>";

                            // PINTEM EL BOTO EN PHP
                            // echo '<td width=350>';
                            // print ("<div class='car' id='".$row['id']."'>Read</div>");  //READ
                    	    // echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                    	   	echo '<td width=350>';
                    	   	print ("<a class='car' id='".$row['id']."'>Read</a>");
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_green" href="index.php?page=controller_cars&op=update&id='.$row['id'].'">Update</a>';
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_red" href="index.php?page=controller_cars&op=delete&id='.$row['id'].'">Delete</a>';
                    	   	echo '</td>';
                    	   	echo '</tr>';
                        }
                    }
                ?>
            </table>
    	</div>
    </div>
</div>

<!-- modal window -->
<!-- <section id="user_modal">
    <div id="details_car" hidden>
        <div id="details">
            <div id="container">
                Número licencia: <div id="license_number">     </div></br>
                Marca: <div id="brand"></div></br>
                Modelo: <div id="model"></div></br>
                Número matricula: <div id="car_plate"></div></br>
                Número kms: <div id="km"></div></br>
                Categoria: <div id="category"></div></br>
                Tipo: <div id="type"></div></br>
                Comentarios: <div id="comments"></div></br>
                Fecha de compra: <div id="discharge_date"></div></br>
                Color: <div id="color"></div></br>
                Extras: <div id="extras"></div></br>
                Imagen coche: <div id="car_image"></div></br>
                Precio: <div id="price"></div></br>
                Número de puertas: <div id="doors"></div></br>
                Ciudad: <div id="city"></div></br>
                Latitud: <div id="lat"></div></br>
                Longitud: <div id="lng"></div></br>
            </div>
        </div>
    </div>
</section> -->
<section id="car_modal"></section>