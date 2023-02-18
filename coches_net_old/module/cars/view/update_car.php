<div id="contenido">
    <form autocomplete="on" method="post" name="update_car" id="update_car" >
        <h1>Vehículo nuevo: </h1>
        <table border='0'>
            <tr>
                <td>Licencia: </td>
                <td><input type="text" id="licencia" name="licencia" placeholder="licencia" value="<?php echo $car['license_number'];?>" readonly/></td>
                <td><font color="red">
                    <span id="error_licencia" class="error">
                        <!-- <?php
                            echo "$error_licencia";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
        
            <tr>
                <td>Marca: </td>
                <td><input type="text" id="marca" name="marca" placeholder="marca" value="<?php echo $car['brand']; ?>"/></td>
                <td><font color="red">
                    <span id="error_marca" class="error">
                        <!-- <?php
                            echo "$error_marca";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Modelo: </td>
                <td><input type="text" id="modelo" name="modelo" placeholder="modelo" value="<?php echo $car['model']; ?>" /></td>
                <td><font color="red">
                    <span id="error_modelo" class="error">
                        <!-- <?php
                            echo "$error_modelo";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Matricula: </td>
                <td><input type="text" id= "matricula" name="matricula" placeholder="matricula" value="<?php echo $car['car_plate']; ?>" readonly/></td>
                <td><font color="red">
                    <span id="error_matricula" class="error">
                        <!-- <?php
                            echo "$error_matricula";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            
            <tr>
                <td>Km: </td>
                <td><input type="text" id="km" name="km" placeholder="km" value="<?php echo $car['km']; ?>"/></td>
                <td><font color="red">
                    <span id="error_km" class="error">
                        <!-- <?php
                            echo "$error_km";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Categoría: </td>
                <td>
                    <?php
                        if ($car['category']==="Utilitario"){
                    ?>
                        <input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Utilitario" checked/>Utilitario
                        <input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Compacto"/>Compacto
                    <?php
                        }else{
                    ?>
                        <input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Utilitario" />Utilitario
                        <input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Compacto"checked/>Compacto
                    <?php
                        }
                    ?>
                </td>
                <td><font color="red">
                    <span id="error_categoria" class="error">
                        <!-- <?php
                            echo "$error_categoria";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            
            <tr>
                <td>Tipo: </td>
                <td>
                    <?php
                        if ($car['type']==="ET"){
                    ?>
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="ET" checked/>Electrico
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="HB"/>Hibrido
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="GS"/>Gasoleo
                    <?php
                        } else if($car['type']==="HB"){
                    ?>
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="ET" />Electrico
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="HB"checked/>Hibrido
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="GS"/>Gasoleo
                    <?php
                        } else{
                    ?>
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="ET" />Electrico
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="HB"/>Hibrido
                        <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="GS"checked/>Gasoleo
                    <?php
                        }
                    ?>
                    </td>
                <td><font color="red">
                    <span id="error_tipo" class="error">
                        <!-- <?php
                            echo "$error_tipo";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td>Comentarios: </td>
                <td><textarea cols="30" rows="5" id="comentarios" name="comentarios" placeholder="comentarios"><?php echo $car['comments']; ?></textarea></td>
                <td><font color="red">
                    <span id="error_comentarios" class="error">
                        <!-- <?php
                            echo "$error_comentarios";
                        ?> -->
                    </span>
                </font></font></td>
                
            </tr>
            
            <tr>
                <td>Fecha de alta: </td>
                <td>
                    <input type="date" id="alta" name="alta" value="<?php echo $car['discharge_date']; ?>">
                </td>
                <td><font color="red">
                    <span id="error_alta" class="error">
                        <!-- <?php
                            echo "$error_alta";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Color: </td>
                <td><input type="text" id="color" name="color" placeholder="color" value="<?php echo $car['color']; ?>"/></td>
                <td><font color="red">
                    <span id="error_color" class="error">
                        <!-- <?php
                            echo "$error_color";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Extras: </td>
                <?php
                    $extr=explode(":", $car['extras']);
                ?>
                <td>
                    <!-- SENSOR APARCAMIENTO -->
                    <?php
                        $busca_array = in_array("Sensor aparcamiento", $extr);
                        if($busca_array){
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Sensor aparcamiento" checked/>Sensor aparcamiento
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Sensor aparcamiento"/>Sensor aparcamiento
                    <?php
                        }
                    ?>
                    <!-- MANOS LIBRES -->
                    <?php
                        $busca_array = in_array("Manos libres", $extr);
                        if($busca_array){
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Manos libres" checked/>Manos libres
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Manos libres"/>Manos libres
                    <?php
                        }
                    ?>
                    <!-- CARGADOR INALAMBRICO -->
                    <?php
                        $busca_array = in_array("Cargador inalambrico", $extr);
                        if($busca_array){
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Cargador inalambrico" checked/>Cargador inalambrico</td>
                    <?php
                        }else{
                    ?>
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Cargador inalambrico"/>Cargador inalambrico</td>
                    <?php
                        }
                    ?>
                <td><font color="red">
                <td><font color="red">
                    <span id="error_extras" class="error">
                        <!-- <?php
                            echo "$error_extras";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

           <!-- Ni ha que afegir nous opcions en el validate -->

            <tr>
                <td>Imagen: </td>
                <td><input type="text" id="imagen" name="imagen" placeholder="imagen" value="<?php echo $car['car_image']; ?>"/></td>
                <td><font color="red">
                    <span id="error_imagen" class="error">
                        <!-- <?php
                            echo "$error_imagen";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>
            
            <tr>
                <td>Precio: </td>
                <td><input type="text" id="precio" name="precio" placeholder="precio" value="<?php echo $car['price']; ?>"/></td>
                <td><font color="red">
                    <span id="error_precio" class="error">
                        <!-- <?php
                            echo "$error_precio";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
            <td>Puertas: </td>
                <td><select multiple size="4" id="puertas[]" name="puertas[]" placeholder="puertas">
                    <!-- DOS PUERTAS -->
                    <?php
                        if($car['doors']===2){
                    ?>
                        <option value="2" selected>Dos</option>
                        <option value="3">Tres</option>
                        <option value="4">Cuatro</option>
                        <option value="5">Cinco</option>
                    <?php
                        }elseif($car['doors']===3){
                    ?>
                        <option value="2">Dos</option>
                        <option value="3" selected>Tres</option>
                        <option value="4">Cuatro</option>
                        <option value="5">Cinco</option>
                    <?php
                        }elseif($car['doors']===4){
                    ?>
                        <option value="2">Dos</option>
                        <option value="3">Tres</option>
                        <option value="4" selected>Cuatro</option>
                        <option value="5">Cinco</option>
                    <?php
                        }else{
                    ?>
                        <option value="2">Dos</option>
                        <option value="3">Tres</option>
                        <option value="4">Cuatro</option>
                        <option value="5" selected>Cinco</option>
                    <?php
                        }
                    ?>
                    </select></td>
                <td><font color="red">
                    <span id="error_puertas" class="error">
                        <!-- <?php
                            echo "$error_puertas";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td>Ciudad: </td>
                <td><input type="text" id="ciudad" name="ciudad" placeholder="ciudad" value="<?php echo $car['city']; ?>"/></td>
                <td><font color="red">
                    <span id="error_ciudad" class="error">
                        <!-- <?php
                            echo "$error_ciudad";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td>Latitud: </td>
                <td><input type="text" id="latitud" name="latitud" placeholder="latitud" value="<?php echo $car['lat']; ?>"/></td>
                <td><font color="red">
                    <span id="error_latitud" class="error">
                        <!-- <?php
                            echo "$error_latitud";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <td>Longitud: </td>
                <td><input type="text" id="longitud" name="longitud" placeholder="longitud" value="<?php echo $car['lng']; ?>"/></td>
                <td><font color="red">
                    <span id="error_longitud" class="error">
                        <!-- <?php
                            echo "$error_longitud";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <!-- <td><input type="submit" name="update" id="update"/></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="validate('update')" value="Send"/></td>
                <td align="right"><a href="index.php?page=controller_cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>