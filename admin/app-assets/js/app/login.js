$(document).ready(function(){

    $("#form-login").validate({
        rules: {
            txtUsuario: {
                required: true
            },
            txtPassword: {
                required: true
                //alphanumeric: true
            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
    });

    $(document).on('click','#btnLogin',function(e){
        e.preventDefault();
        var usr = $("#txtUsuario").val();
        var pass = $("#txtPassword").val();

        if ($("#form-login").valid()) {
            var request = $.ajax({
                url:          usourl + '/php/login.func.php?job=login',
                cache:        false,
                data:         'txtUsuario='+usr+'&txtPassword='+pass,
                dataType:     'json',
                contentType:  'application/json; charset=utf-8',
                type:         'get'
            });
            request.done(function(output){
                if (output.result == 'success'){
                    sessionStorage.setItem("id", output.data[0].id);
                    sessionStorage.setItem("rol", output.data[0].fk_id_rol);
                    sessionStorage.setItem("usuario", output.data[0].usuario);
                    sessionStorage.setItem("descrol", output.data[0].descrol);
                    window.location.href = "main.php";
                } else {
                    swal('No se encontraron datos');
                    $("#login-form")[0].reset();
                }
            });
            request.fail(function(jqXHR, textStatus){
                alert('Ocurrió un detalle al loguearse');
            });
        } else {
            swal('Ingrese los datos requeridos');
        }
    });

});