$(function (){
	$('#formulario_registro').parsley();

	cargar_datos();
	// $(".select2").select2();

	$(document).on("click",".btn_eliminar",function(e){
		e.preventDefault();
		console.log("ENTRA");
		var id = $(this).attr("data-id");
		var datos = {"eliminar_cate":"si_eliminala","id":id}
		$.ajax({
	        dataType: "json",
	        method: "POST",
	        url:'json_categorias.php',
	        data : datos,
	    }).done(function(json) {
	    	cargar_datos();

	    });
	});

	$(document).on("click",".btn_editar",function(e){

		e.preventDefault(); 
		var nombre = $(this).attr("data-nombre");
		var id = $(this).attr("data-id");

	    		$('#categoria').val(nombre);
	    		$('#idcate').val(id);
				$('#ingreso_datos').val("si_actualizalo");
				$('#ingreso_datos').val("si_actualizalo");
				$('#boton').val("Actualizar");
				
	});




	$(document).on("click","#boton",function(e){
		e.preventDefault();
		var datos = $("#formulario_registro").serialize();
		console.log("Imprimiendo datos: ",datos);

		$.ajax({
            dataType: "json",
            method: "POST",
            url:'json_categorias.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        		$('#ingreso_datos').val("si_registro");
				$('#boton').val("Agregar");
				$('#formulario_registro').trigger('reset');

        	cargar_datos();
        }).fail(function(){

        }).always(function(){

        });


	});
});

function cargar_datos(){
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'json_categorias.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	$('#tabla_usuarios').DataTable();
    }).fail(function(){

    }).always(function(){

    });
}