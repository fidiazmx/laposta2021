$(document).ready(function(){

    var table_categorias = $('#data-table-simple').dataTable({
        "paging": true,
        "ajax": usourl + "/php/editar-categorias.func.php?job=get_categorias&filtro=activo",
        "columns": [
            { "data": "id_categoria" },
            { "data": "descripcion_categoria" },
            { "data": "imagen_categoria" }
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

    $(document).on('click', 'a.function_edit_img', function(e){
        $("#hdidcat").val($(this).data("idcategoria"));
        $("#hdimgact").val($(this).data("imgactual"));
    });

    $("#submitForm").on("submit", function(e){
        e.preventDefault();
        //var formData = new FormData(this);
        var file_data = $('#image').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('idcategoria', $("#hdidcat").val());
        form_data.append('imgact', $("#hdimgact").val());
        $.ajax({
            url  : "../../admin/php/upload-categoria.func.php",
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

                table_categorias.api().ajax.reload(function(){
                    //alert("Préstamo borrado correctamente.");
                    swal({
                      title: "La imagen fue actualizada correctamente",
                      type: "success"});
                }, true);
            }
        });
    });


});