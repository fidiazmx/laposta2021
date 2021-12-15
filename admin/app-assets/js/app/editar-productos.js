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
        
        if ($(this).data("activo") == 'A') {
            $("#swActivo").prop('checked', true);
        } else {
            $("#swActivo").prop('checked', false);
        }

        $("#imgdetalle").attr("src", $(this).data("urlimg") + $(this).data("imgdetalle"));
        $("#imgprod").attr("src", $(this).data("urlimg") + $(this).data("imgproducto"));
      });

});