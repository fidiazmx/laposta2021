$(document).ready(function(){
    
    var table_clientes_espera = $('#data-table-simple').dataTable({             
        "paging": true,         
        "ajax": usourl + "/php/clientes-espera.func.php?job=get_clientes&filtro=activo",   
        "columns": [      
            { "data": "id_cliente" },  
            { "data": "nombre_cliente" },
            { "data": "espera" },
            { "data": "seguimiento" },
            { "data": "avisa" },
            { "data": "aprobado" },            
            { "data": "tel_cliente" },            
            { "data": "presupuesto" },
            { "data": "presupuesto2" },
            { "data": "presupuesto3" },
            { "data": "presupuesto4" },
            { "data": "direccion_cliente" }                                
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

    $(document).on('click', 'a.cambiaestado', function(e){              
        var valorestadoactual = $(this).data('activo');
        if (valorestadoactual == 0) { valorestadoactual = 1 } else if (valorestadoactual == 1) { valorestadoactual = 0 }
    
        setActualizaEstado($(this).data('idcliente'),$(this).data('estado'),valorestadoactual);    
        table_clientes_espera.api().ajax.reload(function(){            
          alert("Actualizado");
        }, true);
    });

    $(document).on('click', 'a.cambiaestadoaprobado', function(e){      
        $("#modalTrabajo").modal('open');     

        $("#txtDireccion").val($(this).data("direccion"));
        $("#txtPrecio1").val($(this).data("presup1"));
        $("#txtPrecio2").val($(this).data("presup2"));
        $("#txtPrecio3").val($(this).data("presup3"));
        $("#txtPrecio4").val($(this).data("presup4"));

        sessionStorage.setItem('idcliente',$(this).attr('data-idcliente'));    
        $(".checkboxpresupuesto").prop( "checked", false );
    });

    $(".checkboxpresupuesto").click(function() {
        selectedBox = this.id;
  
        if (selectedBox == "chkPresupSeleccionado1") { $("#txtPrecio").val($("#txtPrecio1").val()); }      
        if (selectedBox == "chkPresupSeleccionado2") { $("#txtPrecio").val($("#txtPrecio2").val()); }      
        if (selectedBox == "chkPresupSeleccionado3") { $("#txtPrecio").val($("#txtPrecio3").val()); }      
        if (selectedBox == "chkPresupSeleccionado4") { $("#txtPrecio").val($("#txtPrecio4").val()); }      
        
        $(".checkboxpresupuesto").each(function() {
            if ( this.id == selectedBox )
            {
                this.checked = true;
            }
            else
            {
                this.checked = false;
            };        
        });
    }); 

    $( "#btnGuardarTrabajo" ).click(function(e) {        
        e.preventDefault();
        if ($(".checkboxpresupuesto").is(':checked')) {
          if (confirm("¿Esta seguro que desea generar un nuevo trabajo?")){
            var id = sessionStorage.getItem('idcliente');    
            setActualizaEstado(id,'aprobado',1);              
            //var form_data = $('#form_trabajo').serialize();
    
            var desc = $("#txtDescripcion").val();
            var prec = $("#txtPrecio").val();
            var presupsel; 
            if (selectedBox == "chkPresupSeleccionado1") { presupsel = 1; }      
            if (selectedBox == "chkPresupSeleccionado2") { presupsel = 2; }      
            if (selectedBox == "chkPresupSeleccionado3") { presupsel = 3; }      
            if (selectedBox == "chkPresupSeleccionado4") { presupsel = 4; }      
    
    
            var request   = $.ajax({
              url:          usourl + '/php/clientes-espera.func.php?job=add_trabajo&id=' + id + '&txtDescripcion=' + desc + '&txtPrecio=' + prec + '&presupsel=' + presupsel,
              cache:        false,
              //data:         form_data,
              dataType:     'json',
              contentType:  'application/json; charset=utf-8',
              type:         'get'
            });
            request.done(function(output){
              if (output.result == 'success'){
                table_clientes_espera.api().ajax.reload(function(){                  
                  alert('El trabajo fue creado correctamente');
                }, true);
                window.location = "clientes-espera.php";
              } else {
                alert('Edit request failed');
              }
            });
            request.fail(function(jqXHR, textStatus){        
              alert('Edit request failed: ' + textStatus);        
            });    
          }
        } else {
          alert('Seleccione un presupuesto');
        }
      });

});

function setActualizaEstado(idCli, estatus, valor){ 
    debugger;
    var request   = $.ajax({
      url:          usourl + '/php/clientes-espera.func.php?job=update_estatus&id='+idCli+'&estado='+estatus+'&activo='+valor,
      cache:        false,
      dataType:     'json',
      contentType:  'application/json; charset=utf-8',
      type:         'get'
    });
    request.done(function(output){        
      if (output.result == 'success'){                
      } else {
      alert('Add request failed');          
      }
    });
    request.fail(function(jqXHR, textStatus){
      alert('Add request failed: ' + textStatus);       
    });
}