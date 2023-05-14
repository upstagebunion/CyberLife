<?php

	require_once "conexion.php";

	class FormularioModel{
	
		/*Registro*/

		static public function mdlRegistro($tabla, $datos){
		
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, email, password) VALUES (:usuario, :email, :password)");

			$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
			$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);

			if($stmt -> execute()){
				return "ok";
			}else{
				print_r(Conexion::conectar()->errorInfo());
			}
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlObtenerRegistro($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}

		static public function mdlSubirArchivo($temp, $nombre){
			if (move_uploaded_file($temp,"documentos/".$nombre)){
				return "ok";
			}
		}

		static public function dbSubirArchivo($tabla, $datos){
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(autor_id, nombre, ruta, contenido) VALUES (:autor_id, :nombre, :ruta, :contenido)");

			$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
			$stmt -> bindParam(":autor_id", $datos["autor_id"], PDO::PARAM_STR);
			$stmt -> bindParam(":contenido", $datos["contenido"], PDO::PARAM_STR);

			if($stmt -> execute()){
				return "ok";
			}else{
				print_r(Conexion::conectar()->errorInfo());
			}
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlObtenerDocumentos($tabla, $usuario, $item){
			if($usuario == null && $item == null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY doc_id DESC");
				$stmt -> execute();
				return $stmt -> fetchAll();
			
				$stmt -> close();
				$stmt = null;
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor ORDER BY doc_id DESC");
				$stmt -> bindParam(":valor", $usuario, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			
				$stmt -> close();
				$stmt = null;
			}
		}

		static public function mdlObtenerNombre($tabla, $id, $item){
			$stmt = Conexion::conectar()->prepare("SELECT usuario FROM $tabla WHERE $item = :valor");
			$stmt -> bindParam(":valor", $id, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
			
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlModificarEstado($tabla, $doc_id, $nuevoEstado){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :valor WHERE doc_id = :docId ");
			$stmt -> bindParam(":valor", $nuevoEstado, PDO::PARAM_INT);
			$stmt -> bindParam(":docId", $doc_id, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				print_r(Conexion::conectar() -> errorInfo());
			}
			
			$stmt -> close();
			$stmt = null;
		}

		static public function mdlEliminarDoc($ruta){
			$eliminar = unlink($ruta);
			if ($eliminar == true){
				return "ok";
			}else{
				return $eliminar;
			}
		}

		static public function dbEliminarDoc($tabla, $doc_id){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE doc_id = :valor");
			$stmt -> bindParam(":valor", $doc_id, PDO::PARAM_INT);

			if($stmt -> execute()){
				return "ok";
			}else{
				print_r(Conexion::conectar() -> errorInfo());
			}
			
			$stmt -> close();
			$stmt = null;
		}
	}

?>