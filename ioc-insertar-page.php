<?php
/*
Template Name: G IOC Ins
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if ($current_user->ID > 0) { ?>
		<div class="iocPanel buttonBlock">
			<select id="listOpe" class="generalSelect">
				<?php $operations=getOperations();
					foreach($operations as $ope){
						echo $ope;
					}
				?>
					
			</select>

			<select id="membersOpe" class="generalSelect">		
			</select>

			<select id="typeInsert" class="generalSelect">
				<option selected disabled>Seleccione como quiere insertar...</option>
				<option value="formInsert">Desde fichero</option>
				<option value="listInsert">Desde el sistema</option>
			</select>
		</div>

		<div id="insertIOCBlock" class="group">

			<form id="formInsert" class="hiddenTag group" method="POST" action="<?php bloginfo("template_url");?>/includes/insertIOC.php" enctype="multipart/form-data">
				<input type="hidden" name="idOpe" value="">
				<input type="hidden" name="idUsu" value="">
				<input type="hidden" name="tipeForm" value="">

				<div class="formInsertBlock hiddenTag resultItem group">
					<h3>Inserte IOC en la investigación seleccionada cargando un archivo tipo excel:</h3>
					<div class="clear"></div>


					<input type="file" name="fileToUpload" id="fileToUpload">
				</div>

				<div class="listInsertBlock hiddenTag resultItem group">
					<h3>Inserte IOC en la investigación de forma manual</h3>
					<div class="clear"></div>

					<div class="partLeft">
						<select  class="generalInput" name="entity" required>
							<option selected disabled>Seleccione el tipo de IOC</option>
							<option value="url">URL</option>
							<option value="ip">IP</option>
						</select>

						<input class="generalInput" type="text" name="value" placeholder="Valor del IOC">		

						<input class="generalInput" type="text" name="provider" placeholder="Proveedor">

						<input class="generalInput" type="text" name="siena" placeholder="Referencia">

						<input class="generalInput dateInput" type="text" name="date" placeholder="Fecha IOC">

						<input class="generalInput dateInput" type="text" name="dateIni" placeholder="Inicio rango fecha">			

						<input class="generalInput dateInput" type="text" name="dateFin" placeholder="Fin rango fecha">

						<input class="generalInput" type="text" name="victim" placeholder="Víctima">

					</div>
					<div class="partRight">
						<textarea class="generalInput" name="description">Descripción del IOC</textarea>	
						<textarea class="generalInput" name="task">Tareas a realizar o realizadas</textarea>						
					</div>
											
				</div>

				<div class="clear"></div>

				<input class="button1" type="submit" value="Continuar..." name="importSubmit"> 
			</form>
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
