<?php
/*
Template Name: G PERFIL
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if ($current_user->ID > 0) { ?>

		<?php $usuInfo = getUserInfoComplete($current_user->ID); ?>

		<form id="formRegistro" method="POST" action="<?php bloginfo("template_url");?>/includes/editarUser.php">
			<input type="hidden" name="idUsu" value="<?php echo $current_user->ID;?>">
			<input type="hidden" name="year" value="<?php echo date("Y"); ?>">
			<input type="hidden" name="month" value="<?php echo date("m"); ?>">
			<input type="hidden" name="day" value="<?php echo date("d"); ?>">
			
			<div class="listInsertBlock resultItem group">
				<h3>Perfil del usuario</h3>
				<div class="clear"></div>

				<div class="form-item">
					<label for="nombre">Nombre completo*</label>
					<input class="form-input" id="nombre" type="text" name="nombre" value="<?php echo $usuInfo[0];?>" required>
				</div>

				<div class="form-item">
					<label for="cif">Carnet Profesional*</label>
					<input class="form-input" id="cp" type="text" name="cp" value="<?php echo $usuInfo[2];?>" required>
				</div>

				<div class="form-item">
					<label for="telTrabajo">Teléfono (Trabajo)*</label>
					<input class="form-input" id="telTrabajo" type="text" name="tFijo" value="<?php echo $usuInfo[3];?>" required>
				</div>


				<div class="form-item">
					<label for="email">Email*</label>
					<input class="form-input" id="email" type="email" name="email" value="<?php echo $usuInfo[1];?>" disabled>
				</div>

				<div class="form-item">
					<label for="pass">Contraseña*</label>
					<input class="form-input" id="pass" type="password" name="pass" required>
				</div>

				<div class="clear"></div>

			</div>

			<input class="button1" type="submit" value="Continuar..."> 
		</form>




		
	<?php } else{ ?>
		<div class="iocPanel buttonBlock">
			<p>Lo siento, debe estar identificado para acceder a esta página.</p>
			<br>
			<br>
			<a class="button1" href="<?php bloginfo('url');?>/">Inicio</a>
		</div>
	<?php } ?>
	</div>
</div>


<?php get_footer(); ?>
