
function loadBrands() {
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageBrands','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<swiper-slide></swiper-slide>').attr({ 'id': data[row].name_cat }).appendTo('#containerBrands')
                .html(
                    "<img src='"+ data[row].img_brand +"' >"
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
            $('<div></div>').attr('class', "card card1").attr({ 'id': data[row].name_cat }).appendTo('#containerCategories')
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
            $('<div></div>').attr('class', "card card1").attr({ 'id': data[row].cod_fuel }).appendTo('#containerTypeFuel')
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

$(document).ready(function() {
    loadCategories();
    loadFuel();
    loadBrands();
});