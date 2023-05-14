<?php 
    if(isset($_SESSION["accesAllow"]) && $_SESSION["accesAllow"] == "ok"){
        if($_SESSION['admin'] == true){
            $documentos = FormulariosControl::ctrlObtenerDocs();
        }else{
            $documentos = FormulariosControl::ctrlObtenerDocsUser();
        }
    }else{
        echo '<script>window.location = "index.php?pag=logIn";</script>';
    }

?>

<?php if ($_SESSION['admin'] == true): ?>
<div class="perfil">
	<div class="table">
		 <table>
              <tr class ="titulo">
                <th>Usuario</th>
                <th>Archivo</th>
                <th>Eliminar</th>
                <th>Estado</th>
                <th class="descripcion">Descripcion</th>
                <th>cambiar estado</th>
              </tr>
              <?php foreach ($documentos as $key => $value): ?>
                  <tr class="<?php if($value['estado'] == 1){echo 'listo';}else{echo '';} ?>">
                    <td><?php $usuario = FormulariosControl::ctrlObtenerNombre($value['autor_id']); echo $usuario[0];?></td>
                    <td><a href="<?php echo $value['ruta']?>" target="_blank"><?php echo $value['nombre']?></a></td>
                    <td><form method="post"><input type="hidden" name="ruta_elim" value="<?php echo $value['ruta'];?>"></input><input type="hidden" name="autor_doc_elim" value="<?php echo $value['autor_id'];?>"></input><input type="hidden" name="id_doc_elim" value="<?php echo $value['doc_id'];?>"></input><input class ="eliminar" type="submit" name="eliminar" value="eliminar"></input></form></td>
                    <td><?php if($value['estado'] == 0){echo "pendiente";}elseif($value['estado'] == 1){echo "Listo";} ?></td>
                    <td class="descripcion"><?php echo $value['contenido']?></td>
                    <td><form method="post"><input type="hidden" name="doc_id" value="<?php echo $value['doc_id'];?>"></input><input type="hidden" name="estado" value="<?php echo $value['estado'];?>"></input><input type="submit" name="estado-send" value="cambiar"></input></form></td>
                  </tr>
              <?php endforeach ?>
        </table> 
	</div>
</div>
<?php else: ?>
<div class="perfil">
	<div class="table">
		 <table>
              <tr>
                <th>Usuario</th>
                <th>Archivo</th>
                <th>Eliminar</th>
                <th>Descripcion</th>
                <th>Estado</th>
              </tr>
              <?php foreach ($documentos as $key => $value): ?>
                  <tr class="<?php if($value['estado'] == 1){echo 'listo';}else{echo '';} ?>">
                    <td><?php $usuario = FormulariosControl::ctrlObtenerNombre($value["autor_id"]); echo $usuario[0];?></td>
                    <td><a href="<?php echo $value['ruta']?>"><?php echo $value['nombre']?></a></td>
                    <td><form method="post"><input type="hidden" name="ruta_elim" value="<?php echo $value['ruta'];?>"></input><input type="hidden" name="autor_doc_elim" value="<?php echo $value['autor_id'];?>"></input><input type="hidden" name="id_doc_elim" value="<?php echo $value['doc_id'];?>"></input><input class ="eliminar" type="submit" name="eliminar" value="eliminar"></input></form></td>
                    <td><?php echo $value['contenido']?></td>
                    <td><?php if($value['estado'] == 0){echo "pendiente";}elseif($value['estado'] == 1){echo "Listo";} ?></td>
                  </tr>
              <?php endforeach ?>
        </table> 
	</div>
</div>
<?php endif ?>

<?php 
    
    FormulariosControl::cambiarEstado();
    FormulariosControl::ctrlEliminarDoc();

?>