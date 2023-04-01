
/***********************************
*     DASHBOARD FOR USERS          *
***********************************/

// Tabla de usuarios
function launchUsersData() {
    ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=dataUsers','GET', 'JSON')
    .then(function(data) {
        // console.log(data);
        $('#usersLauncher').empty();
        for (row in data) {
            $('<tr></tr>').appendTo('#usersLauncher')
                .html(
                    '<td>'+
                        '<img alt="..." src="'+data[row]['avatar']+'" class="avatar avatar-sm rounded-circle me-2">'+
                        '<a class="text-heading font-semibold" href="#">'+data[row]['username']+'</a>'+
                    '</td>'+
                    '<td>'+data[row]['d_registration']+'</td>'+
                    '<td>'+data[row]['d_birth']+'</td>'+
                    '<td>'+
                        '<span class="badge badge-lg badge-dot"><i class="bg-success"></i>'+data[row]['user_type']+'</span>'+
                   '</td>'+
                   '<td>'+data[row]['email']+'</td>'+
                   '<td class="text-end">'+
                   '<button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover" id="updateUser" value="'+data[row]['username']+'"><i class="bi bi-pencil"></i></button>'+
                    '<button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover" id="viewUser" value="'+data[row]['username']+'"><i class="bi bi-search"></i></button>'+
                        '<button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover delete_user" value="'+data[row]['username']+'">'+
                            '<i class="bi bi-trash"></i>'+
                        '</button>'+
                    '</td>'
                )
        }
    }).catch(function() {
        console.log("ERR: Launch Data Users");
    });
}

// Detectamos clicks para borrar
function deleteUser(){

    // Comprobamos si realiza click en eliminar
    $(document).on("click", ".delete_user", function() {
        let username = $(this).val();
        modalDeleteUser(username);   
    });

    // El usuario confirma el boorado
    $(document).on("click", "#confirmDeleteUser", function() {
        let username = $(this).val();

        ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=deleteUser','POST', 'JSON', { 'username': username })
            .then(function(data) {
            launchUsersData();
            data == true ? toastr.info("Usuario eliminado correctamente") : toastr.success("Error al eliminar el usuario");
            $('#modalConfirmDelete').modal("hide");
        }).catch(function() {
        console.log("ERR: Delete User");
        });
    });
}
// Carga el modal para eliminar usuarios
function modalDeleteUser(username){
    
    $('#launchModals').empty();
    ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=dataOneUser','POST', 'JSON', { 'username': username })
            .then(function(data) {
            console.log(data);
            $('<div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalConfirmDelete" aria-hidden="true"></div>').appendTo('#launchModals')
            .html(
                '<div class="modal-dialog">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                    '<h5 class="modal-title" id="exampleModalLabel">Esta seguro que desea eliminar al usuario</h5>'+
                    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
                    '</div>'+
                    '<div class="modal-body">'+
                    '<h5>Username: '+data[0]['username']+' </h5>'+
                    '<p>Username: '+data[0]['email']+' <p>'+
                    '<p>Username: '+data[0]['user_type']+' </p>'+
                    '</div>'+
                    '<div class="modal-footer">'+
                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>'+
                    '<button type="button" value="'+data[0]['username']+'" id="confirmDeleteUser" class="btn btn-warning">Eliminar</button>'+
                    '</div>'+
                '</div>'+
                '</div>'
            );
            $('#modalConfirmDelete').modal("show"); // Mostramos el modal
        }).catch(function() {
            console.log("ERR: Data One User");
        });

}

// Modal y detecta click para ver datos de un usuario
function viewDataUser(){

    $(document).on("click", "#viewUser", function() {

        let username = $(this).val();
        $('#launchModals').empty();

        ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=dataOneUser','POST', 'JSON', { 'username': username })
                .then(function(data) {
                console.log(data);
                $('<div class="modal fade" id="modalViewUser" tabindex="-1" aria-labelledby="modalConfirmDelete" aria-hidden="true"></div>').appendTo('#launchModals')
                .html(
                    '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<h5 class="modal-title" id="exampleModalLabel">Información del usuario: '+data[0]['username']+'</h5>'+
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
                        '</div>'+
                        '<div class="modal-body">'+
                        '<table class="table table-dark">'+
                        '<tr>'+
                            '<th>Username</th>'+
                            '<td>'+data[0]['username']+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<th>Email</th>'+
                            '<td>'+data[0]['email']+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<th>fecha nacimiento</th>'+
                            '<td>'+data[0]['d_birth']+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<th>fecha de alta</th>'+
                            '<td>'+data[0]['d_registration']+'</td>'+
                        '</tr>'+
                        '</table>'+
                        '</div>'+
                        '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
                        '</div>'+
                    '</div>'+
                    '</div>'
                );
                $('#modalViewUser').modal("show"); // Mostramos el modal
            }).catch(function() {
                console.log("ERR: Data One User");
            });

    });
}

