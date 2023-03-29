function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

function changeMenuAuth() {
    let token = localStorage.getItem('token');
    // console.log(token);
    if(token) {
        ajaxPromise("module/login/ctrl/ctrl_login.php?op=dataUser", 'POST', 'JSON', { 'token': token })
        .then(function (data) { 
            console.log(data);
            $('.men_login').remove();
            $('#dropdown_user').empty();
            // $('<img src="' + data[0]['avatar'] + '" height="50vw" class="img-circle ml-2" id="avt_user">').appendTo('#navbar_user');
            $('<a href="#" id="imageDropdown" data-toggle="dropdown"><img height="40vw" src="'+ data[0]['avatar'] +'"></a>').appendTo('#dropdown_user');
            $('<ul class="dropdown-menu" role="menu" aria-labelledby="imageDropdown"></ul>').appendTo('#dropdown_user')
                .html(
                    '<li role="presentation"><a role="menuitem" tabindex="-1" href="#">'+ data[0]['username']+ '</a></li>'+
                    '<li role="presentation"><a role="menuitem" id="logout" tabindex="-1" href="#">Logout</a></li>'+
                    '<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 3</a></li>'+
                    '<li role="presentation" class="divider"></li>'+
                    '<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Menu item 4</a></li>'
                );
        }).catch(function() {
            console.log("Error al cargar data del usuario");
        });
    } else {
        console.log("No Hay token");
    }

}

function click_logout() {
    $(document).on('click', '#logout', function() {
        logout();
    });

    function logout() {
        ajaxPromise('module/login/ctrl/ctrl_login.php?op=logout', 'POST', 'JSON')
        .then(function(data) {
            // console.log(data);
            localStorage.removeItem('token');
            toastr.success("Logout succesfully");
            window.location.href = "index.php?page=ctrl_shop&op=list";
            // console.log('logout');
        }).catch(function() {
            console.log('Error logout promise');
        });
    }
}

/***********************************
*               ACTIVITY USER              *
***********************************/

function protectUrl() {
    let token = localStorage.getItem('token');
    ajaxPromise('module/login/ctrl/ctrl_login.php?op=controlUser', 'POST', 'JSON', { 'token': token})
    .then(function(data) {
        // console.log(data);
        data == "correctUser" ? console.log("OK --> El usuario coincide con la sesion") : ( console.log("ERROR --> Acesso indebido"), $('#logout').click()) ;
    }).catch(function() {
        console.log('Error promise protectUrl');
    });
}

function controlActivity() {
    let token = localStorage.getItem('token');
    ajaxPromise('module/login/ctrl/ctrl_login.php?op=controlActivity', 'POST', 'JSON', { 'token': token})
    .then(function(data) {
        // console.log(data);
        data == "inactivo" ? ( console.log(" usuario Inactivo"), $('#logout').click()) :  ( data == "activo" ? console.log('usuario Activo') : console.log("No hay usuario logueado") );
    }).catch(function() {
        console.log('Error promise protectUrl');
    });
}

$(document).ready(function() {
    changeMenuAuth();
    click_logout();
    protectUrl();
    setInterval(function() { controlActivity() }, 60000); // 1 min = 60000
})