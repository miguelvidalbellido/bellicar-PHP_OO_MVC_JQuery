<div id="contenido">
    <form autocomplete="on" method="post" name="alta_car" id="alta_car">
        <h1>Vehículo nuevo: </h1>
        <table border='0'>
            <tr>
                <td>Licencia: </td>
                <td><input type="text" id="licencia" name="licencia" placeholder="licencia" value="" /></td>
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
                <td><input type="text" id="marca" name="marca" placeholder="marca" value=""/></td>
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
                <td><input type="text" id="modelo" name="modelo" placeholder="modelo" value=""/></td>
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
                <td><input type="text" id= "matricula" name="matricula" placeholder="matricula" value=""/></td>
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
                <td><input type="text" id="km" name="km" placeholder="km" value=""/></td>
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
                <td><input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Utilitario"/>Utilitario
                    <input type="radio" id="categoria" name="categoria" placeholder="categoria" value="Compacto"/>Compacto</td>
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
                <td><input type="radio" id="tipo" name="tipo" placeholder="tipo" value="ET"/>Electrico
                    <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="HB"/>Hibrido
                    <input type="radio" id="tipo" name="tipo" placeholder="tipo" value="GS"/>Gasoleo</td>
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
                <td><textarea cols="30" rows="5" id="comentarios" name="comentarios" placeholder="comentarios" value=""></textarea></td>
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
                    <input type="date" id="alta" name="alta">
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
                <td><input type="text" id="color" name="color" placeholder="color" value=""/></td>
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
                <td><input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Sensor aparcamiento"/>Sensor aparcamiento
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Manos libres"/>Manos libres
                    <input type="checkbox" id= "extras[]" name="extras[]" placeholder= "extras" value="Cargador inalambrico"/>Cargador inalambrico</td>
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
                <td><input type="text" id="imagen" name="imagen" placeholder="imagen" value=""/></td>
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
                <td><input type="text" id="precio" name="precio" placeholder="precio" value=""/></td>
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
                    <option value="2">Dos</option>
                    <option value="3">Tres</option>
                    <option value="4">Cuatro</option>
                    <option value="5">Cinco</option>
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
                <td><input type="text" id="ciudad" name="ciudad" placeholder="ciudad" value=""/></td>
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
                <td><input type="text" id="latitud" name="latitud" placeholder="latitud" value=""/></td>
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
                <td><input type="text" id="longitud" name="longitud" placeholder="longitud" value=""/></td>
                <td><font color="red">
                    <span id="error_longitud" class="error">
                        <!-- <?php
                            echo "$error_longitud";
                        ?> -->
                    </span>
                </font></font></td>
            </tr>

            <tr>
                <!-- <td><input type="submit" name="create" id="create"/></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="validate('create')" value="Send"/></td>
                <td align="right"><a href="index.php?page=controller_cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>