function updateDataUser(){

    $(document).on("click", "#updateUser", function() {

        let username = $(this).val();
        $('#launchModals').empty();

        ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=dataOneUser','POST', 'JSON', { 'username': username })
                .then(function(data) {
                console.log(data);
                $('<div class="modal fade" id="modalupdateUser" tabindex="-1" aria-labelledby="modalConfirmDelete" aria-hidden="true"></div>').appendTo('#launchModals')
                .html(
                    '<div class="modal-dialog">'+
                    '<div class="modal-content">'+
                        '<div class="modal-header">'+
                        '<h5 class="modal-title" id="exampleModalLabel">Modificar al usuario: '+data[0]['username']+'</h5>'+
                        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
                        '</div>'+
                            '<div class="modal-body">'+
                            '<form class="mx-1 mx-md-4" id="updateForm" method="post">'+

                            // CAMPOS OCULTOS PARA VALIDAR USUARIO Y CORREO POSTERIORMENTE
                            '<input type="text"  style="display:none" id="usernameRegisterDb" name="usernameRegisterDb" class="form-control" value="'+data[0]['username']+'"/>'+
                            ' <input type="email" style="display:none" id="emailRegisterDb" name="emailRegisterDb" class="form-control" value="'+data[0]['email']+'" />'+
                            ' <input type="email" style="display:none" id="passwordRegisterDb" name="passwordRegisterDb" class="form-control" value="'+data[0]['password']+'" />'+

                            '<div class="d-flex flex-row align-items-center mb-4">'+
                                '<i class="fas fa-user fa-lg me-3 fa-fw"></i>'+
                                '<div class="form-outline flex-fill mb-0">'+
                                    '<input type="text" id="usernameRegister" name="usernameRegister" class="form-control" value="'+data[0]['username']+'"/>'+
                                    '<label class="form-label" for="usernameRegister">Username</label>'+
                                    '<span style="color: red;" id="errorUsername" class="error"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="d-flex flex-row align-items-center mb-4">'+
                                '<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>'+
                                '<div class="form-outline flex-fill mb-0">'+
                                    ' <input type="email" id="emailRegister" name="emailRegister" class="form-control" value="'+data[0]['email']+'" />'+
                                    '<label class="form-label" for="emailRegister">Email</label>'+
                                    '<span style="color: red;" id="errorMail" class="error"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="d-flex flex-row align-items-center mb-4">'+
                                '<i class="fas fa-lock fa-lg me-3 fa-fw"></i>'+
                                '<div class="form-outline flex-fill mb-0">'+
                                    ' <input type="password" id="passwordRegister" id="passwordRegister" name="passwordRegister" class="form-control" value="'+data[0]['password']+'" />'+
                                    '<label class="form-label" for="passwordRegister">Password</label>'+
                                    '<span style="color: red;" id="errorPassword" class="error"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="d-flex flex-row align-items-center mb-4">'+
                                '<i class="fas fa-key fa-lg me-3 fa-fw"></i>'+
                                '<div class="form-outline flex-fill mb-0">'+
                                    '<input type="password" id="passwordRepeatRegister" class="form-control" value="'+data[0]['password']+'" />'+
                                    '<label class="form-label" for="passwordRepeatRegister">Repeat your password</label>'+
                                    '<span style="color: red;" id="errorRepeatPassword" class="error"></span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="d-flex flex-row align-items-center mb-4">'+
                                '<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>'+
                                '<div class="form-outline flex-fill mb-0">'+
                                    '<input type="date" id="f_nacimientoRegister" name="f_nacimientoRegister" class="form-control" value="'+data[0]['d_birth']+'" />'+
                                    '<label class="form-label" for="f_nacimientoRegister">Fecha de nacimiento</label>'+
                                    '<span style="color: red;" id="errorFNacimiento" class="error"></span>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="modal-footer">'+
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>'+
                        '<button type="button" value="'+data[0]['username']+'" id="confirmUpdate" class="btn btn-warning">Update</button>'+
                        '</div>'+
                    '</div>'+
                    '</div>'
                );
                $('#modalupdateUser').modal("show"); // Mostramos el modal
            }).catch(function() {
                console.log("ERR: Data One User");
            });
    });

    $(document).on("click", "#confirmUpdate", function () {
        updateUser();
    });

    function validateUpdate() {
        
        var usernameExpr = /^[a-zA-Z0-9]{6,}$/;
        var mailExpr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
        var passwdExpr = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
        var fechaDeReferencia = new Date('2005-01-01');
        var error = false;

        if($('#usernameRegister').val().length === 0) {
            $('#errorUsername').html('<br>Añade un nombre de usuario');
            error = true;
        } else {
            if($('#usernameRegister').val().length < 6) {
                $('#errorUsername').html('<br>El usuario ha de contener 6 caracteres como minimo');
                error = true;
            } else {
                if(!usernameExpr.test($('#usernameRegister').val())) {
                    $('#errorUsername').html('<br>No se pueden poner caracteres especiales');
                    error = true;
                }else{
                    $('#errorUsername').html('');
                }
            }
        }

        if($('#emailRegister').val().length === 0) {
            $('#errorMail').html('<br>Tienes que escribir un correo');
            error = true;
        } else {
            if(!mailExpr.test($('#emailRegister').val())) {
                $('#errorMail').html('<br>El formato del mail es invalido');
                error = true;
            } else {
                $('#errorMail').html('');
            }
        }

        $('#errorRepeatPassword').html('<br>');
        if($('#passwordRegister').val().length === 0) {
            $('#errorPassword').html('<br>Tienes que escribir la contraseña');
            error = true;
        } else {
            if($('#passwordRegister').val().length < 8) {
                $('#errorPassword').html('<br>La password tiene que tener 8 caracteres como minimo');
                error = true;
            } else {

                if ($('#passwordRegister').val() != $('#passwordRepeatRegister').val()) { 
                    error = true;
                    $('#errorRepeatPassword').html('<br>La password no coincide con la anterior');
                }else { 
                    $('#errorRepeatPassword').html('<br>');
                    if(!passwdExpr.test($('#passwordRegister').val())) {
                        $('#errorPassword').html('<br>Debe de contener minimo 8 caracteres, mayusculas, minusculas y simbolos especiales');
                        error = true;
                    }else{
                        $('#errorPassword').html('');
                    }
                }
            }
        }

        let fechaSeleccionada = new Date($('#f_nacimientoRegister').val());

        if (isNaN(fechaSeleccionada)) {
            $('#errorFNacimiento').html('<br>Introduce la fecha de nacimiento');
            error = true;
        } else {
            // if(fechaSeleccionada > fechaDeReferencia) {
            //     $('#errorFNacimiento').html('<br>La fecha introducida no es valida');
            //     error = true;
            // }else{
                $('#errorFNacimiento').html();
            // }
        }
        // console.log(error);
        return error == true ? true : false; 
    }

    function updateUser() {

        validateUpdate() == false ? promiseRegister() : undefined;
    
        function promiseRegister() {
            let dataForm = $('#updateForm').serialize();
            console.log(dataForm);
            ajaxPromise("module/dashboard/ctrl/ctrl_dashboard.php?op=updateUser", 'POST', 'JSON', dataForm)
            .then(function(data) {
                console.log(data);
                data == "Username_no_valido" ? toastr.error("El usuario introducido no es valido") : undefined;
                data == "Email_no_valido" ? toastr.error("El email introducido no es valido") : undefined;
                data == true ? ( toastr.success("Usuario actualizado de forma adecuada"), $('#modalupdateUser').modal("hide"), launchUsersData() ) : undefined;
            }).catch(function() {
                console.log("error ajaxForSearch Register");
            });
        }
    }
}

