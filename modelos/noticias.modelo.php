<?php

require_once 'conexion.php';

class ModeloNoticias {

    /*=============================================
				MOSTRAR NOTICIAS
	=============================================*/

	static public function mdlMostrarNoticias($tabla, $item, $valor) {

		if($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();	
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY created_at DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();	
		}
		
		$stmt -> close();
		$stmt = null;
    }
    
    static public function mdlMostrarNoticiasUsuario($tabla, $item, $valor) {

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY created_at DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		
		$stmt -> close();
		$stmt = null;
    }

    /*=============================================
				REGISTRO NOTICIAS
	=============================================*/

	static public function mdlRegistrarNoticia($tabla, $datos) {
		$stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(titulo,descripcion,palabras_clave,imagen,id_usuario)	
            VALUES (:titulo, :descripcion, :palabras_clave, :imagen, :id_usuario)");

		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabras_clave", $datos["palabras_clave"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);

		if($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
    }
    
    /*=============================================
				EDITAR NOTICIAS
	=============================================*/
	static public function mdlEditarNoticia($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion,
            palabras_clave = :palabras_clave, imagen = :imagen WHERE id = :id");

		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabras_clave", $datos["palabras_clave"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id_noticia"], PDO::PARAM_INT);

		if($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
    }
    
    /*=============================================
				ELIMINAR NOTICIAS
	=============================================*/

	static public function mdlBorrarNoticia($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);
		if($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
}