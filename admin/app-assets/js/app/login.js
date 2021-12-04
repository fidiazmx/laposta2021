$(document).ready(function() {    
    
    $("#form-login").validate({
        rules: {
            txtUsuario: {
                required: true                
            },
            txtPassword: {
                required: true                
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

    $( "#btnLogin" ).click(function(e) {        
        e.preventDefault();                            
        var usr = $("#txtUsuario").val();
        var pass = $("#txtPassword").val();   
        window.location.href = "main.php";     
        /*                                
        if ($("#form-login").valid()) {
            var request = $.ajax({
                url:          usourl + '/php/login.func.php',                
                data:         $("#form-login").serialize() + "&job=login_usuario",     
                type:         'POST'
            });
            request.done(function(output){
                output = JSON.parse(output);    		
                if (output.result == 'success'){	                                                  
                    sessionStorage.setItem("usr", usr);	                    
                    sessionStorage.setItem("idusuario", output.data[0].id);
                    sessionStorage.setItem("idrol", output.data[0].idrol);
                    sessionStorage.setItem("name", output.data[0].name);     
                    sessionStorage.setItem("descripcionrol", output.data[0].descripcionrol);                
                    window.location.href = "main.php";                                            
                } else {                    
                    swal('No se encontraron datos');	        	
                    $("#form-login")[0].reset();                    
                }
            });
            request.fail(function(jqXHR, textStatus){
                alert('Ocurrió un detalle al loguearse');      	  
            });
        } else {
            swal('Ingrese los datos requeridos');      	  
        }  
        */               
    });


});