// carga las estadisticas generales de usuario
function cardDataCountUsers(){
        ajaxPromise('module/dashboard/ctrl/ctrl_dashboard.php?op=cantUsers','GET', 'JSON')
            .then(function(data) {
            console.log(data[0]['cantUsers']);
            $('<div class="col-xl-3 col-sm-6 col-12"></div>').appendTo('#cards_estadistics')
                .html('<div class="card shadow border-0">'+
                '<div class="card-body">'+
                    '<div class="row">'+
                        '<div class="col">'+
                            '<span class="h6 font-semibold text-muted text-sm d-block mb-2">Usuarios</span>'+
                            '<span class="h3 font-bold mb-0">'+data[0]['cantUsers']+'</span>'+
                        '</div>'+
                        '<div class="col-auto">'+
                            '<div class="icon icon-shape bg-primary text-white text-lg rounded-circle">'+
                                '<i class="bi bi-people"></i>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="mt-2 mb-0 text-sm">'+
                        '<span class="badge badge-pill bg-soft-success text-success me-2"><i class="bi bi-arrow-up me-1"></i>30%</span>'+
                        '<span class="text-nowrap text-xs text-muted"></span>'+
                    '</div>'+
                    '</div>'+
                '</div>'
            );          

        }).catch(function() {
        console.log("ERR: Data Count User");
        });
}

// == LAUNCHER USERS == //

function launcherDashboardForUsers(){
    launchUsersData();
    deleteUser();
    cardDataCountUsers();
    viewDataUser();
    updateDataUser();
}

$(document).ready(function() {
    console.log("holaaa");
    $('#menu').hide();
    $('#footer').hide();
    launcherDashboardForUsers();
});
