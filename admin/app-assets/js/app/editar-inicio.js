$(document).ready(function(){

    getInfoInicio();

    $( "#btnGuardaPrimerBloque" ).click(function() {        

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
               var contTextCont = $("#contenido-editor").val();
               var contTextHist = $("#contenido-editor-historia").val();
                var form_data = $("#form-primer-bloque").serialize();
                var request   = $.ajax({
                    url:         usourl + '/php/editar-inicio.func.php?job=update_inicio',
                    data:        form_data+'&textoContacto='+contTextCont+'&textoHistoria='+contTextHist,                    
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
                                window.location = "editar-inicio.php";
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

function getInfoInicio(){
    var request   = $.ajax({
		url:          usourl + '/php/editar-inicio.func.php?job=get_data_inicio',
		cache:        false,
		dataType:     'json',
		contentType:  'application/json; charset=utf-8',
		type:         'get'
	});
	request.done(function(output){        
		if (output.result == 'success'){      
			//console.log(output.data);	
            $("#txtLinea1").val(output.data[0].texto_principal_linea1);
            $("#txtLinea2").val(output.data[0].texto_principal_linea2);
            $("#txtLinea3").val(output.data[0].texto_principal_linea3);
            $("#txtLineaVideoYoutube").val(output.data[0].url_video_principal);

            var element = document.getElementById("trix-contenido");
            $("#contenido-editor").val(output.data[0].mensaje_principal_contacto);
            element.editor.insertHTML(output.data[0].mensaje_principal_contacto);

            var element2 = document.getElementById("trix-contenido-historia");
            $("#contenido-editor-historia").val(output.data[0].texto_historia);
            element2.editor.insertHTML(output.data[0].texto_historia);
		} else {
		    alert('Add request failed');          
		}
	});
	request.fail(function(jqXHR, textStatus){
	  	alert('Add request failed: ' + textStatus);       
	});
}