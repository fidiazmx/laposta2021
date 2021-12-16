$(document).ready(function(){

    var table_galeria = $('#data-table-simple').dataTable({             
        "paging": true,         
        "ajax": usourl + "/php/editar-galeria.func.php?job=get_galeria&filtro=activo",   
        "columns": [      
            { "data": "id_galeria" },                       
            { "data": "imagen_galeria" },
            { "data": "desc_imagen" },
            { "data": "ubicacion" },            
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

    $( "#add_descimagen" ).click(function() {
        sessionStorage.setItem("accion","nuevo");
        $("#modalDescImagen").modal();        
        //validatorEmpleados.resetForm();
        $('#form-galeria')[0].reset();
        $("#imggaleriaSel").attr("src", "");        
        //$("#imgdetalle").attr("src", "");
        //$("#imgprod").attr("src", "");
        //$("#txtAdeudo").attr("readonly", false);   
    });

    $(document).on('click', 'a.function_edit', function(e){    
        e.preventDefault();  

        sessionStorage.setItem("accion","editar");
        sessionStorage.setItem("idgaleria",$(this).data('idgaleria'));
        $('#modalDescImagen').modal('open');
        $("#txtDescImagen").val($(this).data('descimagen'));
        $("#slUbicacion").val($(this).data('ubicacion'));
        $('#slUbicacion').formSelect();   
        $("#swActivo").val($(this).data("activo"));    

        if ($(this).data("activo") == 'A') {
            $("#swActivo").prop('checked', true);
        } else {
            $("#swActivo").prop('checked', false);
        }

        $("#imggaleriaSel").attr("src", $(this).data("urlimg") + $(this).data("imggaleria"));        
    });

    $(document).on('click', 'a.function_edit_img', function(e){ 
        $("#hdidgaleria").val($(this).data("idgaleria")); 
        $("#hdurlact").val($(this).data("urlimg")); 
        $("#hdimgact").val($(this).data("imgactual")); 
    });

    $("#btnGuardarGaleria").click(function(){
        var accion_cat;     
        if (sessionStorage.getItem("accion") == "nuevo") {
            accion_cat = "add_galeria";
        } else if (sessionStorage.getItem("accion") == "editar") {
            accion_cat = "update_galeria";
        }
        var form_data = $("#form-galeria").serialize();
        var request   = $.ajax({
        url:          usourl + '/php/editar-galeria.func.php?job='+accion_cat,
        data:         form_data+'&swActivo='+$("#swActivo").val()+'&id='+sessionStorage.getItem("idgaleria"),
        type:         'POST'
        //cache:        false,                        
        //dataType:     'json',
        //contentType:  'application/json; charset=utf-8',
        });
        request.done(function(output){
            output = JSON.parse(output);    		
            if (output.result == 'success'){                            
                alert("Los cambios fueron guardados correctamente");                                                    
                window.location = "editar-galeria.php";                
            } else {                            
                alert("No se pudo realizar la acción");
            }
        });                
    });

    $(document).on('click', 'a.function_delete', function(e){   
        var idgaleria = $(this).data('idgaleria');                                             
        var request = $.ajax({
        url:          usourl + '/php/editar-galeria.func.php?job=delete_galeria&id=' + idgaleria,
        cache:        false,
        dataType:     'json',
        contentType:  'application/json; charset=utf-8',
        type:         'get'
        });
        request.done(function(output){
        if (output.result == 'success'){
            table_galeria.api().ajax.reload(function(){            
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
        form_data.append('idgaleria', $("#hdidgaleria").val());
        form_data.append('urlact', $("#hdurlact").val());
        form_data.append('imgact', $("#hdimgact").val());
        form_data.append('desccampo', $("#hddesccampo").val());
        $.ajax({
            url  : "../../admin/php/upload-galeria.func.php",
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
                
                table_galeria.api().ajax.reload(function(){            
                    alert("La imagen fue actualizada correctamente");                    
                }, true);
            }
        });
    });

});