<?php $verif = new ContentCont; ?>
<?php if(isset($_GET["pag"])): ?>

	<nav class="menu-lateral">
		<a href="index.php?pag=main" <?php $verif -> selecNav("main"); ?> ><i class="far fa-hand-pointer"></i>Inicio</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Enlaces</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Juegos</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Investigación</a>
		<hr />
		<a href="index.php?pag=registro" <?php $verif -> selecNav("registro"); ?>><i class="far fa-hand-pointer"></i>Registro</a>
		<a href="index.php?pag=logIn" <?php $verif -> selecNav("logIn"); ?>><i class="far fa-hand-pointer"></i>Inicio Sesión</a>
	</nav>

<?php else: ?>
	<nav class="menu-lateral">
		<a href="index.php?pag=main" class="active"><i class="far fa-hand-pointer"></i>Inicio</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Enlaces</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Juegos</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Investigación</a>
		<hr />
		<a href="index.php?pag=registro"><i class="far fa-hand-pointer"></i>Registrarse</a>
		<a href="index.php?pag=logIn"><i class="far fa-hand-pointer"></i>Inisio Sesión</a>
	</nav>

<?php endif ?>