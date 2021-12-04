/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
$( document ).ready(function() {

	if ( sessionStorage.getItem("usr") == undefined ) {
		window.location = "index.php";
	} else {
		$("#spanUsuario").text(sessionStorage.getItem("name"));
	}

	$.validator.addMethod("importe2dec", function(value, element, param) {
		//return this.optional(element) || /^([a-zA-Z0-9 ]*)/.test(value);
		return this.optional(element) || /^[0-9]+(\.[0-9]{1,2})?$/.test(value);
	}, "Ingrese un importe válido");	

	$(".switch").find("input[type=checkbox]").on("change",function() {        
		var id = this.id;
		if (id == "swActivo") {
			if($("#"+id).is(":checked")) {
				$("#"+id).val('A');
			} else {
				$("#"+id).val('I');
			}
		}
	});

	$( "#btnCerrarSesion" ).click(function(e) {
		e.preventDefault();   
		sessionStorage.clear();
		window.location.href = "index.php";
	});	
});