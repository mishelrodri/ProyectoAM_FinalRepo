$(function (){
	$('#formulario_registro').parsley();


	cargar_datos();
	


	
	$(document).on("click",".btn_cerrar_class",function(e){
		e.preventDefault();
		$("#formulario_registro").trigger('reset');
		$('#md_registrar_producto').modal('hide');


	});

	$(document).on("click",".btn_eliminar",function(e){
		e.preventDefault();
		var id = $(this).attr("data-id");
		var datos = {"eliminar_producto":"si_eliminala","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_producto.php',
	        data : datos,
	    }).done(function(json) {
	    	cargar_datos();

	    });
	});
	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		mostrar_mensaje("Consultando datos");
		var id = $(this).attr("data-id");
		console.log("El id es: ",id);
		var datos = {"consultar_info":"si","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_producto.php',
	        data : datos,
	    }).done(function(json) {
	    	console.log("EL consultar especifico",json);
	    	if (json[0]=="Exito") {
	    	
	    		$('#llaveproducto').val(id);
	    		$('#ingreso_datos').val("si_actualizalo");
	    		$('#nombre').val(json[2]['nombre']);
	    		$('#stock').val(json[2]['stock']);
	    		$('#precio').val(json[2]['precio']);
	    		$('#idcategoria').val(json[2]['idcategoria']);
	    		$('#dimension').val(json[2]['dimension']);
	    		$('#color').val(json[2]['color']);
	    		$('#material').val(json[2]['material']);	
				
	    		$('#md_registrar_producto').modal('show');
	    	}
	    	 
	    }).fail(function(){

	    }).always(function(){
	    	Swal.close();
	    });


	});



	$(document).on("click","#registrar_producto",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#md_registrar_producto').modal('show');

		$(".select2").select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });
    
	});


	$(document).on("submit","#formulario_registro",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro").serialize();
		console.log("Imprimiendo datos: ",datos);
		mostrar_mensaje("Almacenando información","Por favor no recargue la página");
		$.ajax({
            dataType: "json",
            method: "POST",
            url:'json_producto.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	$('#md_registrar_producto').modal('hide');
        	cargar_datos();
        }).fail(function(){

        }).always(function(){

        });


	});
});

function cargar_datos(){
	mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'json_producto.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	$("#cantidad_usuarios").empty().html(json[2]);
    	$('#tabla_usuarios').DataTable();
    	$('#md_registrar_usuario').modal('hide');
    }).fail(function(){

    }).always(function(){
    	Swal.close();
    });
}

function mostrar_mensaje(titulo,mensaje=""){
	Swal.fire({
	  title: titulo,
	  html: mensaje,
	  allowOutsideClick: false,
	  timerProgressBar: true,
	  didOpen: () => {
	    Swal.showLoading()
	     
	  },
	  willClose: () => {
	     
	  }
	}).then((result) => {
	  
	   
	})
}