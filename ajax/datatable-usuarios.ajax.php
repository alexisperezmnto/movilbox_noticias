<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class TablaUsuarios{

 	/*=============================================
 	 MOSTRAR LA TABLA DE USUARIOS
  	=============================================*/ 

	public function mostrarTablaUsuarios(){

		$item = null;
    	$valor = null;

  		$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($usuarios); $i++){

		  	if($usuarios[$i]["foto"] != '') {
	            $foto =  "<img src='".$usuarios[$i]['foto']."' class='centrarElemento img-thumbnail' width='40px'>";
	          } else {
	            $foto = "<img src='vistas/img/usuarios/default/anonymous.png' class='centrarElemento img-thumbnail' width='40px'>";
	          }

	        if($usuarios[$i]['estado'] != 0) {
	            $estado = "<button class='btn btn-success btn-xs centrarElemento btnActivar' idUsuario='".$usuarios[$i]['id']."'  estadoUsuario='0'>Activado</button>";
	          } else {
	            $estado = "<button class='btn btn-danger btn-xs centrarElemento btnActivar' idUsuario='".$usuarios[$i]['id']."'  estadoUsuario='1'>Desactivado</button>";
	          }

			  $accion = "<button class='btn btn-primary btn-sm mr-2 btnEditarUsuario' idUsuario='".$usuarios[$i]["id"]."' data-toggle='modal' data-target='#modalEditarUsuario'>Editar</button>".
			   "<button class='btn btn-danger btn-sm btnEliminarUsuario' idUsuario='".$usuarios[$i]["id"]."' fotoUsuario='".$usuarios[$i]['foto']."' usuario='".$usuarios[$i]['usuario']."'>Eliminar</button>"; 
		  	

	    	$datosJson .='[
		      "'.$usuarios[$i]["nombre"].'",
		      "'.$usuarios[$i]["email"].'",
		      "'.$usuarios[$i]["usuario"].'",
		      "'.$foto.'",
		      "'.$usuarios[$i]["perfil"].'",
		      "'.$estado.'",
		      "'.$accion.'"
		    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}

}


$usuarios = new TablausUarios();
$usuarios -> mostrarTablaUsuarios();

