<main class="main">
	<div class="grid-formulario">
		<form method="post">
			<div class="input">
				<p>Correo Electronico</p>
				<input type="text" id="email" name="ingresoEmail" placeholder="alguien@gmail.com"></input>
			</div>
			<div class="input">
				<p>Contrasena</p>
				<input type="password" id="password" name="ingresoPassword"></input>
			</div>
			</br>
			<div class="enviar">
				<button type="submit">Ingresar</button>
			</div>
		</form>
		</br>
	</div>

	<?php 
	
		$ingreso = new FormulariosControl;
		$ingreso -> ctrlIngreso();
		


	?>

</main>

