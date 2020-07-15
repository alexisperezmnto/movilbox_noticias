<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaNoticias{

 	/*=============================================
 	 MOSTRAR LA TABLA DE NOTICIAS
  	=============================================*/ 

	public function mostrarTablaNoticias(){

		
		if($_SESSION['perfil'] == 'Administrador') {
			$item = null;
			$valor = null;
			$noticias = ControladorNoticias::ctrMostrarNoticias($item, $valor);	
		} else {
			$item = 'id_usuario';
			$valor = $_SESSION['id'];
			$noticias = ControladorNoticias::ctrMostrarNoticiasUsuario($item, $valor);
		}

		
		if(count($noticias) > 0) {

			$datosJson = '{
			"data": [';

			for($i = 0; $i < count($noticias); $i++){

				if($noticias[$i]["imagen"] != '') {
					$imagen =  "<img src='".$noticias[$i]['imagen']."' class='img-thumbnail' width='40px'>";
				} else {
					$imagen = '';
				}
				

				$descripcion = strip_tags($noticias[$i]["descripcion"]);			
				$descripcion = substr($descripcion, 0, 80) . '...';

				
				$palabrasClave = '';

				if($noticias[$i]["palabras_clave"] != '') {

					$palabras = json_decode($noticias[$i]["palabras_clave"], true);

					foreach($palabras as $palabra) {
						$palabrasClave .= $palabra . ' - ';
					}

					$palabrasClave = substr($palabrasClave, 0 ,-2);
				}

				$item = 'id';
				$valor = $noticias[$i]['id_usuario'];
				$usuario = ControladorUsuarios::ctrMostrarUsuarios($item,$valor);


				$fecha = new DateTime($noticias[$i]["created_at"]);
				$fecha = $fecha->format('d/m/Y'); 

				$accion = "<button class='btn btn-primary btn-sm mr-2 btnEditarNoticia' idNoticia='".$noticias[$i]["id"]."' data-toggle='modal' data-target='#modalEditarNoticia'>Editar</button>".
				"<button class='btn btn-danger btn-sm btnEliminarNoticia' idNoticia='".$noticias[$i]["id"]."' imagenNoticia='".$noticias[$i]['imagen']."' usuario='".$noticias[$i]['id_usuario']."'>Eliminar</button>"; 


				$datosJson .='[
				"'.$imagen.'",
				"'.$noticias[$i]["titulo"].'",
				"'.$descripcion.'",
				"'.$palabrasClave.'",
				"'.$usuario['nombre'].'",
				"'.$fecha.'",
				"'.$accion.'"
				],';

			}

			$datosJson = substr($datosJson, 0, -1);

			$datosJson .=   '] 

			}';
			
			echo $datosJson;
		
		} else {

			$datosJson = '{"data":[["","","","","","",""]]}';

			echo $datosJson;
		}


	}

}


$noticias = new TablaNoticias();
$noticias -> mostrarTablaNoticias();

