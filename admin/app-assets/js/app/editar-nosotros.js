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

    var fullEditorMision = new Quill('#full-container-mision .editor', {
        bounds: '#full-container-mision .editor',
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

    var fullEditorVision = new Quill('#full-container-vision .editor', {
        bounds: '#full-container-vision .editor',
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

    var fullEditorValores = new Quill('#full-container-valores .editor', {
        bounds: '#full-container-valores .editor',
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