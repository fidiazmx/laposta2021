$(document).ready(function(){
    $('.modal').modal();
  
    $(document).on('click', 'a.function_edit', function(e){    
        $('#modalPagos').modal('open');
    });
  
    $(document).on('click', 'a.function_delete', function(e){    
        swal({
            title: "¿Está seguro que desea eliminar?",
            text: "",
            icon: 'warning',
            dangerMode: true,
            buttons: {
              cancel: 'No',
              delete: 'Si'
            }
          }).then(function (willDelete) {
            if (willDelete) {
              swal("Se ha elminado", {
                icon: "success",
              });
            } else {
              swal("No se realizo ninguna acción", {
                title: 'Cancelado',
                icon: "error",
              });
            }
          });
    });
  
    $(document).on('click', 'a.cambiaestado', function(e){   
      esatendido = true;
      alert('Importante: Para ser atendido es necesario capturar el presupuesto');
    });
  
    $(document).on('click', 'a.function_trabajos', function(e){          
      
      sessionStorage.setItem('idtrabajo' ,$(this).attr('data-id'));
      window.location = "historial-pagos-trabajo.html";
    });
    
  });
  
  
  
  
  
  //$(document).on('click', '#add_cliente', function(e){
      //e.preventDefault();
      //alert('test');
      //swal.close();
      //$('#modalCliente').modal('open');
      /*
      $('#form_cliente').attr('class', 'form add');
      $('#form_cliente').attr('data-id', ''); 
      $('#form_cliente #txtNombre').val("");       
      $('#form_cliente #txtDireccion').val("");        
      $('#form_cliente #txtTelefono').val("");        
      $('#form_cliente #txtTelefonoCel').val("");        
      $('#form_cliente #slMide').val(0);      
      $('#form_cliente #slMide').material_select();
      $('#form_cliente #txtUbicacion').val("");  
      $('#form_cliente #slEmpleado').val(0);      
      $('#form_cliente #slEmpleado').material_select();    
      $('#form_cliente #txtPresupuesto').val("0.00");  
      $('#form_cliente #txtPresupuesto2').val("0.00");  
      $('#form_cliente #txtPresupuesto3').val("0.00");  
      $('#form_cliente #txtPresupuesto4').val("0.00");  
      //LlenaComboTipoProductos();
      ocultaPresupuesto = true;
      if (ocultaPresupuesto == true) {
        $("#contenedorPresupuesto").hide();
      }
      */
    //});