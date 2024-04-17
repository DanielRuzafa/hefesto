<?php
/*
Template Name: Registro
*/
?>

<?php get_header(); ?>


<div id="page_content" class="generalContent">
	<div class="container group">
		<form id="formRegistro" method="POST" action="<?php bloginfo("template_url");?>/includes/register.php">
			<input type="hidden" name="year" value="<?php echo date("Y"); ?>">
			<input type="hidden" name="month" value="<?php echo date("m"); ?>">
			<input type="hidden" name="day" value="<?php echo date("d"); ?>">
			<input type="hidden" name="idAdmin" value="<?php echo $_GET['idRegistro'];?>">


			<div class="listInsertBlock resultItem group">
				<h3>Perfil del usuario</h3>
				<div class="clear"></div>

				<div class="form-item">
					<label for="nombre">Nombre completo*</label>
					<input class="form-input" id="nombre" type="text" name="nombre" required>
				</div>

				<div class="form-item">
					<label for="cif">Carnet Profesional*</label>
					<input class="form-input" id="cp" type="text" name="cp" required>
				</div>

				<div class="form-item">
					<label for="telTrabajo">Teléfono (Trabajo)*</label>
					<input class="form-input" id="telTrabajo" type="text" name="tFijo" required>
				</div>


				<div class="form-item">
					<label for="email">Email*</label>
					<input class="form-input" id="email" type="email" name="email" required>
				</div>

				<div class="form-item">
					<label for="pass">Contraseña*</label>
					<input class="form-input" id="pass" type="password" name="pass" required>
				</div>

				<div class="clear"></div>

			</div>



			<p>Una vez inscrito, el administrador de su equipo de insvestigación debe activar su cuenta. Este proceso puede llevar un tiempo ya que no es un proceso automático por seguridad.</p>

			<input class="button1" type="submit" value="Continuar..."> 
		</form>


	</div>
</div>


<?php get_footer(); ?>
