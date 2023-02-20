function loadCars() {
    var checkFilter = JSON.parse(localStorage.getItem('filter')) || false;
    var checkAllFilters = JSON.parse(localStorage.getItem('all_filters')) || false;
    var checkFilter_type_fuel = localStorage.getItem('type_fuel') || false;
    var checkFilter_brand_name = localStorage.getItem('brand_name') || false;
    var checkFilter_type_shifter = localStorage.getItem('type_shifter') || false;
    var checkFilter_environmental_label = localStorage.getItem('environmental_label') || false;

    

    if(checkFilter != false){
        var filter = JSON.parse(localStorage.getItem('filter'));
        ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", filter);
        highlightFilter();
    }else if(checkAllFilters != false){
        ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars");
        loadPreviousSearches();
    }{
        // console.log("No filters found");
        ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars");
    }

    
}

function ajaxForSearch(url,filter){
    // console.log(url);
    // console.log(filter);
    ajaxPromise(url, 'POST', 'JSON', { 'filter': filter })
    .then(function(data) {
        $('#list_cars1').empty(); // Limpiamos el contenido de list_cars
        // console.log(data);
        if (data == "error") {
            $('<div></div>').appendTo('#list_cars1')
                .html(
                    '<div class="alert alert-danger d-flex align-items-center" role="alert">' +
                    '<i class="bi bi-exclamation-triangle-fill me-2 "></i>' +
                    '<div>' +
                    '¡No se han encontrado vehículos con los parámetros establecidos! ' +
                    '¡Sentimos las molestias! ' +
                    '</div>' +
                    '</div>'
                )
        } else {
        for (row in data) {
            $('<div></div>').attr('class', "row justify-content-center mt-1").attr({ 'id': data[row].cod_car }).appendTo('#list_cars1')
                .html(
                    "<div class='col-sm-9 col-md-9 border-top'>"+
                            "<div class='d-flex'>"+
                                "<div class='col-8 mr-3'>"+
                                    "<img class= 'img-fluid rounded d-block m-l-none' src='"+data[row].image+"' >"+
                                "</div>"+
                                "<div class='col-4'>"+
                                "<h2 class='fw-bold text-uppercase csstext-red'>"+ data[row].price +" €</h2>"+
                                "<h5 class='text-center fw-bold text-uppercase'>"+ data[row].brand +" "+data[row].model+" "+data[row].power+" cv "+data[row].doors+"p </h5>"+
                                    // "<p class='pt-4'> Marca: "+ data[row].brand+"</p>"+
                                    "<p class='text-center mt-4'>"+ data[row].province+"  |  "+ data[row].fuel+"</p>"+
                                    "<p class='text-center mt-4'>"+data[row].year+"  |  "+data[row].km+" km </p>"+
                                    "<p class='text-center mt-4 bg-light rounded'>"+ data[row].publication_date+"</p>"+
                                    // "<p class=''> Potencia (cv): "+ data[row].power+"</p>"+
                                "<button id='" + data[row].cod_car + "' class='more_info_car btn btn-outline-info mt-3 '>Ver más</button>"+
                                "</div>"+
                            "</div>"+
                    "</div>"
                )
        }   
        }
    }).catch(function() {
        console.log("error ajaxForSearch");
        // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}

/**
 * DEPRECATED -> loadlCars new
 */
function loadCars_old() {
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=all_cars','GET', 'JSON')
    .then(function(data) {


        if (data == "error") {
            $('<div></div>').appendTo('#list_cars')
                .html(
                    '<h3>¡No se han encontrado vehículos!</h3>'
                )
        } else {
        for (row in data) {
            $('<div></div>').attr('class', "row justify-content-center mt-1").attr({ 'id': data[row].cod_car }).appendTo('#list_cars1')
                .html(
                    "<div class='col-sm-9 col-md-9 border-top'>"+
                            "<div class='d-flex'>"+
                                "<div class='col-8 mr-3'>"+
                                    "<img class= 'img-fluid rounded d-block m-l-none' src='"+data[row].image+"' >"+
                                "</div>"+
                                "<div class='col-4'>"+
                                "<h2 class='fw-bold text-uppercase csstext-red'>"+ data[row].price +" €</h2>"+
                                "<h5 class='text-center fw-bold text-uppercase'>"+ data[row].brand +" "+data[row].model+" "+data[row].power+" cv "+data[row].doors+"p </h5>"+
                                    // "<p class='pt-4'> Marca: "+ data[row].brand+"</p>"+
                                    "<p class='text-center mt-4'>"+ data[row].province+"  |  "+ data[row].fuel+"</p>"+
                                    "<p class='text-center mt-4'>"+data[row].year+"  |  "+data[row].km+" km </p>"+
                                    "<p class='text-center mt-4 bg-light rounded'>"+ data[row].publication_date+"</p>"+
                                    // "<p class=''> Potencia (cv): "+ data[row].power+"</p>"+
                                "<button id='" + data[row].cod_car + "' class='more_info_car btn btn-outline-info mt-3 '>Ver más</button>"+
                                "</div>"+
                            "</div>"+
                    "</div>"
                )
        }   
        }
    }).catch(function() {
        window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}

function details_car(cod_car) {

    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=details_car&id=' + cod_car,'GET', 'JSON')
    .then(function(data) {
    $('#list_cars').empty();
        
        for (row in data[1][0]) {
            $('<swiper-slide></swiper-slide>').appendTo('#container-date-img')
                .html(
                    "<img src='"+ data[1][0][row].url_image +"' >"
                )
        }

        $('<div></div>').attr({ 'id': data[0].id_car, class: 'date_car_dentro' }).appendTo('.date_car')
            .html(
                "<div class='list_product_details'>" +
                "<div class='product-info_details'>" +
                "<div class='product-content_details'>" +
                "<h1 class='text-center'><b>" + data[0].brand + " " + data[0].model + "</b></h1>" +
                "<hr class=hr-shop>" +
                "<table id='table-shop'> <tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-road fa-2xl'></i> &nbsp;" + data[0].km + " KM" + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-person fa-2xl'></i> &nbsp;" + data[0].shifter + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-car fa-2xl'></i> &nbsp;" + data[0].bodywork + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-door-open fa-2xl'></i> &nbsp;" + data[0].doors + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-gas-pump fa-2xl'></i> &nbsp;" + data[0].type_motor + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-calendar-days fa-2xl'></i> &nbsp;" + data[0].enrollment_date + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-palette fa-2xl'></i> &nbsp;" + data[0].color + "</td>" +
                "<td> <i class='fa-solid fa-location-dot fa-2xl'></i> &nbsp;" + data[0].population + "</td> </tr>" +
                "<td> <h2 class='fw-bold text-uppercase csstext-red'>" + data[0].price + " €</h2></td>  </tr>" +
                "</table>" +
                "<hr class=hr-shop>" +
                "<h3><b>" + "More Information:" + "</b></h3>" +
                "<p>This vehicle has a 2-year warranty and reviews during the first 6 months from its acquisition.</p>" +
                "<div class='buttons_details'>" +
                "<a class='button add' href='#'>Add to Cart</a>" +
                "<a class='button buy' href='#'>Buy</a>" +
                // "<span class='button' id='price_details'>" + data[0].price + "<i class='fa-solid fa-euro-sign'></i> </span>" +
                "<a class='details__heart' id='" + data[0].id_car + "'><i id=" + data[0].id_car + " class='fa-solid fa-heart fa-lg'></i></a>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</div>"
            )
}).catch(function() {
    // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Load_Details SHOP";
});
}

// MENU LATERAL
function loadLateralMenu() {
    ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=lateral_menu','GET', 'JSON')
    .then(function(data) {
        // console.log(data);s
        if (data == "error") {
            $('<div></div>').appendTo('#lateral_menu')
                .html(
                    '<h3>¡ERROR MENU!</h3>'
                )
        } else {
            // Fuel
            $('<h5></h5>').appendTo("#fuel")
            .html(
                "Combustible: "
            )

            // Select fuel

            // $('<select></select>').attr('class', "custom-selected").attr('id', "fuel").appendTo('#fuel_div')
            //         .html(  
            //             "<option value='*'>Todas</option>"
            //          )

            
            // Fuel
            for (row in data[0]) {
                $('<option></option>').attr({ 'value': data[0][row].type_fuel }).attr({ 'id': data[0][row].type_fuel }).appendTo('#fuel')
                    .html(
                        data[0][row].type_fuel    
                    )
            }

            // Brand
            for (row in data[1][0]) {
                $('<option></option>').attr({ 'value': data[1][0][row].brand_name }).appendTo('#brand')
                    .html(
                        data[1][0][row].brand_name    
                    )
            }

            // Shifter
            for (row in data[2][0]) {
                $('<option></option>').attr({ 'value': data[2][0][row].type_shifter }).appendTo('#shifter')
                    .html(
                        data[2][0][row].type_shifter    
                    )
            }

            // Enviromental label
            for (row in data[3][0]) {
                $('<option></option>').attr({ 'value': data[3][0][row].environmental_label }).appendTo('#environmental_label')
                    .html(
                        data[3][0][row].environmental_label    
                    )
            }

            // Button sumbit
            $('<div></div>').appendTo('#lateral_menu')
            .html(
                "<button class='btn btn-outline-success mt-3 filter_button'>Aplicar</button>"+
                "<button class='btn btn-outline-danger mt-3 remove_button'>Restablecer</button>"
            )
    }
        // console.log(data);
    }).catch(function() {
        window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });

    
    
}


function clicks() {
    $(document).on("click", ".more_info_car", function() {
        var cod_car = this.getAttribute('id');
        details_car(cod_car);
    });
}

function filter_button(){

    // Almacenamos la selección del cliente en local storage
    $('#fuel').change(function() {
        localStorage.setItem('type_fuel', this.value);
    });
    $('#brand').change(function() {
        localStorage.setItem('brand_name', this.value);
    });
    $('#shifter').change(function() {
        localStorage.setItem('type_shifter', this.value);
    });
    $('#environmental_label').change(function() {
        localStorage.setItem('environmental_label', this.value);
    });
    // Al clickar el boton almacenaremos los filtros seleccionados en un array
    // para posteriormente trabajar sobre data en el servidor
    $(document).on('click', '.filter_button', function(){
        var filter = [];

        if(localStorage.getItem('type_fuel')) {
            filter.push(['fuel', localStorage.getItem('type_fuel')])
        }
        if(localStorage.getItem('brand_name')) {
            filter.push(['brand', localStorage.getItem('brand_name')])
        }
        if(localStorage.getItem('type_shifter')) {
            filter.push(['type_shifter', localStorage.getItem('type_shifter')])
        }
        if(localStorage.getItem('environmental_label')) {
            filter.push(['environmental_label', localStorage.getItem('environmental_label')])
        }

        localStorage.setItem('filter', JSON.stringify(filter));
        $('#highlight_searchs').empty();
        // COMPROBAMOS SI ALL_FILTERS TIENE DATOS PARA INCREMENTARLO O CREARLO
        if(localStorage.getItem('all_filters') !== null){
            let filtersAlmacenados = JSON.parse(localStorage.getItem('all_filters'));
            let new_search = filtersAlmacenados.concat([filter]);
            localStorage.setItem('all_filters', JSON.stringify(new_search));
        }else{
            localStorage.setItem('all_filters', JSON.stringify([filter]));
        }
        

        highlightFilter();


        if (filter.length != 0) {
            ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", filter);
        }
        else {
            ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars");
        }
    });

    remove_filters();
    
}


function remove_filters(){
    $(document).on('click', '.remove_button', function(){
        localStorage.removeItem('filter');
        localStorage.removeItem('type_fuel');
        localStorage.removeItem('brand_name');
        localStorage.removeItem('type_shifter');
        localStorage.removeItem('environmental_label');
        location.reload();
    }); 
}

function highlightFilter() {
    var filters = JSON.parse(localStorage.getItem('filter'));
    // console.log(all_filter);
    $('#highlight').empty(); // Limpiamos el contenido de highlight

    for (var i = 0; i < filters.length; i++){
        if(filters[i][0] == "fuel"){
            
            $("#fuel").find("option[value='"+filters[i][1]+"']").prop("selected", true);
            $('<p>'+filters[i][1]+'</p>').attr('class', "p-2 p-highlight").appendTo('#highlight').html();

        }else if(filters[i][0] == "brand"){

            $("#brand").find("option[value='"+filters[i][1]+"']").prop("selected", true);
            $('<p>'+filters[i][1]+'</p>').attr('class', "p-2 p-highlight").appendTo('#highlight').html();
        
        }else if(filters[i][0] == "environmental_label"){

            $("#environmental_label").find("option[value='"+filters[i][1]+"']").prop("selected", true);
            $('<p>'+filters[i][1]+'</p>').attr('class', "p-2 p-highlight").appendTo('#highlight').html();
            
        }else if(filters[i][0] == "type_shifter"){

            $("#type_shifter").find("option[value='"+filters[i][1]+"']").prop("selected", true);
            $('<p>'+filters[i][1]+'</p>').attr('class', "p-2 p-highlight").appendTo('#highlight').html();
        }
    }
    
}

// Mostrar busquedas anteriores
function loadPreviousSearches(){
    var checkFilters = JSON.parse(localStorage.getItem('all_filters')) || false;
    
    if(checkFilters != false){
        $('<p>Busquedas anteriores</p>').attr('class', "p-2 p-highlight").appendTo('#highlight_searchs').html();
    }
    loadContentModal();
}

function modalSearchs(){
        // $("#details_car").show();
        $("#view_searchs").dialog({
            title: "Mis búsquedas recientes",
            width : 850,
            height: 500,
            resizable: "false",
            modal: "true",
            hide: "fold",
            show: { effect: "blind", duration: 800 },
        });
}

function loadContentModal() {
    $(document).on('click', '#highlight_searchs', function(){
        
        var all_searchs = JSON.parse(localStorage.getItem('all_filters'))
        // console.log(all_searchs);
        $('#view_searchs').empty();
        for (var i = 0; i < all_searchs.length; i++){
            modalSearchs($('<p>'+all_searchs[i]+'</p>').attr('value', i).attr('class', "p-2 p-highlight text-center bg-light font-weight-bold rounded ").attr('id', "search").appendTo('#view_searchs').html()); 
        }
        
    });

    // Cuando el cliente realize click recuperamos el value (posicion que queremos del array)
    // Obtenemos el contendio y lo pasamos a ajaxforsearch y recargamos la pagina
    $(document).on('click', '#search', function(){
        // Obtenemos el valor de i en el array
        var positionArrayFilter = this.getAttribute('value');
        // console.log(positionArrayFilter);

        // Obtenemos el array con los filtros correspondientes
        var allFilters = JSON.parse(localStorage.getItem('all_filters'));
        // console.log(allFilters[positionArrayFilter]); 

        if (allFilters[positionArrayFilter].length != 0) {
            ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", allFilters[positionArrayFilter]);
            // $('#view_searchs').hide();
            localStorage.removeItem('filter');
            localStorage.setItem('filter', JSON.stringify(allFilters[positionArrayFilter]));
            $('#highlight_searchs').empty();
            $("#view_searchs").dialog("close");
            highlightFilter();
        }
        


    });
 }



// PRUEBAS //

// async function loadPage() {
//     loadLateralMenu();
//     loadCars();
// }

// async function test1() {

//     let promise = new Promise((resolve, reject) => {
//         setTimeout(() => resolve(loadLateralMenu()), 1000)
//     });

//     await promise;
//     loadCars();    
// }

$(document).ready(function() {
    loadLateralMenu();
    loadCars();
    filter_button();
    // test1();
    // loadPage();
    clicks();
    
});