$(document).ready(function(){

  var validatorClientes = $("#form-clientes").validate({
    rules: {
        txtNombre: {
            required: true                
        },
        txtDireccion: {
            required: true        
        },
        txtTelFijo: {
          required: true,
          digits: 10,
          minlength: 10,
          maxlength: 10               
        }, 
        txtTelCel: {
          required: true,
          digits: 10,
          minlength: 10,
          maxlength: 10            },  
        slmide: {
          required: true
        },
        slEmpleado:{
          required: true
        },
        txtUbicacion: {
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

  var table_clientes = $('#data-table-simple').dataTable({             
    "paging": true,         
    "ajax": usourl + "/php/clientes.func.php?job=get_clientes&filtro=activo",   
    "columns": [      
        { "data": "espacio" },  
        { "data": "nombre_cliente" },
        { "data": "espera" },
        { "data": "direccion_cliente" },
        { "data": "tel_cliente" },            
        { "data": "tel_cel_cliente" },
        { "data": "fecha_captura" },                     
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

  LlenaComboTipoProductos();
  LlenaComboEmpleados();

  $('.modal').modal();

  $( "#add_cliente" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalCliente").modal('open');     
    validatorClientes.resetForm();
    $('#form-clientes')[0].reset();
  });

  $( "#btnGuardar" ).click(function() {        
    if ($("#form-clientes").valid()) {                    
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
                    accion_cat = "add_cliente";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_cliente";                    
                }
                var form_data = $("#form-clientes").serialize();
                var request   = $.ajax({
                  url:          usourl + '/php/clientes.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem('idcliente')+'&id_usuario='+sessionStorage.getItem('idusuario')+'&estado='+sessionStorage.getItem("estado")+'&activo='+sessionStorage.getItem("activo"),
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
                              window.location = "clientes.php";
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

  $(document).on('click', 'a.cambiaestado', function(e){  
    alert('Importante: Para ser atendido es necesario capturar el presupuesto');
    $("#contenedorPresupuesto").show();

    sessionStorage.setItem('idcliente',$(this).data("idcliente"));
    sessionStorage.setItem("activo",$(this).data("activo"));
    sessionStorage.setItem("estado",$(this).data("estado"));
    if (sessionStorage.getItem("activo") == 0) { 
      sessionStorage.setItem("activo", 1); 
    } else if (sessionStorage.getItem("activo") == 1) { 
      sessionStorage.setItem("activo", 0); 
    }

    $('#modalCliente').modal('open');    
    $("#txtNombre").val($(this).data("nombrecliente"));       
    $("#txtDireccion").val($(this).data("direccion"));
    $("#txtTelFijo").val($(this).data("telfijo"));
    $("#txtTelCel").val($(this).data("telcel"));        
    $("#slMide").val($(this).data("mide"));   
    $('#slMide').formSelect();    
    $("#slEmpleado").val($(this).data("empleadoatn"));   
    $('#slEmpleado').formSelect();    
    $("#txtUbicacion").val($(this).data("ubicacion"));    
  });

  $(document).on('click', 'a.function_edit', function(e){    
    e.preventDefault();        
    sessionStorage.setItem("accion","editar");
    $('#modalCliente').modal('open');    
    sessionStorage.setItem("idcliente",$(this).data("idcliente"));
    sessionStorage.removeItem("activo");
    sessionStorage.removeItem("estado");
    $("#txtNombre").val($(this).data("nombrecliente"));       
    $("#txtDireccion").val($(this).data("direccion"));
    $("#txtTelFijo").val($(this).data("telfijo"));
    $("#txtTelCel").val($(this).data("telcel"));        
    $("#slMide").val($(this).data("mide"));   
    $('#slMide').formSelect();    
    $("#slEmpleado").val($(this).data("empleadoatn"));   
    $('#slEmpleado').formSelect();    
    $("#txtUbicacion").val($(this).data("ubicacion"));    
    $("#contenedorPresupuesto").hide();
  });

  $(document).on('click', 'a.function_delete', function(e){   
    var idcli        = $(this).data('idcliente');
    swal({   title: "¿Está seguro que desea eliminar el cliente?",
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
                url:          usourl + '/php/clientes.func.php?job=delete_cliente&id=' + idcli + '&idcliente=',
                cache:        false,
                dataType:     'json',
                contentType:  'application/json; charset=utf-8',
                type:         'get'
              });
              request.done(function(output){
                if (output.result == 'success'){
                  table_clientes.api().ajax.reload(function(){            
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

});

function LlenaComboEmpleados(){
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

function LlenaComboTipoProductos(){
  var request   = $.ajax({
  url:          usourl + '/php/clientes.func.php?job=get_tipoproductos',
  cache:        false,
  dataType:     'json',
  contentType:  'application/json; charset=utf-8',
  type:         'get'
  });
  request.done(function(output){        
  if (output.result == 'success'){      
      var dataslEmpleado = "<option value='' disabled='' selected=''>Seleccione</option>";           			
      for (i = 0; i < output.data.length; ++i) {          		          
        dataslEmpleado += "<option value='" + output.data[i].id_tipo_producto +"'>" + output.data[i].descripcion + "</option>";								                          										            
      }
      $("#slMide").html(dataslEmpleado);        
      $('#slMide').formSelect();
  } else {
      alert('Add request failed');          
  }
  });
  request.fail(function(jqXHR, textStatus){
      alert('Add request failed: ' + textStatus);       
  });
}