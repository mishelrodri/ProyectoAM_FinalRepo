<?php 
	
	require_once("../../Conexion/Modelo.php");
	$modelo = new Modelo();
 if (isset($_POST['eliminar_producto']) && $_POST['eliminar_producto']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"producto",
			"idproducto"=>$_POST['id']

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
              "table" => "producto",
            "idproducto"=>$_POST['llaveproducto'],
            "nombre" => $_POST['nombre'],
            "stock" => $_POST['stock'],
            "precio" => $_POST['precio'],
            "idcategoria" => $_POST['idcategoria'],
            "dimension" => $_POST['dimension'],
            "color" => ($_POST['color']),
            "material" =>($_POST['material'])
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }


	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si") {

		$resultado = $modelo->get_todos("producto","WHERE idproducto= '".$_POST['id']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
	
		$id_insertar = $modelo->retonrar_id_insertar("producto"); 
        $array_insertar = array(
            "table" => "producto",
            "idproducto"=>$id_insertar,
            "nombre" => $_POST['nombre'],
            "stock" => $_POST['stock'],
            "precio" => $_POST['precio'],
            "idcategoria" => $_POST['idcategoria'],
            "dimension" => $_POST['dimension'],
            "color" => ($_POST['color']),
            "material" =>($_POST['material'])
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
		$sql = "SELECT p.idproducto,p.nombre,p.stock,p.precio, p.dimension,p.color,p.material,c.nombre as cate FROM producto p inner join categoria c on c.idcategoria=p.idcategoria ";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
				
				 $htmltr.='<tr>
	                            <td>'.$row['nombre'].'</td>
	                            <td>'.$row['stock'].'</td>
	                            <td>'.$row['precio'].'</td>
	                            <td>'.$row['dimension'].'</td>
	                            <td>'.$row['color'].'</td>
	                            <td>'.$row['material'].'</td>
	                            <td>'.$row['cate'].'</td>
	                            <td>
	                            	<div class="dropdown m-b-10">
                                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Seleccione
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a data-id="'.$row['idproducto'].'" class="dropdown-item btn_editar" href="javascript:void(0)">Editar</a>
                                            <a data-id="'.$row['idproducto'].'" class="dropdown-item btn_eliminar" href="javascript:void(0)">Eliminar</a>
                                        </div>
                                    </div>

	                            </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_productos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Dimension</th>
                            <th>Color</th>
                            <th>Material</th>
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