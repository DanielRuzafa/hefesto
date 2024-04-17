<?php
/*
Template Name: Operaciones
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if ($current_user->ID > 0) { ?>
		<div class="generalContent">
	        <div id="dialog-confirm" title="¿Borrar la operación?" class="hiddenTag">
			  	<p>Serán borrados todos los IOC de la misma.</p>
			</div> 

	        
		<div class="iocPanel buttonBlock">
			<?php $rolUser = $current_user->roles[0];?>

			<?php if($rolUser=="administrator"){ ?>
			<a href="<?php bloginfo('url');?>/operaciones/insertar/" class="button1">Añadir Operación</a>
			<?php } ?>

		</div>
			<?php if(isset($_GET['result'])){ ?><p class="hiddenMessage <?php if($_GET['result']==1){ echo "correct";} else if($_GET['result']==2){ echo "incorrect";} ?>"><?php echo $_SESSION['error'];?></p><?php } ?>


	       <?php $opeActivas = checkOperationsByState(1);

	       if($opeActivas){ ?>
			<div class="usersTable generalTable resultItem">
				 <h3>Operaciones activas</h3>
				<table>
					<thead>
						<tr>
							<td>Nombre</td>
							<td>NIV</td>
							<td>Fecha creación</td>
							<td>Responsable</td>
							<?php if($rolUser=="administrator"){ ?>
								<td></td>
								<td></td>
							<?php } ?>
						</tr>
					</thead>
				<?php $listOperations = getOperationsByState(1, $rolUser);
					if(!empty($listOperations)){
						foreach ($listOperations as $item) {
							echo $item;
						}
					}
				?>

				</table>
			</div>

		<?php } else { ?>
			<p>No hay investigaciones activas.</p>
		<?php } ?>

		</div>

		<div class="generalContent">
	        
	      

	       <?php $opePasivas = checkOperationsByState(0);

	       if($opePasivas){ ?>	 
			<div class="usersTable generalTable resultItem">
				 <h3>Operaciones pasivas</h3>

				<table>
					<thead>
						<tr>
							<td>Nombre</td>
							<td>NIV</td>
							<td>Fecha creación</td>
							<td>Responsable</td>
							<?php if($rolUser=="administrator"){ ?>
								<td></td>
								<td></td>
							<?php } ?>
						</tr>
					</thead>
				<?php $listOperations = getOperationsByState(0, $rolUser);
					if(!empty($listOperations)){
						foreach ($listOperations as $item) {
							echo $item;
						}
					}
				?>

				</table>
			</div>
			<?php } else { ?>
				<h3>Operaciones pasivas</h3>
				<p>No hay investigaciones pasivas.</p>
			<?php } ?>

		</div>

		
		<p class="message messageReal"></p>
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
