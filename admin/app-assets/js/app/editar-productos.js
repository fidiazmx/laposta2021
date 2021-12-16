$(document).ready(function(){

    var table_productos = $('#data-table-simple').dataTable({             
        "paging": true,         
        "ajax": usourl + "/php/editar-productos.func.php?job=get_productos&filtro=activo",   
        "columns": [      
            { "data": "id_producto" },  
            { "data": "imagen_detalle" },
            { "data": "imagen_catalogo" },
            { "data": "descripcion_producto" },
            { "data": "descripcion_categoria" },            
            { "data": "ingredientes" },
            { "data": "indicaciones" },
            { "data": "estatus" },                                 
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

    $( "#add_producto" ).click(function() {
        sessionStorage.setItem("accion","nuevo");
        $("#modalProducto").modal();        
        //validatorEmpleados.resetForm();
        $('#form-productos')[0].reset();
        $("#imgdetalle").attr("src", "");
        $("#imgprod").attr("src", "");
        //$("#txtAdeudo").attr("readonly", false);   
    });

    $(document).on('click', 'a.function_edit', function(e){    
        e.preventDefault();        
        sessionStorage.setItem("accion","editar");
        $('#modalProducto').modal('open');
        $("#txtDescripcion").val($(this).data("descprod"));       
        $("#txtDetProd").val($(this).data("detprod"));    
        $("#txtDetEspec").val($(this).data("det2prod"));
        $("#txtIngred").val($(this).data("ingredientes"));    
        $("#txtIndic").val($(this).data("indicaciones"));    
        $("#txtPrecio").val($(this).data("precio"));    
        $("#slCategoria").val($(this).data("idcat"));   
        $('#slCategoria').formSelect();   
        $("#slDisponible").val($(this).data("estatus"));   
        $('#slDisponible').formSelect();   
        $("#swActivo").val($(this).data("activo"));    
        sessionStorage.setItem("idproducto",$(this).data('idproducto'))
        if ($(this).data("activo") == 'A') {
            $("#swActivo").prop('checked', true);
        } else {
            $("#swActivo").prop('checked', false);
        }

        $("#imgdetalle").attr("src", $(this).data("urlimg") + $(this).data("imgdetalle"));
        $("#imgprod").attr("src", $(this).data("urlimg") + $(this).data("imgproducto"));
    });

    $(document).on('click', 'a.function_edit_img', function(e){ 
        $("#hdidprod").val($(this).data("idproducto")); 
        $("#hdurlact").val($(this).data("urlimg")); 
        $("#hdimgact").val($(this).data("imgactual")); 
        $("#hddesccampo").val($(this).data("desccampo")); 
    });

    $( "#btnGuardar" ).click(function() {        
        //if ($("#form-productos").valid()) {                    
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
                    var accion_cat;     
                    if (sessionStorage.getItem("accion") == "nuevo") {
                        accion_cat = "add_producto";
                    } else if (sessionStorage.getItem("accion") == "editar") {
                        accion_cat = "update_producto";
                    }
                    var form_data = $("#form-productos").serialize();
                    var request   = $.ajax({
                      url:          usourl + '/php/editar-productos.func.php?job='+accion_cat+'&id='+sessionStorage.getItem("idproducto"),
                      data:         form_data,
                      type:         'POST'
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
                                  window.location = "editar-productos.php";
                          });                            
                      } else {                            
                          swal("Error", "No se pudo realizar la acción", "error");
                      }
                    });
                } else {
                    swal("Cancelado", "No se realizó ninguna acción", "error");
                }
            });        
        //}    
    });

    $(document).on('click', 'a.function_delete', function(e){   
        var idprod        = $(this).data('idproducto');        
        swal({   title: "¿Está seguro que desea dar de baja producto?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0053A0",
            confirmButtonText: "SI",
            cancelButtonText: "NO",
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
            closeOnCancel: false },
            function(isConfirm){
                if (isConfirm) {                                      
                  var request = $.ajax({
                    url:          usourl + '/php/editar-productos.func.php?job=delete_producto&id=' + idprod,
                    cache:        false,
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'
                  });
                  request.done(function(output){
                    if (output.result == 'success'){
                      table_productos.api().ajax.reload(function(){            
                        //alert("Préstamo borrado correctamente.");
                        swal({
                          title: "Los cambios fueron guardados correctamente",                                
                          type: "success"});
                      }, true);
                    } else {          
                      alert('Delete request failed');          
                    }
                  });
                  request.fail(function(jqXHR, textStatus){        
                    alert('Delete request failed: ' + textStatus);        
                  });
                } else {
                    swal("Cancelado", "No se realizó ninguna acción", "error");
                }
            });
      });

    $("#submitForm").on("submit", function(e){
        e.preventDefault();                
        //var formData = new FormData(this);
        var file_data = $('#image').prop('files')[0];   
        var form_data = new FormData();      
        form_data.append('file', file_data);   
        form_data.append('idproducto', $("#hdidprod").val());
        form_data.append('urlact', $("#hdurlact").val());
        form_data.append('imgact', $("#hdimgact").val());
        form_data.append('desccampo', $("#hddesccampo").val());
        $.ajax({
            url  : "../../admin/php/upload.func.php",
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
                
                table_productos.api().ajax.reload(function(){            
                    //alert("Préstamo borrado correctamente.");
                    swal({
                      title: "La imagen fue actualizada correctamente",                                
                      type: "success"});
                }, true);
            }
        });
    });

});