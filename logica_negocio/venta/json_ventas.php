<?php 
	
	require_once("../../Conexion/Modelo.php");
	$modelo = new Modelo();
 if (isset($_POST['eliminar_persona']) && $_POST['eliminar_persona']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"persona",
			"id"=>$_POST['id']

		);
		$resultado = $modelo->eliminar_generica($array_eliminar);
		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }
		


	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {
		$_POST['direccion'] = "Sin direccion";
		$array_update = array(
            "table" => "persona",
            "id" => $_POST['llave_persona'],
            "dui"=>$_POST['dui'],
            "nombre" => $_POST['nombre'],
            "email" => $_POST['email'],
            "direccion" => $_POST['direccion'], 
            "telefono" => $_POST['telefono'],
            "fecha_nacimiento" => $modelo->formatear_fecha($_POST['fecha']), 
            "tipo_persona" => $_POST['tipo_persona']
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }


	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_condui_especifico") {


		
		$resultado = $modelo->get_todos("persona","WHERE id = '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
		// PRIMERO VENTA--LUEGO EL DETALLE
		date_default_timezone_set('America/El_Salvador');
		$fecha=date('Y-m-d');
		  @session_start(); 
		$idpersona=$_SESSION['idpersona'];
		print_r($fecha);

		$id_insertar = $modelo->retonrar_id_insertar("venta"); 
        $array_insertar = array(
            "table" => "venta",
            "idventa"=>$id_insertar,
            "fechaventa" => $fecha,
            "id" => $idpersona
        );
        $result = $modelo->insertar_generica($array_insertar);
        $integer = (int)$_POST['ultimo_elemento'];
        if($result[0]=='1'){

        	for ($i = 0; $i <=$integer ; $i++) {
        	
        		       	/*Luego de la venta van los detalles*/
        	$id_detalle = $modelo->retonrar_id_insertar("detalleventa"); 

	        $array_detalle = array(
	            "table" => "detalleventa",
	            "iddetalle"=>$id_detalle,
	            "idventa" => $id_insertar,
	            "idproducto" =>  $_POST["producto"][$i],
	            "cantidad" => $_POST["cantidad"][$i],
	            "monto" => $_POST["monto"][$i]
	        );

	        

	        $result_detalle = $modelo->insertar_generica($array_detalle);


        	}

        	print json_encode(array("Exito",$id_insertar,$_POST,$result,$result_detalle));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="combo") {
	$array_select = array(
			"table"=>"producto",
			"idproducto"=>"nombre"

		);
		 
		$result_select = $modelo->crear_select($array_select);
		if($result_select[0]!="0"){
		print json_encode(array("Exito",$_POST,$result_select));
			exit();
  }else {
        	print json_encode(array("Error",$_POST,$result_select));
			exit();
        }

	}else{
			 //AQUI CARGAMOS TODOS LOS DEPARTAMENTOS
		// Chales no entiendo este metodo JAJAJAJA
		$array_select = array(
			"table"=>"producto",
			"idproducto"=>"nombre"

		);
		 
		$result_select = $modelo->crear_select($array_select);


		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT * FROM venta";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
				// $cuantos = $row['cuantos'];
//<td>'.$modelo->formatear_fecha($row['fechaventa']).'</td>
				$cuantos = 4;
				 $htmltr.='<tr>
	                           	<td>'.$row['fechaventa'].'</td>
	                            <td>'.$row['idventa'].'</td>
	                            <td>'.$cuantos.'</td>
	                            <td>
	                            	<div class="dropdown m-b-10">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Seleccione
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a data-id="'.$row['idventa'].'" class="dropdown-item btn_editar" idventaref="javascript:void(0)">Editar</a>
                                            <a data-id="'.$row['idventa'].'" class="dropdown-item btn_eliminar" href="javascript:void(0)">Eliminar</a>
                                             <button type="button" class="btn btn-outline-danger" id="quitar_fila" >Ver</button>
                                        </div>
                                    </div>

	                            </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_venta" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Vendedor</th>
                            <th>Monto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$cuantos,$result_select,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}




?>