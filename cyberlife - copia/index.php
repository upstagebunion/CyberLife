<?php

	session_start();

?>
<?php
    require_once "controllers/TempCont.php";
    require_once "controllers/ContCont.php";
    require_once "controllers/FormulariosCont.php";
    require_once "models/formularios.php";


    $plantilla = new TemplateControl();
    $plantilla -> traerPlantilla();
?>