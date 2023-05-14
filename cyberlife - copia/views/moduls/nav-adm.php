<?php $verif = new ContentCont; ?>
<?php if(isset($_GET["pag"])): ?>

	<nav class="menu-lateral">
		<a href="index.php?pag=main" <?php $verif -> selecNav("main"); ?> ><i class="far fa-hand-pointer"></i>Inicio</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Enlaces</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Juegos</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Investigación</a>
		<hr />
		<a href="index.php?pag=perfil" <?php $verif -> selecNav("perfil"); ?>><i class="far fa-hand-pointer"></i>Perfil</a>
		<a href="index.php?pag=subirTrabajo" <?php $verif -> selecNav("subirTrabajo"); ?>><i class="far fa-hand-pointer"></i>Subir Trabajo</a>
		<a href="index.php?pag=cerrar" <?php $verif -> selecNav("cerrar"); ?>><i class="far fa-hand-pointer"></i>Cerrar Sesión</a>
	</nav>

<?php else: ?>
	
	<nav class="menu-lateral">
		<a href="index.php?pag=main" class="active"><i class="far fa-hand-pointer"></i>Inicio</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Enlaces</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Juegos</a>
		<a href="#"><i class="far fa-hand-pointer"></i>Investigación</a>
		<hr />
		<a href="index.php?pag=perfil"><i class="far fa-heart"></i>Perfil</a>
		<a href="index.php?pag=subirTrabajo"><i class="far fa-heart"></i>Subir Trabajo</a>
		<a href="index.php?pag=cerrar"><i class="far fa-heart"></i>Cerrar Sesión</a>
	</nav>

<?php endif ?>