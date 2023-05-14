<main class="main">
	<div class="grid-formulario">
		<form method="post">
			<div class="input">
				<p>Usuario</p>
				<input type="text" id="usuario" name="rUsuario" placeholder="Usuario" required></input>
			</div>
			<div class="input">
				<p>Correo Electronico</p>
				<input type="text" id="email" name="email" placeholder="alguien@gmail.com" required></input>
			</div>
			<div class="input">
				<p>Contrasena</p>
				<input type="password" id="password" name="password" required></input>
			</div>
			</br>
			<div class="enviar">
				<button type="submit">Registrarse</button>
			</div>
		</form>
		</br>
	</div>
		<?php 
	
			$registro = FormulariosControl::ctrlRegistro();

			if($registro == "ok"){
				echo '<script>
						if(window.history.replaceState){
				
							window.history.replaceState(null, null, window.location.href);
				
						}
		
					 </script>';

					 echo "	<div class='notificacion'> El usuario se ha registrado correctamente</div>";
			}
			else{
				echo "<div class='notificacionE'> ".$registro."</div>
				<script>
						if(window.history.replaceState){
				
							window.history.replaceState(null, null, window.location.href);
						}
				</script>";
			}

		?>
</main>

