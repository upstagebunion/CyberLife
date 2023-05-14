<?php

	Class ContentCont{
	
		public function contenido(){
			if(isset($_GET["pag"])){
				if($_GET["pag"] == "main" || $_GET["pag"] == "registro" || $_GET["pag"] == "logIn" || $_GET["pag"] == "subirTrabajo" || $_GET["pag"]== "cerrar" || $_GET["pag"]== "perfil"){
					$result = "views/moduls/".$_GET["pag"].".php";
				}else{
					$result = "views/moduls/error404.php";
				}
			}elseif(isset($_GET["user"])){
				$result = "views/moduls/user.php";
			}else{
				$result = "views/moduls/main.php";
			}


			include $result;
		}

		public function selecNav($pagAct){
			if(isset($_GET["pag"])){
				$page = $_GET["pag"];
			
				if ($page == $pagAct){
					echo "class='active'";
				}
			}else{
				echo "class='active'";
			}
		}

		static public function ctrlNav(){
			if(!isset($_SESSION["accesAllow"])){
				return "views/moduls/nav.php";
			}elseif($_SESSION["accesAllow"] != "ok"){
					return "views/moduls/nav.php";
			}else{
				if($_SESSION["accesAllow"] == "ok"){
					return "views/moduls/nav-adm.php";
				}
			}
		}

	}

?>