/**
 * Encargada de validar si el num de licencia es valido
 * @param {String} texto - Valor obtenido del formulario
 * @returns {boolean} True si cumple regex o False
 */
function validate_licencia(texto){
    if (texto.length > 0){
        var reg=/^[a-zA-Z0-9]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validaor si la marca es valida
 * @param {String} texto - Valor obtenido del formulario
 * @returns {boolean} True si cumple regex o False
 */
function validate_marca(texto){
    if (texto.length > 0){
        var reg=/^[a-zA-Z]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar si el modelo es valido
 * @param {String} texto - Valor obtenido del formulario
 * @returns {boolean} True si cumple regex o False
 */
function validate_modelo(texto){
    if (texto.length > 0){
        var reg=/^[a-zA-Z]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar si la matricula es valida
 * @param {String} texto - Valor obtenido del formulario
 * @returns {boolean} True si cumple regex o False
 */
function validate_matricula(texto){
    if (texto.length > 0){
        var reg=/^[0-9]{4}[A-Z]{3}$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar si el num de km es valido
 * @param {String} texto - Valor obtenido del formulario
 * @returns {boolean} True si cumple regex o False
 */
function validate_km(texto){
    if (texto.length > 0){
        var reg=/^[0-9]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de comprobar que se ha seleccionado un radio [Extras] 
 * @param {String} texto - Valor del formulario
 * @returns {boolean} True si esta seleccionado o False
 */
function validate_categoria(texto){
    var i;
    var ok=0;
    for(i=0; i<texto.length;i++){
        if(texto[i].checked){
            ok=1
        }
    }
 
    if(ok==1){
        return true;
    }
    if(ok==0){
        return false;
    }
}

/**
 * Encargada de comprobar que se ha seleccionado un radio [Tipo] 
 * @param {String} texto - Valor del formulario
 * @returns {boolean} True si esta seleccionado o False
 */
function validate_tipo(texto){
    var i;
    var ok=0;
    for(i=0; i<texto.length;i++){
        if(texto[i].checked){
            ok=1
        }
    }
 
    if(ok==1){
        return true;
    }
    if(ok==0){
        return false;
    }
}

/**
 * Encargada de comprobar que el campo comentarios tiene información
 * @param {String} texto - Valor del formulario 
 * @returns {boolean} True si contiene información o False
 */
function validate_comentarios(texto){
    if (texto.length > 0){
        return true;
    }
    return false;
}

/**
 * Encargada de validar la fecha
 * @param {String} texto - Fecha obtenida del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_fecha_alta(texto){
    if (texto.length > 0){
        var reg=/^(19|20)(((([02468][048])|([13579][26]))-02-29)|(\d{2})-((02-((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))-((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))-31)))$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar el color
 * @param {String} texto - Color obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_color(texto){
    if (texto.length > 0){
        var reg=/^[A-Za-z]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar si se ha seleccionado un extra como mínimo
 * @param {Array} array - Extras obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_extras(array){
    if(array.checked){
        return true;
    }else{
        return false;
    }
}

/**
 * Encargada de validar el nombre de imagen
 * @param {String} texto - Nombre obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_imagen(texto){
    if (texto.length > 0){
        var reg=/^[A-Za-z]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar el precio
 * @param {String} texto - Precio obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_precio(texto){
    if (texto.length > 0){
        var reg=/^[0-9]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar el numero de puertas
 * @param {Array} array - Array obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_puertas(array){
    var check=false;
    for ( var i = 0, l = array.options.length, o; i < l; i++ ){
        o = array.options[i];
        if ( o.selected ){
            check= true;
        }
    }
    return check;
}

/**
 * Encargada de validar la ciudad
 * @param {String} texto - Ciudad obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_ciudad(texto){
    if (texto.length > 0){
        var reg=/^[A-Za-z]*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar la latitud
 * @param {String} texto - Valor lat obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_latitud(texto){
    if (texto.length > 0){
        var reg=/^[-]?\d+[\.]?\d*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Encargada de validar la lng
 * @param {String} texto - Valor lng obtenido del formulario 
 * @returns {boolean} True si cumple con la expressión o False
 */
function validate_longitud(texto){
    if (texto.length > 0){
        var reg=/^[-]?\d+[\.]?\d*$/;
        return reg.test(texto);
    }
    return false;
}

/**
 * Utilizada para validar los campos del formulario, pintando errores html si algo sale mal
 * @param {String} encargado de redireccionar al acabar la validación
 * @returns {boolean} True si se cumplen todas las condiciones
 */

function validate(op){
    var check = true;

    var v_licencia = document.getElementById('licencia').value;
    var v_marca = document.getElementById('marca').value;
    var v_modelo = document.getElementById('modelo').value;
    var v_matricula = document.getElementById('matricula').value;
    var v_km = document.getElementById('km').value;
    var v_categoria = document.getElementsByName('categoria');
    var v_tipo = document.getElementsByName('tipo');
    var v_comentarios = document.getElementById('comentarios').value;
    var v_alta = document.getElementById('alta').value;
    var v_color = document.getElementById('color').value;
    var v_extras = document.getElementById('extras[]');
    var v_imagen = document.getElementById('imagen').value;
    var v_precio = document.getElementById('precio').value;
    var v_puertas = document.getElementById('puertas[]');
    var v_ciudad = document.getElementById('ciudad').value;
    var v_latitud = document.getElementById('latitud').value;
    var v_longitud = document.getElementById('longitud').value;

    var r_licencia = validate_licencia(v_licencia);
    var r_marca = validate_marca(v_marca);
    var r_modelo = validate_modelo(v_modelo);
    var r_matricula = validate_matricula(v_matricula);
    var r_km = validate_km(v_km);
    var r_categoria = validate_categoria(v_categoria);
    var r_tipo = validate_tipo(v_tipo);
    var r_comentarios = validate_comentarios(v_comentarios);
    var r_alta = validate_fecha_alta(v_alta);
    var r_color = validate_color(v_color);
    var r_extras = validate_extras(v_extras);
    var r_imagen = validate_imagen(v_imagen);
    var r_precio = validate_precio(v_precio);
    var r_puertas = validate_puertas(v_puertas);
    var r_ciudad = validate_ciudad(v_ciudad);
    var r_latitud = validate_latitud(v_latitud);
    var r_longitud = validate_longitud(v_longitud);

    if(!r_licencia){
        document.getElementById('error_licencia').innerHTML = " * El usuario introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_licencia').innerHTML = "";
    }
    if(!r_marca){
        document.getElementById('error_marca').innerHTML = " * La marca introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_marca').innerHTML = "";
    }
    if(!r_modelo){
        document.getElementById('error_modelo').innerHTML = " * El nombre introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_modelo').innerHTML = "";
    }
    if(!r_matricula){
        document.getElementById('error_matricula').innerHTML = " * El DNI introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_matricula').innerHTML = "";
    }
    if(!r_km){
        document.getElementById('error_km').innerHTML = " * No has seleccionado ningun genero";
        check=false;
    }else{
        document.getElementById('error_km').innerHTML = "";
    }
    if(!r_categoria){
        document.getElementById('error_categoria').innerHTML = " * No has introducido ninguna fecha";
        check=false;
    }else{
        document.getElementById('error_categoria').innerHTML = "";
    }
    if(!r_comentarios){
        document.getElementById('error_comentarios').innerHTML = " * La edad introducida no es valida";
        check=false;
    }else{
        document.getElementById('error_comentarios').innerHTML = "";
    }
    if(!r_tipo){
        document.getElementById('error_tipo').innerHTML = " * No has seleccionado ningun idioma";
        check=false;
    }else{
        document.getElementById('error_tipo').innerHTML = "";
    }
    if(!r_alta){
        document.getElementById('error_alta').innerHTML = " * El texto introducido no es valido";
        check=false;
    }else{
        document.getElementById('error_alta').innerHTML = "";
    }
    if(!r_color){
        document.getElementById('error_color').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_color').innerHTML = "";
    }
    if(!r_extras){
        document.getElementById('error_extras').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_extras').innerHTML = "";
    }
    if(!r_imagen){
        document.getElementById('error_imagen').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_imagen').innerHTML = "";
    }
    if(!r_precio){
        document.getElementById('error_precio').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_precio').innerHTML = "";
    }
    if(!r_puertas){
        document.getElementById('error_puertas').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_puertas').innerHTML = "";
    }
    if(!r_ciudad){
        document.getElementById('error_ciudad').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_ciudad').innerHTML = "";
    }if(!r_latitud){
        document.getElementById('error_latitud').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_latitud').innerHTML = "";
    }
    if(!r_longitud){
        document.getElementById('error_longitud').innerHTML = " * No has seleccionado ninguna aficion";
        check=false;
    }else{
        document.getElementById('error_longitud').innerHTML = "";
    }
    // return check;

    if (check){
        if (op == 'create'){
            document.alta_car.submit();
            document.alta_car.action = "index.php?page=controller_cars&op=create";
        }
        if (op == 'update'){
            document.update_car.submit();
            document.update_car.action = "index.php?page=controller_cars&op=update";
        }
    }  
}

function select_opt_dummies(op){
        if (op == 'delete_all'){
            document.delete_all_cars.submit();
            document.delete_all_cars.action = "index.php?page=controller_cars&op=delete_all";
        }
        
        if (op == 'dummies'){
            console.log(op);
            document.dummies_cars.submit();
            document.dummies_cars.action = "index.php?page=controller_cars&op=dummies";
        }
    
}

function redirect_delete(){
   
        document.delete_car.submit();
        document.delete_car.action = "index.php?page=controller_cars&op=delete";
        // console.log("");
    
}

// $(document).ready(function (){
//     // console.log("HEMOS ENTRADO JS 1");
//     $('.car').click(function () {
//         // console.log("HEMOS ENTRADO JS 2");
//         var id = this.getAttribute('id')

//         $.get("module/cars/controller/controller_cars.php?op=read_modal&modal=" + id,

//         function (data, status) {
            
//             var json = JSON.parse(data);
//             // console.log(json);
            
//             if(json === 'error') {
//                 //console.log(json);
//                 //pintar 503
//                 window.location.href='index.php?page=503';
//             }else{
//                 console.log(json.id);
//                 $("#brand").html(json.brand);
//                 $("#car_image").html(json.car_image);
//                 $("#car_plate").html(json.car_plate);
//                 $("#category").html(json.category);
//                 $("#city").html(json.city);
//                 $("#color").html(json.color);
//                 $("#comments").html(json.comments);
//                 $("#discharge_date").html(json.discharge_date);
//                 $("#doors").html(json.doors);
//                 $("#extras").html(json.extras.replaceAll(':', ' '));
//                 $("#id").html(json.id);
//                 $("#km").html(json.km);
//                 $("#lat").html(json.lat);
//                 $("#license_number").html(json.license_number);
//                 $("#lng").html(json.lng);
//                 $("#model").html(json.model);
//                 $("#price").html(json.price);
//                 $("#type").html(json.type);
     
//                 $("#details_car").show();
//                 $("#user_modal").dialog({
//                     width: 850, //<!-- ------------- ancho de la ventana -->
//                     height: 500, //<!--  ------------- altura de la ventana -->
//                     //show: "scale", <!-- ----------- animación de la ventana al aparecer -->
//                     //hide: "scale", <!-- ----------- animación al cerrar la ventana -->
//                     resizable: "false", //<!-- ------ fija o redimensionable si ponemos este valor a "true" -->
//                     //position: "down",<!--  ------ posicion de la ventana en la pantalla (left, top, right...) -->
//                     modal: "true", //<!-- ------------ si esta en true bloquea el contenido de la web mientras la ventana esta activa (muy elegante) -->
//                     buttons: {
//                         Ok: function () {
//                             $(this).dialog("close");
//                         }
//                     },
//                     show: {
//                         effect: "blind",
//                         duration: 1000
//                     },
//                     hide: {
//                         effect: "highlight",
//                         duration: 1000
//                     }
//                 });
//             }//end-else
//         });
//     });
// });

// MODAL EN PROMESA
function showModal(title_Car, id) {
    $("#details_car").show();
    $("#car_modal").dialog({
        title: title_Car,
        width : 850,
        height: 500,
        resizable: "false",
        modal: "true",
        hide: "fold",
        show: "fold",
        buttons : {
            Update: function() {
                        window.location.href = 'index.php?page=controller_cars&op=update&id=' + id;
                    },
            Delete: function() {
                        window.location.href = 'index.php?page=controller_cars&op=delete&id=' + id;
                    }
        }
    });
}

function loadContentModal() {
    $('.car').click(function () {
        var id = this.getAttribute('id');
        ajaxPromise('module/cars/controller/controller_cars.php?op=read_modal&modal=' + id, 'GET', 'JSON')
        .then(function(data) {
            // var data = JSON.parse(data);
            $('<div></div>').attr('id', 'details_car', 'type', 'hidden').appendTo('#car_modal');
            $('<div></div>').attr('id', 'container').appendTo('#details_car');
            $('#container').empty();
            $('<div></div>').attr('id', 'car_content').appendTo('#container');
            $('#car_content').html(function() {
                var content = "";
                for (row in data) {
                    content += '<br><span>' + row + ': <span id =' + row + '>' + data[row] + '</span></span>';
                }
                return content;
                });
                showModal(title_car = data.brand + " " + data.model, data.id);
        })
        .catch(function() {
            window.location.href = 'index.php?module=errors&op=503&desc=List error';
        });
    });
 }

 $(document).ready(function() {
    loadContentModal();
});