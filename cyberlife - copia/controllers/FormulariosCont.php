<?php

	class FormulariosControl{

		static public function ctrlObtenerDocs(){
			$tabla = "documentos";
			$respuesta = FormularioModel::mdlObtenerDocumentos($tabla, null, null);

			return $respuesta;
		}
		
		static public function ctrlObtenerDocsUser(){
			$tabla = "documentos";
			$usuario = $_SESSION['id'];
			$item = "autor_id";
			$respuesta = FormularioModel::mdlObtenerDocumentos($tabla, $usuario, $item);

			return $respuesta;
		}
		static public function ctrlObtenerNombre($id){
			$tabla = "registros";
			$item = "id";
			$respuesta = FormularioModel::mdlObtenerNombre($tabla, $id, $item);

			return $respuesta;
		}
		/*REGISTRO*/

		static public function ctrlRegistro(){

			if(isset($_POST["rUsuario"]) && $_POST["rUsuario"] != "" && strlen($_POST["rUsuario"]) <= 20 ){
				if(isset($_POST["email"]) && $_POST["email"] != "" && strpos($_POST["email"],"@") != false){
					if(isset($_POST["password"]) && $_POST["password"] != "" && strlen($_POST["password"]) >= 7){

						$item = "email";
						$tabla = "registros";
						$emailExist = FormularioModel::mdlObtenerRegistro($tabla,$item,$_POST["email"]);

						if(empty($emailExist) || count($emailExist) == 0){
							$tabla = "registros";
							$datos = array("usuario" => $_POST["rUsuario"],"email" => $_POST["email"], "password" => $_POST["password"]);

							$respuesta =  FormularioModel::mdlRegistro($tabla, $datos);

							return $respuesta;
						}else{
							return "Ese correo electrónico ya está registrado";
						}
					}else{
						return "Inserte Alguna contrasena (Min. 7 Caracteres)";
					}
				}else{
					return "Inserte su email";
				}
			}else{
				return "Rellene el campo de Usuario (Max. 20 Caracteres)";
			}
		
		}

		/*INGRESAR*/

		public function ctrlIngreso(){
			if(isset($_POST["ingresoEmail"])){
				$tabla = "registros";
				$item = "email";
				$valor = $_POST["ingresoEmail"];
				$respuesta = FormularioModel::mdlObtenerRegistro($tabla, $item, $valor);
				if($respuesta != null){
					if($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $_POST["ingresoPassword"]){

						$_SESSION["accesAllow"] = "ok";
						$_SESSION["user"] = $respuesta["usuario"];
						$_SESSION["id"] = $respuesta["id"];

						if($respuesta["admin"] == 1){
							$_SESSION["admin"] = true;
								echo "<div class='notificacion'>Ingreso Exitoso, Usted es Administrador</div>";
								echo '<script>
									if(window.history.replaceState){
				
										window.history.replaceState(null, null, window.location.href);
				
									}
									window.location = "index.php?pag=main";
		
								</script>';
						}else{
							$_SESSION["admin"] = false;
							echo "<div class='notificacion'>Ingreso Exitoso</div>";
							echo '<script>
								if(window.history.replaceState){
				
									window.history.replaceState(null, null, window.location.href);
				
								}
								window.location = "index.php?pag=main";
		
							</script>';
						}
					}else{
						echo "<script>
							if(window.history.replaceState){
				
								window.history.replaceState(null, null, window.location.href);
				
							}
		
						</script>";
						echo "<div class='notificacionE'>El correo y la contrasena ingresada no coinciden</div>";
					}
				}else{
					echo "<script>
							if(window.history.replaceState){
				
								window.history.replaceState(null, null, window.location.href);
				
							}
		
						</script>";
						echo "<div class='notificacionE'>El correo y la contrasena ingresada no coinciden</div>";
				}
			}
		}

		static public function subirArchivo(){
		
			if(isset($_POST["nombre"]) && $_POST["nombre"] != "" && strlen($_POST["nombre"]) <= 30 ){
				if(isset($_FILES["archivo"])){
					$nombreArchivo = $_FILES["archivo"]["name"];
					$nombreTemp =$_FILES["archivo"]["tmp_name"];
					$tipoArchivo =$_FILES["archivo"]["type"];
					$fileSize = $_FILES["archivo"]["size"];

					if($tipoArchivo == "application/msword" || $tipoArchivo == "application/pdf" || $tipoArchivo == "application/vnd.ms-excel" || $tipoArchivo == "application/vnd.ms-powerpoint" || $tipoArchivo == "application/vnd.oasis.opendocument.text" || $tipoArchivo == "application/vnd.openxmlformats-officedocument.presentationml.presentation" || $tipoArchivo == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $tipoArchivo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
						if($fileSize <= 2000000){
							$subida = FormularioModel::mdlSubirArchivo($nombreTemp, $nombreArchivo);
						}else{
							return "El archivo es demasiado pesado (Máximo 2 Mb)";
						}
					}else{
						return "Formato de archivo no es Valido";
					}
				}else{
					return "Seleccione un archivo";
				}


				if($subida == "ok"){
					$tabla = "documentos";
					$ruta = "documentos/".$nombreArchivo;
					$datos = array("nombre" => $_POST["nombre"], "ruta" => $ruta, "autor_id" => $_SESSION["id"], "contenido" => $_POST["contenido"]);
					$respuesta =  FormularioModel::dbSubirArchivo($tabla, $datos);
				}else{
					$respuesta = "No se pudo guardar el archivo";
				}

				return $respuesta;
			}else{
				return "Rellene el campo de Nombre (Max. 30 Caracteres)";
			}
		
		}

		static public function cambiarEstado(){
			if(array_key_exists('estado-send',$_POST)){
				if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
					$tabla = "documentos";
					$doc_id = $_POST['doc_id'];
					if($_POST['estado'] == 0){
						$nuevoEstado = 1;
					}elseif($_POST['estado'] == 1){
						$nuevoEstado = 0;
					}

					$respuesta = FormularioModel::mdlModificarEstado($tabla, $doc_id, $nuevoEstado);
					if ($respuesta == "ok"){
						echo '<script>
							if(window.history.replaceState){
								window.history.replaceState(null, null, window.location.href);
							}
							window.location = "index.php?pag=perfil";
							</script>';
						echo "<div class='notificacion'>Se ha actualizado</div>";
					}else{
						echo "<div class='notificacionE'>Ha ocurrido un error al actualizar</div>";
					}
				}
			}
		}

		static public function ctrlEliminarDoc(){
			if(array_key_exists('eliminar',$_POST) && $_SESSION["accesAllow"] == "ok"){
				$tabla = "documentos";
				$doc_id = $_POST['id_doc_elim'];
				$ruta = $_POST['ruta_elim'];
				if (isset($_SESSION['admin']) && $_SESSION['admin']==true){
					$respuesta = FormularioModel::mdlEliminarDoc($ruta);
					if ($respuesta == "ok"){
						$eliminar = FormularioModel::dbEliminarDoc($tabla, $doc_id);
						if ($eliminar == "ok"){
							echo '<script>
								if(window.history.replaceState){
									window.history.replaceState(null, null, window.location.href);
								}
								window.location = "index.php?pag=perfil";
								</script>';
							echo "<div class='notificacion'>Se ha eliminado el archivo</div>";
						}else{
							echo '<script>
								if(window.history.replaceState){
									window.history.replaceState(null, null, window.location.href);
								}
								</script>';
							echo "<div class='notificacion'>Ha ocurrido un problema al conectar con la base de datos</div>";
						}
					}else{
						echo "<div class='notificacionE'>Ha ocurrido un problema al eliminar el archivo</div>";
					}
				}elseif($_POST['autor_doc_elim'] == $_SESSION['id']){
					$respuesta = FormularioModel::mdlEliminarDoc($ruta);
					if ($respuesta == "ok"){
						$eliminar = FormularioModel::dbEliminarDoc($tabla, $doc_id);
						if ($eliminar == "ok"){
							echo '<script>
								if(window.history.replaceState){
									window.history.replaceState(null, null, window.location.href);
								}
								window.location = "index.php?pag=perfil";
								</script>';
							echo "<div class='notificacion'>Se ha eliminado el archivo</div>";
						}else{
							echo '<script>
								if(window.history.replaceState){
									window.history.replaceState(null, null, window.location.href);
								}
								</script>';
							echo "<div class='notificacion'>Ha ocurrido un problema al conectar con la base de datos</div>";
						}
					}else{
						echo "<div class='notificacionE'>Ha ocurrido un problema al eliminar el archivo</div>";
					}
				}else{
					echo "<div class='notificacionE'>Usted no tiene permisos para eliminar este archivo</div>";
				}
			}
		}
	}

?>