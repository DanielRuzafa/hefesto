<?php
/*
Template Name: G OP Ins
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if (($current_user->ID > 0)&&($nameRole=="administrator")) { ?>
		<div class="iocPanel">


			<div id="insertIOCBlock" class="group">

				<form id="formInsert" class="group" method="POST" action="<?php bloginfo("template_url");?>/includes/insertOP.php">
					<input type="hidden" name="idOpe" value="">
					<input type="hidden" name="idUsu" value="">

					<div class="listInsertBlock resultItem group editBlock">
						<h3>Nueva operación</h3>
						<div class="clear"></div>

						
						<div class="partLeft">

							<input class="generalInput" type="text" name="name" placeholder="Nombre de la operación"required>		


							<input class="generalInput dateInput" type="text" name="date" placeholder="Fecha de creación">

							<input class="generalInput" type="text" name="niv" placeholder="NIV Operación">

							<select id="membersOpe" class="generalSelect" name="membersOpe">		
								<?php $members=getMembersByAdmin($current_user->ID);
									foreach($members as $mem){
										echo $mem;
									}
								?>								
							</select>

							<select  class="generalSelect" name="estado">		
								<option selected disabled>Seleccione estado...</option>			
								<option value="1">Activa</option>					
								<option value="0">Pasiva</option>					
							</select>

						</div>
						<div class="partRight">
							<textarea class="generalInput" name="description">Descripción de la operación</textarea>							
						</div>
												
					</div>

					<div class="clear"></div>

					<input class="button1" type="submit" value="Continuar..." name="importSubmit"> 
				</form>
			</div>

		</div>


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
