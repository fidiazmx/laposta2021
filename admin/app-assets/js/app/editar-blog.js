$(document).ready(function(){

    var table_notas = $('#data-table-simple').dataTable({             
        "paging": true,         
        "ajax": usourl + "/php/editar-blog.func.php?job=get_notas&filtro=activo",   
        "columns": [      
            { "data": "id_nota_blog" },                       
            { "data": "imagen_nota" },
            { "data": "titulo_nota" },
            { "data": "texto_nota" },
            { "data": "name" },
            { "data": "fecha_alta" },
            { "data": "activo" },                                 
            { "data": "functions" }
        ],
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [-1] }
        ],
        "lengthMenu": [[4, 10, 25, 50, 100, -1], [4, 10, 25, 50, 100, "Todos"]],
        "oLanguage": {
          "sSearch":         "Buscador:",
          "oPaginate": {
            "sFirst":       "Primero",
            "sPrevious":    "Anterior",
            "sNext":        "Siguiente",
            "sLast":        "Último",
          },
          "sLengthMenu":    "Mostrar _MENU_ ",
          "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)"
        }
    });

    $('.modal').modal();

    $( "#add_nota" ).click(function() {
        sessionStorage.setItem("accion","nuevo");
        $("#modalNota").modal();        
        //validatorEmpleados.resetForm();
        $('#form-notas')[0].reset();
        //$("#imgdetalle").attr("src", "");
        //$("#imgprod").attr("src", "");
        //$("#txtAdeudo").attr("readonly", false);   
    });

    $(document).on('click', 'a.function_edit', function(e){    
        e.preventDefault();  
        sessionStorage.setItem("accion","editar");
        sessionStorage.setItem("idnota",$(this).data('idnota'));
        $('#modalNota').modal('open');
        var element = document.querySelector("trix-editor");
        $("#txtContenidoNota").val($(this).data('textonota'));
        element.editor.insertHTML($(this).data('textonota'))
        $("#txtTituloNota").val($(this).data('titulo'));
        $("#swActivo").val($(this).data("activo"));    

        if ($(this).data("activo") == 'A') {
            $("#swActivo").prop('checked', true);
        } else {
            $("#swActivo").prop('checked', false);
        }
    });

    $(document).on('click', 'a.function_edit_img', function(e){ 
        $("#hdidnota").val($(this).data("idnota")); 
        $("#hdurlact").val($(this).data("urlimg")); 
        $("#hdimgact").val($(this).data("imgactual")); 
    });

    $("#btnGuardarNota").click(function(){
        var accion_cat;     
        if (sessionStorage.getItem("accion") == "nuevo") {
            accion_cat = "add_nota";
        } else if (sessionStorage.getItem("accion") == "editar") {
            accion_cat = "update_nota";
        }
        var form_data = $("#form-notas").serialize();
        var request   = $.ajax({
        url:          usourl + '/php/editar-blog.func.php?job='+accion_cat,
        data:         form_data+'&swActivo='+$("#swActivo").val()+'&id='+sessionStorage.getItem("idnota")+'&id_usuario_modifica='+sessionStorage.getItem("id"),
        type:         'POST'
        //cache:        false,                        
        //dataType:     'json',
        //contentType:  'application/json; charset=utf-8',
        });
        request.done(function(output){
            output = JSON.parse(output);    		
            if (output.result == 'success'){                            
                alert("Los cambios fueron guardados correctamente");                                                    
                window.location = "editar-blog.php";                
            } else {                            
                alert("No se pudo realizar la acción");
            }
        });                
    });

    $(document).on('click', 'a.function_delete', function(e){   
        var idnota        = $(this).data('idnota');                                             
        var request = $.ajax({
        url:          usourl + '/php/editar-blog.func.php?job=delete_nota&id=' + idnota,
        cache:        false,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
        });
        request.done(function(output){
        if (output.result == 'success'){
            table_notas.api().ajax.reload(function(){            
            alert("Los cambios fueron guardados correctamente");
            }, true);
        } else {          
            alert('Delete request failed');          
        }
        });
        request.fail(function(jqXHR, textStatus){        
        alert('Delete request failed: ' + textStatus);        
        });
    });

    $("#submitForm").on("submit", function(e){
        e.preventDefault();                
        //var formData = new FormData(this);
        var file_data = $('#image').prop('files')[0];   
        var form_data = new FormData();      
        form_data.append('file', file_data);   
        form_data.append('idnota', $("#hdidnota").val());
        form_data.append('urlact', $("#hdurlact").val());
        form_data.append('imgact', $("#hdimgact").val());
        form_data.append('desccampo', $("#hddesccampo").val());
        $.ajax({
            url  : "../../admin/php/upload-nota.func.php",
            dataType: 'text',
            cache:false,
            contentType : false, // you can also use multipart/form-data replace of false
            processData: false,
            data :form_data,
            type : "POST",
            success:function(response){
                $("#preview").show();
                $("#imageView").html(response);
                $("#image").val('');
                
                table_notas.api().ajax.reload(function(){            
                    alert("La imagen fue actualizada correctamente");                    
                }, true);
            }
        });
    });

});