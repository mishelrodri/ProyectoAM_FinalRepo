$(function (){
	$('#formulario_registro').parsley();


	cargar_datos();
	

	// QUITAR Y PONER FILAS

	
	$(document).on("click",".btn_cerrar_class",function(e){
		e.preventDefault();
		$("#formulario_venta").trigger('reset');
		$('#md_registrar_venta').modal('hide');


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



	$(document).on("click","#registrar_venta",function(e){
		e.preventDefault();
		console.log("Capturando evento");
		//$('#myModal').modal('show'); para abrir modal
		//$('#myModal').modal('hide'); para cerrar modal
		$('#md_registrar_venta').modal('show');

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
            url:'json_ventas.php',
            data : datos,
        }).done(function(json) {
        	console.log("EL GUARDAR",json);
        	$('#md_registrar_venta').modal('hide');
        	   	cargar_datos();
    
        }).fail(function(){

        }).always(function(){
        	Swal.close();
        });


	});
});

function cargar_datos(){
	mostrar_mensaje("Consultando datos");
	var datos = {"consultar_info":"si_consultala"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'json_ventas.php',
        data : datos,
    }).done(function(json) {
    	console.log("EL consultar",json);
    	$("#datos_tabla").empty().html(json[1]);
    	// $("#cantidad_usuarios").empty().html(json[2]);
    	$('#tabla_venta').DataTable();
    	$("#producto_0").empty().html(json[3][0]);
    //	cargarcombo();

    	$('#md_registrar_venta').modal('hide');
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




    $(document).on("click","#agregar_fila",function(){
console.log('entro');
  var numero = parseInt($(ultimo_elemento).attr("data-numero"))+1;
  var html = "";
  // es de ponerle datas a todos 3 elementos del row porque al almacenarlos tengo que guardar eso 
  html += '<div class="row" id=fila><div class="col-md-6"><div class="form-group"><label class="control-label">Producto</label><select id="producto_'+numero+'"   name="producto[]"  class="form-control select2 "></select></div></div><div class="col-md-3"><div class="form-group"><label>Cantidad</label><input type="text" autocomplete="off" name="cantidad[]" data-parsley-required-message="El nombre es requerido" id="cantidad_'+numero+'"  class="form-control" required placeholder="Ingrese su nombre"/></div></div><div class="col-md-3"><div class="form-group"><label>Monto</label><input type="text" autocomplete="off"  name="monto[]" data-parsley-required-message="El nombre es requerido" id="monto_'+numero+'" data-monto_1="0" class="form-control" required placeholder="Ingrese "/></div></div></div>';
 
  $("#filas").append(html);

  	$("#producto_"+numero).select2({
	    }).on("select2:opening", 
	        function(){
	            $(".modal").removeAttr("tabindex", "-1");
	    }).on("select2:close", 
	        function(){ 
	            $(".modal").attr("tabindex", "-1");
	    });

$(ultimo_elemento).attr("data-numero",numero);
	$('#ultimo_elemento').val(numero);
 //document.querySelector("#ultimo_elemento").value
  cargarcombo(numero);
  });

    function cargarcombo(num){
		var datos = {"consultar_info":"combo"}
	$.ajax({
        dataType: "json",
        method: "POST",
        url:'json_ventas.php',
        data : datos,
    }).done(function(json) {

    	$("#producto_"+num).empty().html(json[2][0]);
    }).fail(function(){

    }).always(function(){

    });
}

    $(document).on("click","#quitar_fila",function(){

var elementos = $("#filas #fila");
 var tamanio = $("#filas #fila").length;
 var a = elementos[tamanio-1];
 
 if (tamanio > 1) {
      
         $(a).remove();
     var numero = parseInt($(ultimo_elemento).attr("data-numero"))-1;
		$(ultimo_elemento).attr("data-numero",numero);
     	$('#ultimo_elemento').val(numero);
       }

});