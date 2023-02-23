function loadCars() {
    var checkFilter = JSON.parse(localStorage.getItem('filter')) || false;
    var checkFiltersHomeBrand = JSON.parse(localStorage.getItem('homeBranFilter')) || false;
    var checkFiltersHomeFuel = JSON.parse(localStorage.getItem('homeFuelFilter')) || false;
    var checkFiltersHomeBodywork = JSON.parse(localStorage.getItem('homeBodyworkFilter')) || false;

    var checkFilter_type_fuel = localStorage.getItem('type_fuel') || false;
    var checkFilter_brand_name = localStorage.getItem('brand_name') || false;
    var checkFilter_type_shifter = localStorage.getItem('type_shifter') || false;
    var checkFilter_environmental_label = localStorage.getItem('environmental_label') || false;

    getGuestToken()
        .then(function(checkLastFilters) {

            if(checkFiltersHomeBrand != false){
                console.log(checkFiltersHomeBrand);
                localStorage.removeItem('filterHomeBrand');
            }else if(checkFiltersHomeFuel != false){
                console.log(checkFiltersHomeFuel);
                localStorage.removeItem('filterHomeFuel');
            }else if(checkFiltersHomeBodywork != false){
                console.log(checkFiltersHomeBodywork);
                localStorage.removeItem('homeBodyworkFilter');
            }else if(checkFilter != false){
                var filter = JSON.parse(localStorage.getItem('filter'));
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", filter);
                highlightFilter();
            }else if(checkLastFilters != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars");
                loadPreviousSearches();
            }else{
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars");
            }

        })
        .catch(function(error) {
            console.log(error);
        });
}

function getGuestToken(){
    return new Promise(function(resolve,reject){
        
    var checkGuestToken = localStorage.getItem('guest_token') || false;
    if(checkGuestToken == false){
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
            // console.log(e.ip);
            localStorage.setItem('guest_token', e.ip);
        });
    }else{
        console.log("Token - [OK]");

        ajaxPromise("module/shop/ctrl/ctrl_shop.php?op=seeLastFilters", 'POST', 'JSON', { 'token': localStorage.getItem('guest_token') })
        .then(function(data) {
            if(data != "error"){
                var lastFilters = [];
                checkLastFilters = true;

                for(row in data){
                    let str = data[row].filters;
                    let arr = str.split(':');
                    let tmp = [];
                    
                    for(i=0;i<arr.length; i++){
                        tmp = tmp.concat([[arr[i]]]);
                        // console.log(tmp);
                    }
                    console.log(tmp);
                    tmp = [tmp];
                    lastFilters = lastFilters.concat(tmp);
                }

                // console.log(lastFilters);

                localStorage.removeItem('last_filters');
                localStorage.setItem('last_filters', JSON.stringify(lastFilters));
            }
            resolve(checkLastFilters);
            
        }).catch(function() {
            console.log("error ajaxForSearch");
            resolve("Error");
            // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
    }
    });
}

function ajaxForSearch(url,filter){
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
        mapBox_all(data);
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
        mapBox(data[0]);
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
        var filterWithToken = [];
        var token = [];
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

        // Obtenemos el token y almacenamos en filterWithToken [[Token],[filtros]] --> [filtros] --> [[fuel,gasolina],[brand,bmw]]
        token = [localStorage.getItem('guest_token')];
        filterWithToken = token.concat([filter]);
        console.log("Check 1");
        console.log(filterWithToken);

        $('#highlight_searchs').empty();
        // COMPROBAMOS SI ALL_FILTERS TIENE DATOS PARA INCREMENTARLO O CREARLO
        // if(localStorage.getItem('last_filters') !== null){
        //     let filtersAlmacenados = JSON.parse(localStorage.getItem('last_filters'));
        //     let new_search = filtersAlmacenados.concat([filter]);
        //     localStorage.setItem('last_filters', JSON.stringify(new_search));
        // }else{
        //     localStorage.setItem('last_filters', JSON.stringify([filter]));
        // }
        

        highlightFilter();


        if (filterWithToken.length != 0) {
            ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filters_token", filterWithToken);
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
    var checkFilters = JSON.parse(localStorage.getItem('last_filters')) || false;
    
    if(checkFilters != false){
        $('<p>Busquedas anteriores</p>').attr('class', "p-2 p-highlight").appendTo('#highlight_searchs').html();
    }
    loadContentModalLastFilters();
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

function loadContentModalLastFilters() {
    $(document).on('click', '#highlight_searchs', function(){
        
        var all_searchs = JSON.parse(localStorage.getItem('last_filters'))
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
        console.log(positionArrayFilter);

        // Obtenemos el array con los filtros correspondientes
        var allFilters = JSON.parse(localStorage.getItem('last_filters'));
        // console.log(allFilters[positionArrayFilter]); 
        console.log(allFilters[positionArrayFilter]); 



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

// MAPBOX

function mapBox(id) {
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const monument = [id.lon, id.lat];
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [id.lon, id.lat], // starting position [lng, lat]
        zoom: 10 // starting zoom
    });

    // Creamosel popup
    const popup = new mapboxgl.Popup({ offset: 25 }).setText(
    id.brand+' | '+id.model+' | '+id.price
    );
     
    // Creamos elemnto DOM para marker
    const el = document.createElement('div');
    el.id = 'marker';
    el.style.backgroundImage = `url(`+id.img+`)`;
    // console.log(id.img); 

    // Creamos el marker
    new mapboxgl.Marker(el)
    .setLngLat(monument)
    .setPopup(popup) // sets a popup on this marker
    .addTo(map);

}

function mapBox_all(shop) {
    mapboxgl.accessToken = 'pk.eyJ1IjoiMjBqdWFuMTUiLCJhIjoiY2t6eWhubW90MDBnYTNlbzdhdTRtb3BkbyJ9.uR4BNyaxVosPVFt8ePxW1g';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-0.61667, 38.83966492354664], // starting position [lng, lat]
        zoom: 6 // starting zoom
    });

    for (row in shop) {
        // console.log(shop[row]);s
        const monument = [shop[row].lon, shop[row].lat];
        const minPopup = new mapboxgl.Popup()
        minPopup.setHTML('<h3 style="text-align:center;">' + shop[row].brand + '</h3><p style="text-align:center;">Modelo: <b>' + shop[row].model+ '</b></p>' +
            '<p style="text-align:center;">Precio: <b>' + shop[row].price + '€</b></p>' +
            "<button id='" + shop[row].cod_car + "' class='more_info_car btn btn-outline-info mt-3 '>Ver más</button>")
        
        // Creamos elemnto DOM para marker
        const el = document.createElement('div');
        el.id = 'marker';
        el.style.backgroundImage = `url(`+shop[row].image+`)`;
        // console.log(id.img); 

        // Creamos el marker
        new mapboxgl.Marker(el)
        .setLngLat(monument)
        .setPopup(minPopup) // sets a popup on this marker
        .addTo(map);
    }
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