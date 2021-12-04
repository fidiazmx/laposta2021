$( document ).ready(function() {    

    var table_trabajos = $('#data-table-simple').dataTable({
        "ajax": usourl + "/php/trabajos.func.php?job=get_trabajos",
        "columns": [
          { "data": "espacio" },  
          { "data": "id_trabajo" },
          { "data": "nombre_cliente"    },
          { "data": "descripcion_trabajo" },
          { "data": "estatus_fabricado"  },
          { "data": "estatus_instalado"  },
          { "data": "estatus_terminado"  },
          { "data": "monto_pagado"  },
          { "data": "monto_adeuda"  },      
          { "data": "monto_precio"  },      
          { "data": "functions" }
        ],
        "aoColumnDefs": [
          { "bSortable": false, "aTargets": [-1] }
        ],
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "oLanguage": {
          "sSearch":         "Buscar:",
          "oPaginate": {
            "sFirst":       "Primero",
            "sPrevious":    "Anterior",
            "sNext":        "Siguiente",
            "sLast":        "Último",
          },
          "sLengthMenu":    "Mostrar _MENU_ registros",
          "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)"
        }
      });

});