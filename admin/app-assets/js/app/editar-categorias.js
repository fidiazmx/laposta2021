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
                        accion_cat = "add_categoria";
                    } else if (sessionStorage.getItem("accion") == "editar") {
                        accion_cat = "update_categoria";
                    }
                    var form_data = $("#form-categorias").serialize();
                    var request   = $.ajax({
                      url:          usourl + '/php/editar-categorias.func.php?job='+accion_cat+'&id='+sessionStorage.getItem("idcategoria"),
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
                                  window.location = "editar-categorias.php";
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