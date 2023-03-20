function loadCars(total_prod = 0, items_page=4) {
    var checkFilter = JSON.parse(localStorage.getItem('filter')) || false;
    var checkFiltersHomeBrand = JSON.parse(localStorage.getItem('homeBranFilter')) || false;
    var checkFiltersHomeFuel = JSON.parse(localStorage.getItem('homeFuelFilter')) || false;
    var checkFiltersHomeBodywork = JSON.parse(localStorage.getItem('homeBodyworkFilter')) || false;
    var checkFiltersSearch = JSON.parse(localStorage.getItem('filterSearch')) || false;
    var checkFiltersHomeModel = JSON.parse(localStorage.getItem('homeModelFilter')) || false;
    

    getGuestToken()
        .then(function(checkLastFilters) {
            // console.log(checkLastFilters);
            // console.log(JSON.parse(localStorage.getItem('filterSearch')));
            if(checkFiltersHomeModel != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", [checkFiltersHomeModel]);
                saveFiltersAppliedForShort(checkFiltersHomeModel);
                // localStorage.removeItem('homeModelFilter');
            }else if(checkFiltersSearch != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", checkFiltersSearch);
                saveFiltersAppliedForShort(checkFiltersSearch);
                // localStorage.removeItem('filterSearch');
            }else if(checkFiltersHomeBrand != false){
                // ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", [checkFiltersHomeBrand]);
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", checkFiltersHomeBrand, total_prod, items_page);
                saveFiltersAppliedForShort(checkFiltersHomeBrand);
                // localStorage.removeItem('homeBranFilter');
            }else if(checkFiltersHomeFuel != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", checkFiltersHomeFuel, total_prod, items_page);
                saveFiltersAppliedForShort(checkFiltersHomeFuel);
                // localStorage.removeItem('homeFuelFilter');
            }else if(checkFiltersHomeBodywork != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", checkFiltersHomeBodywork, total_prod, items_page);
                saveFiltersAppliedForShort(checkFiltersHomeBodywork);
                // localStorage.removeItem('homeBodyworkFilter');
            }else if(checkFilter != false){
                var filter = JSON.parse(localStorage.getItem('filter'));
                saveFiltersAppliedForShort(checkFilter);
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", filter, total_prod, items_page);
                highlightFilter();
            }else if(checkLastFilters != false){
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars", undefined, total_prod, items_page);
                console.log(items_page);
                loadPreviousSearches();
            }else{
                ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=all_cars", undefined, total_prod, items_page);
                console.log(items_page);
                console.log("asdsad");
            }
            
            pagination();

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
        // console.log("Token - [OK]");

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
                        tmp = tmp.concat([arr[i].split(",")]);
                        // console.log(arr[i].split(","));
                        // console.log(tmp);
                    }
                    // console.log(tmp);
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
            resolve("false");
            // window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
        });
    }
    });
}

function saveFiltersAppliedForShort(filtersApplied){
    localStorage.setItem('filters_applied', JSON.stringify(filtersApplied));
    console.log(localStorage.getItem('filters_applied'));
}

