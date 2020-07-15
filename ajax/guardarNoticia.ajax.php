<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


//GUARDAR USUARIO
if(isset($_POST['titulo'])) { 
	if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_¿?¡!()#@.,;:\'\" ]+$/', $_POST['titulo']) &&
		preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_¿?¡!()\[\]#@.,;:\'\"\s]*$/', $_POST['palabrasClaveHidden'])) {

		/*======================================
		=            VALIDAR IMAGEN            =
		======================================*/
		
		$tabla = "usuarios";
		$item = "id";
		$valor = $_SESSION['id'];
		$usuario = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
		
		$ruta = '';

		if(isset($_FILES['imagenNoticia']['tmp_name']) && $_FILES['imagenNoticia']['tmp_name'] != "") {
			list($ancho, $alto) = getimagesize($_FILES['imagenNoticia']['tmp_name']);

			$nuevoAncho = 500;
			$nuevoAlto = 500;

			$directorio = '../vistas/img/noticias/'.$usuario['usuario'];
			if(!file_exists($directorio)) {
				mkdir($directorio, 0755);
			}

			if($_FILES['imagenNoticia']['type'] == 'image/jpeg') {

				$aleatorio = mt_rand(100,999);
				$ruta  = '../vistas/img/noticias/'.$usuario['usuario'].'/'.$aleatorio.'.jpg';

				$origen = imagecreatefromstring(file_get_contents($_FILES['imagenNoticia']['tmp_name']));
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

				$ruta = substr($ruta, 3);
			}


			if($_FILES['imagenNoticia']['type'] == 'image/png') {

				$aleatorio = mt_rand(100,999);
				$ruta  = '../vistas/img/noticias/'.$usuario['usuario'].'/'.$aleatorio.'.png';
				
				$origen = imagecreatefromstring(file_get_contents($_FILES['imagenNoticia']['tmp_name']));
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

				$ruta = substr($ruta, 3);
			}
		}	
		

		$tabla = "noticias";

		$datos = array("titulo" => $_POST['titulo'],
						"descripcion" => $_POST['descripcion'],
						"palabras_clave" => $_POST['palabrasClaveHidden'],
						"imagen" => $ruta,
						"id_usuario" => $usuario['id']);

		$respuesta = ModeloNoticias::mdlRegistrarNoticia($tabla, $datos);

		if($respuesta == 'ok') { 
			echo 'ok'; 
		}

	} else { 
		echo 'error'; 
	}
}


//EDITAR USUARIO
if(isset($_POST['editarTitulo'])) {
	if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_¿?¡!()#@.,;:\'\" ]+$/', $_POST['editarTitulo']) &&
		preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ_¿?¡!()\[\]#@.,;:\'\"\s]*$/', $_POST['palabrasClaveEditarHidden']) &&
		preg_match('/^[0-9]+$/', $_POST['idNoticia'])) {

		/*======================================
		=            VALIDAR IMAGEN            =
		======================================*/
		
		$tabla = "usuarios";
		$item = "id";
		$valor = $_SESSION['id'];
		$usuario = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);


		$ruta = $_POST['imagenActual'];

		if(isset($_FILES['editarImagenNoticia']['tmp_name']) && !empty($_FILES["editarImagenNoticia"]["tmp_name"])) {
			list($ancho, $alto) = getimagesize($_FILES['editarImagenNoticia']['tmp_name']);

			$nuevoAncho = 500;
			$nuevoAlto = 500;

			$directorio = '../vistas/img/noticias/'.$usuario['usuario'];

			if(!empty($ruta)) {
				unlink('../'.$ruta);
			} else {
				if(!file_exists($directorio)) {
					mkdir($directorio, 0755);
				}
			}

			

			if($_FILES['editarImagenNoticia']['type'] == 'image/jpeg') {

				$aleatorio = mt_rand(100,999);
				$ruta  = '../vistas/img/noticias/'.$usuario['usuario'].'/'.$aleatorio.'.jpg';

				$origen = imagecreatefromstring(file_get_contents($_FILES['editarImagenNoticia']['tmp_name']));
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

				$ruta = substr($ruta, 3);
			}


			if($_FILES['editarImagenNoticia']['type'] == 'image/png') {

				$aleatorio = mt_rand(100,999);
				$ruta  = '../vistas/img/noticias/'.$usuario['usuario'].'/'.$aleatorio.'.png';

				$origen = imagecreatefromstring(file_get_contents($_FILES['editarImagenNoticia']['tmp_name']));
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

				$ruta = substr($ruta, 3);
			}
		}

		$tabla = "noticias";

		$datos = array("titulo" => $_POST['editarTitulo'],
						"descripcion" => $_POST['editarDescripcion'],
						"palabras_clave" => $_POST['palabrasClaveEditarHidden'],
						"imagen" => $ruta,
						"id_noticia" => $_POST['idNoticia']);

		$respuesta = ModeloNoticias::mdlEditarNoticia($tabla, $datos);

		if($respuesta == 'ok') {
			echo 'ok';
		}

	} else {
			echo 'error';
	}

}
