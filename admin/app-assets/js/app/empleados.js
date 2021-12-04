$(document).ready(function(){

  var validatorEmpleados = $("#form-empleados").validate({
    rules: {
        txtNombre: {
            required: true                
        },
        txtTelefono: {
            required: true,
            digits: true,    
            minlength: 10
                        
        },
        txtDireccion: {
          required: true               
        },  
        txtSueldo: {
            required: true,
            importe2dec: true                
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

  var table_empleados = $('#data-table-simple').dataTable({             
    "paging": true,         
    "ajax": usourl + "/php/empleados.func.php?job=get_empleados&filtro=activo",   
    "columns": [      
        { "data": "espacio" },  
        { "data": "id" },
        { "data": "name" },
        { "data": "telefono_empleado" },
        { "data": "direccion_empleado" },            
        { "data": "sueldo_semanal_empleado" },
        { "data": "eestatus" },                     
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

  $( "#add_empleado" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalEmpleado").modal();        
    validatorEmpleados.resetForm();
    $('#form-empleados')[0].reset();
    $("#txtAdeudo").attr("readonly", false);   
});

// $(document).on('click', '.function_edit', function(e){  
//     e.preventDefault();        
//     sessionStorage.setItem("accion","editar");
//     $("#modalActualiza").modal();
//     sessionStorage.setItem("idempleado",$(this).data("idempleado"));
//     $("#txtNombre").val($(this).data("nombre"));    
//     $("#slTipoEmpleado").val($(this).data("idtipoempleado"));    
//     $("#slHorario").val($(this).data("idhorario"));    
//     $("#txtTelefono").val($(this).data("telefono"));    
//     $("#txtSueldo").val($(this).data("sueldo"));   
//     $("#txtComision").val($(this).data("porcentajecomision"));   
//     $("#txtComisionProducto").val($(this).data("porcentajecomisionprod"));   
//     $("#slActivo").val($(this).data("activo"));    
// });

$( "#btnGuardar" ).click(function() {        
  if ($("#form-empleados").valid()) {                    
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
                  accion_cat = "add_empleado";
              } else if (sessionStorage.getItem("accion") == "editar") {
                  accion_cat = "update_empleado";
              }
              var form_data = $("#form-empleados").serialize();
              var request   = $.ajax({
                url:          usourl + '/php/empleados.func.php?job='+accion_cat+'&'+form_data
                +'&id_empleado='+sessionStorage.getItem('idempleado')+'&id_usuario='+sessionStorage.getItem('idusuario'),
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
                            window.location = "empleados.php";
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


$(document).on('click', 'a.function_edit', function(e){    
  e.preventDefault();        
  sessionStorage.setItem("accion","editar");
  $('#modalEmpleado').modal('open');
  sessionStorage.setItem("idempleado",$(this).data("idempleado"));
  sessionStorage.setItem("idusuario",$(this).data("idusuario"));
  $("#txtNombre").val($(this).data("name"));       
  $("#txtTelefono").val($(this).data("telefono-empleado"));    
  $("#txtDireccion").val($(this).data("direccion-empleado"));
  $("#txtAdeudo").attr("readonly", true);   
  $("#txtAdeudo").val($(this).data("adeudo"));   
  $("#txtSueldo").val($(this).data("sueldo"));   
  $("#swActivo").val($(this).data("activo"));    
});

$(document).on('click', 'a.function_delete', function(e){   
  var idemp        = $(this).data('idempleado');
  var idusr        = $(this).data('idusuario'); 
  swal({   title: "¿Está seguro que desea dar de baja al empleado?",
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
              url:          usourl + '/php/empleados.func.php?job=delete_empleado&id=' + idemp + '&idusuario=' + idusr,
              cache:        false,
              dataType:     'json',
              contentType:  'application/json; charset=utf-8',
              type:         'get'
            });
            request.done(function(output){
              if (output.result == 'success'){
                table_empleados.api().ajax.reload(function(){            
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

// $(document).on('click', 'a.function_delete', function(e){    
//     swal({
//         title: "¿Está seguro que desea dar de baja al empleado?",
//         text: "",
//         icon: 'warning',
//         dangerMode: true,
//         buttons: {
//           cancel: 'No',
//           delete: 'Si'
//         }
//       }).then(function (willDelete) {
//         if (willDelete) {
//           swal("El empleado ha sido dado de baja", {
//             icon: "success",
//           });
//         } else {
//           swal("No se realizo ninguna acción", {
//             title: 'Cancelado',
//             icon: "error",
//           });
//         }
//       });
//   });
    
});