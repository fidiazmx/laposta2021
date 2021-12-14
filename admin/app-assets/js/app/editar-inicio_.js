$(document).ready(function(){

    // Full Editor
    var fullEditor = new Quill('#full-container .editor', {
        bounds: '#full-container .editor',
        modules: {
        'formula': true,
        'syntax': true,
        'toolbar': [
            [{
            'font': []
            }, {
            'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
            'color': []
            }, {
            'background': []
            }],
            [{
            'script': 'super'
            }, {
            'script': 'sub'
            }],
            [{
            'header': '1'
            }, {
            'header': '2'
            }, 'blockquote', 'code-block'],
            [{
            'list': 'ordered'
            }, {
            'list': 'bullet'
            }, {
            'indent': '-1'
            }, {
            'indent': '+1'
            }],
            ['direction', {
            'align': []
            }],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ],
        },
        theme: 'snow'
    });

    var fullEditorHistoria = new Quill('#full-container-historia .editor', {
        bounds: '#full-container-historia .editor',
        modules: {
        'formula': true,
        'syntax': true,
        'toolbar': [
            [{
            'font': []
            }, {
            'size': []
            }],
            ['bold', 'italic', 'underline', 'strike'],
            [{
            'color': []
            }, {
            'background': []
            }],
            [{
            'script': 'super'
            }, {
            'script': 'sub'
            }],
            [{
            'header': '1'
            }, {
            'header': '2'
            }, 'blockquote', 'code-block'],
            [{
            'list': 'ordered'
            }, {
            'list': 'bullet'
            }, {
            'indent': '-1'
            }, {
            'indent': '+1'
            }],
            ['direction', {
            'align': []
            }],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ],
        },
        theme: 'snow'
    });

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
               var contTextCont = $("#contenido-editor").html();
               var contTextHist = $("#contenido-editor-historia").html();
                var form_data = $("#form-primer-bloque").serialize();
                var request   = $.ajax({
                    url:         usourl + '/php/editar-inicio.func.php?job=update_inicio',
                    data:        form_data+'&textoContacto='+contTextCont,                    
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
            $("#contenido-editor").html(output.data[0].mensaje_principal_contacto);
            $("#contenido-editor-historia").html(output.data[0].texto_historia);
		} else {
		    alert('Add request failed');          
		}
	});
	request.fail(function(jqXHR, textStatus){
	  	alert('Add request failed: ' + textStatus);       
	});
}