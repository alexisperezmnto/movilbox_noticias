<?php

class ControladorNoticias {

    /*=============================================
				MOSTRAR NOTICIAS
	=============================================*/

	static public function ctrMostrarNoticias($item,$valor) {

		$tabla = 'noticias';
		$respuesta = ModeloNoticias::mdlMostrarNoticias($tabla,$item,$valor);

		return $respuesta;


    }

    static public function ctrMostrarNoticiasUsuario($item,$valor) {

		$tabla = 'noticias';
		$respuesta = ModeloNoticias::mdlMostrarNoticiasUsuario($tabla,$item,$valor);

		return $respuesta;


    }

    /*=============================================
				ELIMINAR NOTICIA
	=============================================*/

	static public function ctrBorrarNoticia($valor1, $valor2) {
        
		$tabla = "noticias";
        $datos = $valor1;
        
        if($valor2 != "") {
            $file = '../'.$valor2;
            
            if(file_exists($file)) {
                unlink($file);
            }
        }

        $respuesta = ModeloNoticias::mdlBorrarNoticia($tabla, $datos);

        if($respuesta == 'ok') {
            return 'ok';
        } else {
            return 'error';
        }
		
	}
    
}