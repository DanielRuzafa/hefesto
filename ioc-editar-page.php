<?php
/*
Template Name: G IOC Editar
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if ($current_user->ID > 0) { ?>
		<div class="iocPanel">


			<div id="insertIOCBlock" class="group">

				<?php $ioc = getIOCByID($_GET['aux']);?>
				<form id="formInsert" class="group" method="POST" action="<?php bloginfo("template_url");?>/includes/editIOC.php">
					<input type="hidden" name="idOpe" value="<?php echo $ioc[0]->idOperation;?>">
					<input type="hidden" name="idIOC" value="<?php echo $_GET['aux'];?>">

					

					<div class="listInsertBlock resultItem group">
						<h3>Editar datos IOC</h3>
						<div class="clear"></div>

						<div class="partLeft">
							<select  class="generalInput" name="entity" required>
								<option selected disabled>Seleccione el tipo de IOC</option>
								<?php if($ioc[0]->entity == "url"){ ?>
									<option value="url" selected>url</option>
									<option value="ip">ip</option>
								<?php } elseif($ioc[0]->entity == "ip"){ ?>
									<option value="url">url</option>
									<option value="ip" selected>ip</option>
								<?php } ?>

							</select>

							<input class="generalInput" type="text" name="value" placeholder="Valor del IOC" value="<?php echo $ioc[0]->value;?>" >		

							<input class="generalInput" type="text" name="provider" placeholder="Proveedor" value="<?php echo $ioc[0]->provider;?>">

							<input class="generalInput" type="text" name="siena" placeholder="Referencia" value="<?php echo $ioc[0]->siena;?>">

							<input class="generalInput dateInput" type="text" name="date" placeholder="Fecha IOC" value="<?php echo $ioc[0]->data_occurrence;?>">

							<input class="generalInput dateInput" type="text" name="dateIni" placeholder="Inicio rango fecha" value="<?php echo $ioc[0]->data_start;?>">			

							<input class="generalInput dateInput" type="text" name="dateFin" placeholder="Fin rango fecha" value="<?php echo $ioc[0]->data_end;?>">

							<input class="generalInput" type="text" name="victim" placeholder="Víctima" value="<?php echo $ioc[0]->victim;?>">

						</div>
						<div class="partRight">
							<textarea class="generalInput" name="description"><?php echo $ioc[0]->description;?></textarea>	
							<textarea class="generalInput" name="task"><?php echo $ioc[0]->task;?></textarea>						
						</div>
												
					</div>

					<div class="clear"></div>

					<input class="button1" type="submit" value="Continuar..." name="importSubmit"> 
				</form>

				<form id="formInsert" class="group" method="POST" action="<?php bloginfo("template_url");?>/includes/removeIOC.php">
					<input type="hidden" name="idOpe" value="<?php echo $ioc[0]->idOperation;?>">
					<input type="hidden" name="idIOC" value="<?php echo $_GET['aux'];?>">

					<input class="button2" type="submit" value="Eliminar IOC" name="importSubmit"> 
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