$(document).ready(function(){

  getEmpleado();

  var validatorInasistencia = $("#form-inasistencia").validate({
    rules: {
        slEmpleado: {
            required: true                
        },
        txtFechaInasis: {
            required: true          
        }                 
    },        
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }        
  });

  var table_inasistencias = $('#data-table-simple').dataTable({             
    "paging": true,         
    "ajax": usourl + "/php/inasistencias.func.php?job=get_inasistencia&filtro=activo",   
    "columns": [      
        { "data": "espacio" },  
        { "data": "id" },
        { "data": "empleado" },
        { "data": "fecha_inasistencia" },
        // { "data": "estatus" },                       
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

  $( "#add_inasistencia" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalInasistencia").modal();        
    validatorInasistencia.resetForm();
    $('#form-inasistencia')[0].reset();
  });

  $(document).on('click', 'a.function_edit', function(e){    
      $('#modalInasistencia').modal('open');
  });

  $(document).on('click', 'a.function_delete', function(e){   
    var idinasis        = $(this).data('idinasis');
    swal({   title: "¿Está seguro que desea eliminar inasistencia?",
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
                url:          usourl + '/php/inasistencias.func.php?job=delete_inasistencia&id=' + idinasis,
                cache:        false,
                dataType:     'json',
                contentType:  'application/json; charset=utf-8',
                type:         'get'
              });
              request.done(function(output){
                if (output.result == 'success'){
                  table_inasistencias.api().ajax.reload(function(){            
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
  
  $( "#btnGuardar" ).click(function() {        
    if ($("#form-inasistencia").valid()) {                    
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
                    accion_cat = "add_inasistencia";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_inasistencia";
                }
                var form_data = $("#form-inasistencia").serialize();
                var request   = $.ajax({
                  url:          usourl + '/php/inasistencias.func.php?job='+accion_cat+'&'+form_data+'&id_usuario='+sessionStorage.getItem('idusuario'),
                  cache:        false,                        
                  dataType:     'json',
                  contentType:  'application/json; charset=utf-8',
                });
                request.done(function(output){
                  // output = JSON.parse(output);    		
                  if (output.result == 'success'){                            
                      swal({
                          title: "Los cambios fueron guardados correctamente",                                
                          type: "success"
                          },
                          function(){                                                                       
                              window.location = "inasistencias.php";
                      });                            
                  } else {                            
                      swal("Error", "No se pudo realizar la acción", "error");
                  }
                });
            } else {
                swal("Cancelado", "No se realizó ninguna acción", "error");
            }
        });        
    }    
  });

});
    
function getEmpleado(){
  var request   = $.ajax({
  url:          usourl + '/php/empleados.func.php?job=get_empleados&filtro=activo',
  cache:        false,
  dataType:     'json',
  contentType:  'application/json; charset=utf-8',
  type:         'get'
  });
  request.done(function(output){        
  if (output.result == 'success'){      
      var dataslEmpleado = "<option value='' disabled='' selected=''>Seleccione</option>";           			
      for (i = 0; i < output.data.length; ++i) {          		          
        dataslEmpleado += "<option value='" + output.data[i].id_empleado +"'>" + output.data[i].name + "</option>";								                          										            
      }
      $("#slEmpleado").html(dataslEmpleado);        
      $('#slEmpleado').formSelect();
  } else {
      alert('Add request failed');          
  }
  });
  request.fail(function(jqXHR, textStatus){
      alert('Add request failed: ' + textStatus);       
  });
}