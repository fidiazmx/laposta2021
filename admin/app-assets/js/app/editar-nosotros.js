$(document).ready(function(){
      
    getInfoNosotros();
    
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
               var contTextPor = $("#contenido-editor-porque").val();
               var contTextMision = $("#contenido-editor-mision").val();
               var contTextVision = $("#contenido-editor-vision").val();
               var contTextValores = $("#contenido-editor-valores").val();
                //var form_data = $("#form-primer-bloque").serialize();
                var request   = $.ajax({
                    url:         usourl + '/php/editar-nosotros.func.php?job=update_nosotros',
                    data:        'textoPorque='+contTextPor+'&textoMision='+contTextMision+'&textoVision='+contTextVision+'&textoValores='+contTextValores,                    
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
                                window.location = "editar-nosotros.php";
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


function getInfoNosotros(){
    var request   = $.ajax({
		url:          usourl + '/php/editar-nosotros.func.php?job=get_data_nosotros',
		cache:        false,
		dataType:     'json',
		contentType:  'application/json; charset=utf-8',
		type:         'get'
	});
	request.done(function(output){        
		if (output.result == 'success'){      
			//console.log(output.data);	                       
            var element = document.getElementById("trix-porque");
            $("#contenido-editor-porque").val(output.data[0].texto_por_que);
            element.editor.insertHTML(output.data[0].texto_por_que);

            var element2 = document.getElementById("trix-mision");
            $("#contenido-editor-mision").val(output.data[0].texto_mision);
            element2.editor.insertHTML(output.data[0].texto_mision);

            var element3 = document.getElementById("trix-vision");
            $("#contenido-editor-vision").val(output.data[0].texto_vision);
            element3.editor.insertHTML(output.data[0].texto_vision);

            var element4 = document.getElementById("trix-valores");
            $("#contenido-editor-valores").val(output.data[0].texto_valores);
            element4.editor.insertHTML(output.data[0].texto_valores);
		} else {
		    alert('Add request failed');          
		}
	});
	request.fail(function(jqXHR, textStatus){
	  	alert('Add request failed: ' + textStatus);       
	});
}