function ajaxForSearch(url,filter,total_prod = 0, items_page = 3){
    ajaxPromise(url, 'POST', 'JSON', { 'filter': filter, 'total_prod': total_prod, 'items_page': items_page  })
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
                                "<button id='" + data[row].cod_car + "' class='more_info_car mt-3 button-86' role='button'>Ver más</button>"+
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
                "<td> <i id='col-ico' class='fa-solid fa-road fa-lg'></i> &nbsp;" + data[0].km + " KM" + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-person fa-lg'></i> &nbsp;" + data[0].shifter + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-car fa-lg'></i> &nbsp;" + data[0].bodywork + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-door-open fa-lg'></i> &nbsp;" + data[0].doors + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-gas-pump fa-lg'></i> &nbsp;" + data[0].type_motor + "</td>" +
                "<td> <i id='col-ico' class='fa-solid fa-calendar-days fa-lg'></i> &nbsp;" + data[0].enrollment_date + "</td>  </tr>" +
                "<td> <i id='col-ico' class='fa-solid fa-palette fa-lg'></i> &nbsp;" + data[0].color + "</td>" +
                "<td> <i class='fa-solid fa-location-dot fa-lg'></i> &nbsp;" + data[0].population + "</td> </tr>" +
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

loadSimiarCars(cod_car);
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
                "<button class='button-87 mt-3 filter_button' role='button'>Aplicar</button>"+
                "<button class='button-88 mt-3 remove_button' role='button'>Restablecer</button>"
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

// ==================== FILTER BUTTON ==================== //

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
        saveFiltersAppliedForShort(filter);
        // Obtenemos el token y almacenamos en filterWithToken [[Token],[filtros]] --> [filtros] --> [[fuel,gasolina],[brand,bmw]]
        token = [localStorage.getItem('guest_token')];
        filterWithToken = token.concat([filter]);
        // console.log("Check 1");
        // console.log(filterWithToken);

        $('#highlight_searchs').empty();
        

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

// ==================== REMOVE FILTERS ==================== //

function remove_filters(){
    $(document).on('click', '.remove_button', function(){
        localStorage.removeItem('filter');
        localStorage.removeItem('type_fuel');
        localStorage.removeItem('brand_name');
        localStorage.removeItem('type_shifter');
        localStorage.removeItem('environmental_label');
        localStorage.removeItem('homeBranFilter');
        localStorage.removeItem('homeFuelFilter');
        localStorage.removeItem('homeBodyworkFilter');
        localStorage.removeItem('filters_applied');
        localStorage.removeItem('page');
        
        location.reload();
    }); 
}

// ==================== HIGHLIHT FILTERS ==================== //

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

// ==================== LAST SEARCHS ==================== //
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
            saveFiltersAppliedForShort(all_searchs);
        }
        
    });

    // Cuando el cliente realize click recuperamos el value (posicion que queremos del array)
    // Obtenemos el contendio y lo pasamos a ajaxforsearch y recargamos la pagina
    $(document).on('click', '#search', function(){
        // Obtenemos el valor de i en el array
        var positionArrayFilter = this.getAttribute('value');
        // console.log(positionArrayFilter);

        // Obtenemos el array con los filtros correspondientes
        var allFilters = JSON.parse(localStorage.getItem('last_filters'));
        // console.log(allFilters[positionArrayFilter]); 
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

// ==================== MAPBOX ==================== //

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
            "<button id='" + shop[row].cod_car + "' class='more_info_car mt-3 button-86' role='button'>Ver más</button>")
        
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

// ==================== SHORT (ORDER BY) ==================== //
function detectChangeShort(){
    $(document).on('change', '#order', function () {
        let short = $(this).val();
        console.log(short);


        let filtrosAplicados = JSON.parse(localStorage.getItem('filters_applied')); 
        filtrosAplicados === null ? filtrosAplicados = [["ORDER BY", short]] : filtrosAplicados.push(["ORDER BY", short]); 
        
        let filtrosOrder = filtrosAplicados;
        // console.log(filtrosOrder);

        filtrosAplicados != 0 ? appliOrderBy(filtrosOrder) : console.log(false);

        function appliOrderBy(filtros){
            ajaxForSearch("module/shop/ctrl/ctrl_shop.php?op=filter", filtros);
        }
    });
}

// ==================== PRODUCTOS SIMILARES ==================== //
// Pintamos los 3 primeros vehículos, cuando el scroll sea 95% o superior, comprobaremos si hay más coches y pintaremos los nuevos vehículos.
function loadSimiarCars(id){
let limit = 3;

    searchSimilarCars(id, limit);
    
    moreCarsScroll();

    function searchSimilarCars(id, limit){
        // $('.title_similar').empty();
        //     $('<h4>Vehículos similares</h4>').attr('class', 'mt-2 mb-5 title_similar').appendTo('.title_similarsCars');
        ajaxPromise('module/shop/ctrl/ctrl_shop.php?op=loadSimilarCars', 'POST', 'JSON', { 'id': id })
        .then(function (data) {
            $('#similarCars').empty();
            
            // console.log(data);
            limit_for = checkLimit(data,limit);
            for(let i = 0; i < limit_for; i++){
                $('<div></div>').attr('class','col-lg-4 col-md-6 mb-4').appendTo('#similarCars')
                .html(
                    '<div class="card">'+
                        '<div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light data-mdb-ripple-color="light"">'+
                            '<img src="'+ data[i].image +'" class="w-100" />'+
                            '<a href="#!">'+
                                '<div class="mask">'+
                                    '<div class="d-flex justify-content-start align-items-end h-100">'+
                                        '<h5><span class="badge bg-primary ms-2">'+data[i].state+'</span></h5>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="hover-overlay">'+
                                    '<div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>'+
                                '</div>'+
                            '</a>'+
                        '</div>'+
                        '<div class="card-body">'+
                            '<a href="" class="text-reset">'+
                                '<h5 class="card-title mb-3">'+data[i].brand+' '+data[i].model+'</h5>'+
                            '</a>'+
                            '<a href="'+data[i].cod_car+'" class="more_info_car text-reset">'+
                                '<p>'+data[i].fuel+'</p>'+
                            '</a>'+
                            '<h6 class="mb-3">'+data[i].price+'</h6>'+
                        '</div>'+
                    '</div>'
                );
            }
        }).catch(function () {
            console.log("Error load similar cars");
        })
    };

    function checkLimit(data, limit){
        let end_for = 0;
        end_for = data.length > limit ? limit : data.length;
        return end_for;
    }

    function moreCarsScroll(){
        function amountscrolled(){
            var winheight = $(window).height()
            var docheight = $(document).height()
            var scrollTop = $(window).scrollTop()
            var trackLength = docheight - winheight
            var pctScrolled = Math.floor(scrollTop/trackLength * 100) // gets percentage scrolled (ie: 80 NaN if tracklength == 0)
                if (pctScrolled > 95){
                    let limitIncrement = limit + 3;
                    searchSimilarCars(id, limitIncrement);
                }
            }
        
            $(window).on("scroll", function(){
            amountscrolled();
            })
    }

}

// ==================== PAGINATION ====================  //


function pagination(){

    var filters_applied = JSON.parse(localStorage.getItem('filters_applied')) || false;
    // console.log(filters_applied);
    url = filters_applied != false ? 'module/shop/ctrl/ctrl_shop.php?op=count_cars_filter' :  'module/shop/ctrl/ctrl_shop.php?op=count_all_cars';
    sdata = filters_applied != false ? {'filter': filters_applied} : undefined;

    
    ajaxPromise(url, 'POST', 'JSON', sdata)
        .then(function(data) {
            console.log(data);
            var total_prod = data[0].cant_coches;

            console.log(data[0].cant_coches);

            if (total_prod >= 4) {
                total_pages = Math.ceil(total_prod / 4);
            } else {
                total_pages = 1;
            }

            $('#show_paginator').bootpag({
                total: total_pages,
                page: localStorage.getItem('page') ? localStorage.getItem('page') : 1,
                maxVisible: total_pages
            }).on('page', function(event, num)
            {
                localStorage.setItem('page', num);
                // localStorage.removeItem('id_car');
                total_prod = 4 * (num - 1);
                if (total_prod == 0) {
                    localStorage.setItem('total_prod', 0)
                }
                loadCars(total_prod, 4);
                // $('html, body').animate({ scrollTop: $(".list__content") });
            });
        }).catch(function() {
            console.log('Fail pagination');
        });
}



$(document).ready(function() {
    
    loadLateralMenu();
    loadCars();
    filter_button();
    clicks();
    detectChangeShort();
    // pagination();
});