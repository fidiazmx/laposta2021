$(document).ready(function(){

    //genera_asistencia();

    var table_inasistencias = $('#data-table-simple').dataTable({             
      "paging": true,         
      "ajax": usourl + "/php/nominas.func.php?job=get_nomina&filtro=activo",   
      "columns": [      
          { "data": "nombre_empleado" },  
          { "data": "lun_asis" },
          { "data": "mar_asis" },
          { "data": "mie_asis" },
          { "data": "jue_asis" },
          { "data": "vie_asis" },
          { "data": "sab_asis" },
          { "data": "salario" },
          { "data": "descuento_faltas" },
          { "data": "prestamo_semana" },
          { "data": "adeudo_anterior" },
          { "data": "abono_cuenta_semana" },
          { "data": "adeudo_actual" },
          { "data": "salario_final" }
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
  
});
      
 function genera_asistencia() {
  var request   = $.ajax({
    url:          usourl + '/php/asistencias.func.php?job=add_asistencia&filtro=activo',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){        
    if (output.result == 'success'){      
        swal("Se ha generado la nómina de la semana actual al momento");
        $("#spanTotalSal").text(output.totsal);
    } else {
        alert('Add request failed xx');          
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);       
    });
 }