<?php

require_once "../controladores/noticias.controlador.php";
require_once "../modelos/noticias.modelo.php";


class AjaxNoticias {
	/*======================================
	=            EDITAR NOTICIA            =
	======================================*/
	
	public $idNoticia;

	public function ajaxEditarNoticia() {

		$item = "id";
		$valor = $this->idNoticia;
		$respuesta = ControladorNoticias::ctrMostrarNoticias($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	=        ELIMINAR NOTICIA   	   			 =
	=============================================*/

	public $eliminarNoticia;
	public $imagenNoticia;

	public function ajaxEliminarNoticia() {
		$valor1 = $this->eliminarNoticia;
		$valor2 = $this->imagenNoticia;
		$respuesta = ControladorNoticias::ctrBorrarNoticia($valor1, $valor2);

		echo json_encode($respuesta);
	}

}


/*======================================
	=            EDITAR NOTICIA         =
======================================*/

if(isset($_POST['idNoticia'])) {
	$editar = new AjaxNoticias();
	$editar -> idNoticia = $_POST['idNoticia'];
	$editar -> ajaxEditarNoticia();
}



/*=============================================
=        ELIMINAR NOTICIA      			 =
=============================================*/

if(isset($_POST['eliminarNoticia'])) {
	
	$eliminarNoticia = new AjaxNoticias();
	$eliminarNoticia -> eliminarNoticia = $_POST['eliminarNoticia'];
	$eliminarNoticia -> imagenNoticia = $_POST['imagenNoticia'];
	$eliminarNoticia -> ajaxEliminarNoticia();
}

