<div id="contenido">
    <h1>Informacion del Vehículo</h1>
    <p>
    <table border='2'>
        <tr>
            <td>ID: </td>
            <td>
                <?php
                    echo $car['id'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>Número licencia: </td>
            <td>
                <?php
                    echo $car['license_number'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Marca: </td>
            <td>
                <?php
                    echo $car['brand'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Modelo: </td>
            <td>
                <?php
                    echo $car['model'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Número matricula: </td>
            <td>
                <?php
                    echo $car['car_plate'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Número kms: </td>
            <td>
                <?php
                    echo $car['km'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Categoria: : </td>
            <td>
                <?php
                    echo $car['category'];
                ?>
            </td>
            
        </tr>
        
        <tr>
            <td>Tipo: </td>
            <td>
                <?php
                    echo $car['type'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Comentarios: </td>
            <td>
                <?php
                    echo $car['comments'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Fecha de compra: </td>
            <td>
                <?php
                    echo $car['discharge_date'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Color: </td>
            <td>
                <?php
                    echo $car['color'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Extras: </td>
            <td>
                <?php
                    // echo $car['extras'];
                    echo str_replace(":","<br>",$car['extras']);
                ?>
            </td>
        </tr>
        <tr>
            <td>Imagen coche: </td>
            <td>
                <?php
                    echo $car['car_image'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Precio: </td>
            <td>
                <?php
                    echo $car['price'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Número de puertas: </td>
            <td>
                <?php
                    echo $car['doors'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Ciudad: </td>
            <td>
                <?php
                    echo $car['city'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Latitud: </td>
            <td>
                <?php
                    echo $car['lat'];
                ?>
            </td>
        </tr>
        <tr>
            <td>Longitud: </td>
            <td>
                <?php
                    echo $car['lng'];
                ?>
            </td>
        </tr>

    </table>
    </p>
    <p><a href="index.php?page=controller_cars&op=list">Volver</a></p>
</div>