(function (window, document, $) {
    'use strict';
  
    var Font = Quill.import('formats/font');
    Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
    Quill.register(Font, true);
    
    // Full Editor
  
    var fullEditorPorQue = new Quill('#full-container-porque .editor', {
      bounds: '#full-container-porque .editor',
      modules: {
        'formula': false,
        'syntax': true,
        'toolbar': [
            [ {'font': []}, {'size': []} ], 
            ['bold', 'italic', 'underline', 'strike'],
            [ {'color': []}, {'background': []}],
            [ {'header': '1'}, {'header': '2'}],
            [ {'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
            ['direction', {'align': []}]
            //['link', 'image', 'video']        
        ],
      },
      theme: 'snow'
    });

    var fullEditorMision = new Quill('#full-container-mision .editor', {
        bounds: '#full-container-mision .editor',
        modules: {
          'formula': false,
          'syntax': true,
          'toolbar': [
              [ {'font': []}, {'size': []} ], 
              ['bold', 'italic', 'underline', 'strike'],
              [ {'color': []}, {'background': []}],
              [ {'header': '1'}, {'header': '2'}],
              [ {'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
              ['direction', {'align': []}]
              //['link', 'image', 'video']        
          ],
        },
        theme: 'snow'
      });

      var fullEditorVision = new Quill('#full-container-vision .editor', {
        bounds: '#full-container-vision .editor',
        modules: {
          'formula': false,
          'syntax': true,
          'toolbar': [
              [ {'font': []}, {'size': []} ], 
              ['bold', 'italic', 'underline', 'strike'],
              [ {'color': []}, {'background': []}],
              [ {'header': '1'}, {'header': '2'}],
              [ {'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
              ['direction', {'align': []}]
              //['link', 'image', 'video']        
          ],
        },
        theme: 'snow'
      });

      var fullEditorValores = new Quill('#full-container-valores .editor', {
        bounds: '#full-container-valores .editor',
        modules: {
          'formula': false,
          'syntax': true,
          'toolbar': [
              [ {'font': []}, {'size': []} ], 
              ['bold', 'italic', 'underline', 'strike'],
              [ {'color': []}, {'background': []}],
              [ {'header': '1'}, {'header': '2'}],
              [ {'list': 'ordered'}, {'list': 'bullet'}, {'indent': '-1'}, {'indent': '+1'}],
              ['direction', {'align': []}]
              //['link', 'image', 'video']        
          ],
        },
        theme: 'snow'
      });

    // add browser default class to quill select 
    var quillSelect = $("select[class^='ql-'], input[data-link]" );
    quillSelect.addClass("browser-default");
  
    var editors = [fullEditorPorQue, fullEditorMision, fullEditorVision, fullEditorValores];
  
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
               var contTextPor = $("#contenido-editor-porque").html();
               var contTextMision = $("#contenido-editor-mision").html();
               var contTextVision = $("#contenido-editor-vision").html();
               var contTextValores = $("#contenido-editor-valores").html();
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
    

})(window, document, jQuery);

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
            $("#contenido-editor-porque").html(output.data[0].texto_por_que);
            $("#contenido-editor-mision").html(output.data[0].texto_mision);
            $("#contenido-editor-vision").html(output.data[0].texto_vision);
            $("#contenido-editor-valores").html(output.data[0].texto_valores);
		} else {
		    alert('Add request failed');          
		}
	});
	request.fail(function(jqXHR, textStatus){
	  	alert('Add request failed: ' + textStatus);       
	});
}