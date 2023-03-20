
function loadBrands() {
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageBrands','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<swiper-slide></swiper-slide>').attr({ 'id': data[row].cod_brand }).attr({ 'class': 'filterHomeBrand' }).appendTo('#containerBrands')
                .html(
                    "<img id="+data[row].cod_brand+" src='"+ data[row].img_brand +"' >"
                )
        }
    }).catch(function() {
        window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });

}

function loadCategories() {
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageCategory','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "card card1 filterHomeBodywork").attr({ 'id': data[row].cod_bodywork }).appendTo('#containerCategories')
                .html(
                    "<div class='card_image'>"+
                    "<img draggable='false' src=" + data[row].img_bodywork +" />"+
                    "</div>"+
                    "<div class='card_title title-black'>"+
                    "<p>" + data[row].description + "</p>"+
                    "</div>"
                )
        }
    }).catch(function() {
        window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Type_Categories HOME";
    });
}


function loadFuel() {
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageFuel','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "card card1 filterHomeFuel").attr({ 'id': data[row].cod_fuel }).appendTo('#containerTypeFuel')
                .html(
                    "<div class='card_image'>"+
                    "<img draggable='false' src=" + data[row].img_fuel +" />"+
                    "</div>"+
                    "<div class='card_title title-black'>"+
                    "<p>" + data[row].description + "</p>"+
                    "</div>"
                )
        }
    }).catch(function() {
        window.location.href = "index.php?module=ctrl_exceptions&op=503&type=503&lugar=Types_car HOME";
    });
}

function loadMoreVisits(){
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homeMoreVisits','GET','JSON')
    .then(function (data) {
        // console.log(data);
        for (row in data) {
            $('<div></div>').attr('class', "card card1 filterHomeModelVisits").attr({ 'id': data[row].description }).appendTo('#containerModelVisits')
                .html(
                    "<div class='card_image'>"+
                    "<img draggable='false' src=" + data[row].url_image +" />"+
                    "</div>"+
                    "<div class='card_title title-black'>"+
                    "<p>" + data[row].description + "</p>"+
                    "</div>"
                )
        }
    });
}

function redirectShop(){
    localStorage.removeItem('filter');
    localStorage.removeItem('homeBodyworkFilter');
    localStorage.removeItem('homeFuelFilter');
    localStorage.removeItem('homeBranFilter');
    localStorage.removeItem('homeModelFilter');

    // Model Visits
    $(document).on("click", ".filterHomeModelVisits", function() {
        var model = this.getAttribute('id');
        console.log(model);

        var filterModel = [];
        filterModel.push( "model", this.getAttribute('id') );
        JSON.stringify(localStorage.setItem('homeModelFilter', JSON.stringify(filterModel)));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });

    // Carroceria
    $(document).on("click", ".filterHomeBodywork", function() {
        var codCat = this.getAttribute('id');
        // console.log(codCat);

        var filterCat = [];
        filterCat.push( "cod_bodywork", this.getAttribute('id') );
        JSON.stringify(localStorage.setItem('homeBodyworkFilter', JSON.stringify([filterCat])));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });

    // Tipo motor
    $(document).on("click", ".filterHomeFuel", function() {
        var codFuel = this.getAttribute('id');
        // console.log(codFuel);

        var filterFuel = [];
        filterFuel.push( "cod_fuel", this.getAttribute('id'));
        JSON.stringify(localStorage.setItem('homeFuelFilter', JSON.stringify([filterFuel])));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });

    // Brands
    $(document).on("click", ".filterHomeBrand", function() {
        // console.log(codBrand);s

        var filterBrand = [];
        filterBrand.push("cod_brand", this.getAttribute('id') );
        JSON.stringify(localStorage.setItem('homeBranFilter', JSON.stringify([filterBrand])));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });
}

// =========== API CARS =========== //
function getBooks(){
    let limit = 2;
    searchCars();
    detectMoreCars();

    function searchCars(){
    // let limit = 2;
    $('#containerBooks').empty();
    $('#load_books_button').empty();

    ajaxPromise('https://www.googleapis.com/books/v1/volumes?q=Cars', 'GET', 'JSON')
    .then(function (data){
        $("<button class='more_load_books mt-3 button-86' role='button'>Ver más</button>").appendTo('#load_books_button');
        
        console.log(data.items.length = limit);
        console.log(limit);

        data.items.length = limit;
        
        for(let i = 0; i < data.items.length; i++){
            $('<div></div>').attr('class', "col-lg-6 mt-4").appendTo('#containerBooks')
                .html(
                    "<div class='member d-flex align-items-start' data-aos='zoom-in' data-aos-delay='300'>"+
                        "<div class='pic'> <img src='"+ data.items[i].volumeInfo.imageLinks.thumbnail +"' class='img-fluid' alt=''></div>"+ // Load Image
                        "<div class='member-info'>"+
                            "<h4>"+data.items[i].volumeInfo.title+"</h4>"+
                            "<span>"+data.items[i].volumeInfo.publishedDate+"</span>"+
                            "<p>"+data.items[i].volumeInfo.authors[0]+"</p>"+
                        "</div>"+
                    "</div>"
                )
            // console.log(data.items[i]);
        }
        
    }).catch(function (){
        $("<p class='warning'>No hay mas libros</p>").appendTo('#load_books_button');
        $('.more_load_books').prop('disabled', true);
        $('.more_load_books').removeClass('button-86');
        $('.more_load_books').addClass('button-88');
        // console.log("ajaxPromise getBooks error");
    });
    }

    

    function detectMoreCars(){
        $(document).on("click", ".more_load_books", function() {
            limit = limit + 2;
            searchCars();
        });
    }

}

$(document).ready(function() {
    loadCategories();
    loadFuel();
    loadBrands()
    redirectShop();
    loadMoreVisits();
    getBooks();
});