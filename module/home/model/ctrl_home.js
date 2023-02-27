
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

function redirectShop(){
    localStorage.removeItem('filter');
    localStorage.removeItem('homeBodyworkFilter');
    localStorage.removeItem('homeFuelFilter');
    localStorage.removeItem('homeBranFilter');
    // Carroceria
    $(document).on("click", ".filterHomeBodywork", function() {
        var codCat = this.getAttribute('id');
        console.log(codCat);

        var filterCat = [];
        filterCat.push( "cod_bodywork", this.getAttribute('id') );
        JSON.stringify(localStorage.setItem('homeBodyworkFilter', JSON.stringify(filterCat)));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });

    // Tipo motor
    $(document).on("click", ".filterHomeFuel", function() {
        var codFuel = this.getAttribute('id');
        console.log(codFuel);

        var filterFuel = [];
        filterFuel.push( "cod_fuel", this.getAttribute('id'));
        JSON.stringify(localStorage.setItem('homeFuelFilter', JSON.stringify(filterFuel)));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });

    // Brands
    $(document).on("click", ".filterHomeBrand", function() {
        var codBrand = this.getAttribute('id');
        console.log(codBrand);

        var filterBrand = [];
        filterBrand.push("cod_brand", this.getAttribute('id') );
        JSON.stringify(localStorage.setItem('homeBranFilter', JSON.stringify(filterBrand)));

        setTimeout(function() {
            window.location.href = 'index.php?page=ctrl_shop&op=list';
        }, 400);
    });
}

$(document).ready(function() {
    loadCategories();
    loadFuel();
    loadBrands()
    redirectShop();
});