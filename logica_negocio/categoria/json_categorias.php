<?php 
	
	require_once("../../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['eliminar_cate']) && $_POST['eliminar_cate']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"categoria",
			"idcategoria"=>$_POST['id']

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
		$array_update = array(
            "table" => "categoria",
            "idcategoria" => $_POST['idcate'],
            "nombre" => $_POST['categoria']
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
	
		$id_insertar = $modelo->retonrar_id_insertar("categoria"); 
        $array_insertar = array(
            "table" => "categoria",
            "idcategoria"=>$id_insertar,
            "nombre" => $_POST['categoria']
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){

        	print json_encode(array("Exito",$_POST,$result,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else{
		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT * FROM categoria";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
				 $htmltr.='<tr>
	                            <td>'.$row['nombre'].'</td>
	                            <td>
	                            <div class="text-center">
	                            <button class="btn btn-primary btn-sm btn_editar" data-nombre="'.$row['nombre'].'" data-id="'.$row['idcategoria'].'"title="Editar"><i class="fas fa-pencil-alt "> EDITAR</i></button>
	                            <button class="btn btn-danger btn-sm btn_eliminar" data-id="'.$row['idcategoria'].'" title="Eliminar"><i class="far fa-trash-alt">BORRAR</i></button>
	                            </div>
	              

	                            </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_usuarios" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

?>