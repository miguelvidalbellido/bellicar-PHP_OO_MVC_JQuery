// BRANDS
function loadBrandSearch() {
    ajaxPromise('module/search/ctrl/ctrl_search.php?op=searchBrands', 'POST', 'JSON')
        .then(function (data) {
            // console.log(data);
            $('<option>Marca</option>').attr('selected', true).attr('disabled', true).appendTo('#selectBrand')
            for (row in data){
                $('<option value="'+ data[row].description +'">'+ data[row].description+'</option>').appendTo('#selectBrand')
            }
        }).catch(function() {
            console.log("ERR: ajaxPromise Brands");
        });
}

// BRAND >> MODEL
function loadCategorySearch(brand) {
    $('#selectModel').empty();
    
    brand === undefined ? promiseLoadCategorySearchAll() : promiseLoadCategorySearchBrand(brand)
    
    function promiseLoadCategorySearchAll(){
        ajaxPromise('module/search/ctrl/ctrl_search.php?op=searchAllModel', 'POST', 'JSON')
        .then(function(data) {
            // console.log(data);
            $('<option>Model</option>').attr('selected', true).attr('disabled', true).appendTo('#selectModel')
            for (row in data){
                $('<option value="'+ data[row].description +'">'+ data[row].description+'</option>').appendTo('#selectModel')
            }
        });
    }

    function promiseLoadCategorySearchBrand(brand){
        ajaxPromise('module/search/ctrl/ctrl_search.php?op=searchModelsBrand', 'POST', 'JSON', brand)
        .then(function(data) {
            // console.log(data);
            if (data == "error"){
            console.log("Error ");
            }else{
                $('<option>Model</option>').attr('selected', true).attr('disabled', true).appendTo('#selectModel')
                for (row in data){
                    $('<option value="'+ data[row].description +'">'+ data[row].description+'</option>').appendTo('#selectModel')
                }
            }
            
        });
    }

}

// BUSCADOR
function launchData(){
    loadBrandSearch();
    loadCategorySearch();

    $(document).on('change', '#selectBrand', function () {
        let brand = $(this).val();
        if (brand === 0) {
            loadCategorySearch();
        } else {
            loadCategorySearch({ brand });
        }
    });
}

// AUTOCOMPLETE
function autocomplete() {

    $("#searchAutocomplete").on("keyup", function () {
        $('#selectBrand').val() != undefined ? console.log(true) : console.log(false);
        $('#selectModel').val() != undefined ? console.log(true) : console.log(false);
    })

}

// SEARCH BUTTON
function buttonSearch(){

    $('#button_search').on('click', function () {
        // console.log('Click Boton');
        // console.log($('#selectBrand').val());
        localStorage.removeItem('filterSearch');
        var filterSearch = [];

        // check brand
        $('#selectBrand').val() != undefined ? filterSearch.push(["Brand", $('#selectBrand').val()]) : console.log("false");
        $('#selectModel').val() != undefined ? filterSearch.push(["Model", $('#selectModel').val()]) : console.log("false");
        console.log(filterSearch);
        localStorage.setItem('filterSearch', JSON.stringify(filterSearch));
    });

}


$(document).ready(function() {
    // console.log("ESTAMOS DENTRO DE SEARCH");
    launchData();
    buttonSearch();
    autocomplete();
});