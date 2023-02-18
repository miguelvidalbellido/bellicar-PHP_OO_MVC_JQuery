<div id="contenido">
    <form autocomplete="on" method="post" name="delete_car" id="delete_car" ">
        <table border='0'>
            <tr>
                <td align="center"  colspan="2"><h3>¿Desea seguro borrar el vehiculo <?php echo $car['id']; ?>?</h3></td>
                <td><input type="text" id="id" name="id" placeholder="id" value="<?php echo $car['id']; ?>" hidden/></td>
            </tr>
            <tr>
                <!-- <td align="center"><button type="submit" class="Button_green"name="delete" id="delete">Aceptar</button></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="redirect_delete()" value="Send"/></td>
                <td align="center"><a class="Button_red" href="index.php?page=controller_cars&op=list">Cancelar</a></td>
            </tr>
        </table>
    </form>
</div>