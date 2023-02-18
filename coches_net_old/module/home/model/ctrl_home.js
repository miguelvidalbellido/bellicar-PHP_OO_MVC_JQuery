
function loadCategories() {
    ajaxPromise('module/home/ctrl/ctrl_home.php?op=homePageCategory','GET', 'JSON')
    .then(function(data) {
        for (row in data) {
            $('<div></div>').attr('class', "card").attr({ 'id': data[row].name_cat }).appendTo('#containerCategories')
                .html(
                    "<div class='card_image'>"+
                    "<img src=" + data[row].img_bodywork +" />"+
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
            $('<div></div>').attr('class', "card").attr({ 'id': data[row].cod_fuel }).appendTo('#containerTypeFuel')
                .html(
                    "<div class='card_image'>"+
                    "<img src=" + data[row].img_fuel +"asda />"+
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

// $(document).ready(function() {
//     loadFuel();
//     loadCategories();
// });

$(function() {
   
    loadCategories();
    loadFuel();
});