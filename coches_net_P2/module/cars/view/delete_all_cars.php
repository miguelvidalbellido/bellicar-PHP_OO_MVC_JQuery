<div id="contenido">
    <form autocomplete="on" method="post" name="delete_all_cars" id="delete_all_cars" >
        <table border='0'>
            <tr>
            <th width=1500><h3>¿Desea eliminar todos los coches?</h3></th>
            <td><input type="text" id="prueba" name="prueba" placeholder="prueba" value="prueba" hidden/></td>
            </tr>
        </table>
        <table border='0'>
            <tr>
                <!-- <td width=680 align="right"><button type="submit" class="Button_green" name="delete_all_cars" id="delete_all_cars">Accept</button></td> -->
                <td><br><input name="Submit" type="button" class="Button_red_2" onclick="select_opt_dummies('delete_all')" value="Send"/></td>
                <td><a class="Button_red" href="index.php?page=controller_cars&op=list">Cancel</a></td>
            </tr>
        </table>
        <br>
        <br>
    </form>
</div>