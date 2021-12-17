$(document).ready(function(){

    getDatosContacto();

    $( "#btnGuarda" ).click(function() {        

        swal({   title: "¿Está seguro que desea guardar?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0053A0",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        closeOnCancel: false },
        function(isConfirm){
            if (isConfirm) {                                 
                var form_data = $("#form-contacto").serialize();
                var request   = $.ajax({
                    url:         usourl + '/php/editar-contacto.func.php?job=update_contacto',
                    data:        form_data,                    
                    type:        'POST'
                    //cache:        false,                        
                    //dataType:     'json',
                    //contentType:  'application/json; charset=utf-8',
                });
                request.done(function(output){
                    output = JSON.parse(output);    		
                    if (output.result == 'success'){                            
                        swal({
                            title: "Los cambios fueron guardados correctamente",                                
                            type: "success"
                            },
                            function(){                                                                       
                                window.location = "editar-contacto.php";
                        });                            
                    } else {                            
                        swal("Error", "No se pudo realizar la acción", "error");
                    }
                });
            } else {
                swal("Cancelado", "No se realizó ninguna acción", "error");
            }
        });
    });

});

function getDatosContacto() {
    var request   = $.ajax({
		url:          usourl + '/php/editar-contacto.func.php?job=get_data_contacto',
		cache:        false,
		dataType:     'json',
		contentType:  'application/json; charset=utf-8',
		type:         'get'
	});
	request.done(function(output){        
		if (output.result == 'success'){      
            $("#txtTelBand").val(output.data[0].telefono_ubicacion);
            $("#txtCorreoBand").val(output.data[0].correo_ubicacion);
            $("#txtHor1Band").val(output.data[0].horario_1_ubicacion);
            $("#txtHor2Band").val(output.data[0].horario_2_ubicacion);
            $("#txtHor3Band").val(output.data[0].horario_3_ubicacion);
            $("#txtDirBand").val(output.data[0].direccion_ubicacion);

            $("#txtTelAcaj").val(output.data[1].telefono_ubicacion);
            $("#txtCorreoAcaj").val(output.data[1].correo_ubicacion);
            $("#txtHor1Acaj").val(output.data[1].horario_1_ubicacion);
            $("#txtHor2Acaj").val(output.data[1].horario_2_ubicacion);
            $("#txtHor3Acaj").val(output.data[1].horario_3_ubicacion);
            $("#txtDirAcaj").val(output.data[1].direccion_ubicacion);

            $("#txtTelMata").val(output.data[2].telefono_ubicacion);
            $("#txtCorreoMata").val(output.data[2].correo_ubicacion);
            $("#txtHor1Mata").val(output.data[2].horario_1_ubicacion);
            $("#txtHor2Mata").val(output.data[2].horario_2_ubicacion);
            $("#txtHor3Mata").val(output.data[2].horario_3_ubicacion);
            $("#txtDirMata").val(output.data[2].direccion_ubicacion);
		} else {
		    alert('Add request failed');          
		}
	});
	request.fail(function(jqXHR, textStatus){
	  	alert('Add request failed: ' + textStatus);       
	});
}