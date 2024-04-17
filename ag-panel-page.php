<?php
/*
Template Name: AG Panel
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if (($current_user->ID > 0)&&($nameRole=="administrator")) { ?>

		<div class="searchBlock">
			<h3>Introduzca IOC</h3>
			<input class="form-input" id="search" name="search" type="text" data-list=".list">
		</div>

		<div class="resultsBlock">
			<div class="container">

			<?php $operationsList = getOperationsList();

			if($operationsList){
				foreach($operationsList as $item){ ?>
					<?php $listOp = getIOCByOperationID($item->id);?>

					<div class="resultItem">
						<h3><?php echo $item->nombre;?></h3>
						<div class="clear"></div>
						<h4>Responsable: <?php echo getResponsable($item->id);?></h4>
						<h4>NIV: <?php echo $item->NIV;?></h4>
						<h4>Fecha creación: <?php echo $item->fecha;?></h4>

						<?php if(!empty($listOp)){ ?>
							<table class="">
								<thead>
									<tr>
										<td>Tipo</td>
										<td>Valor</td>
										<td>Descripción</td>
										<td>ISP</td>
										<td>Tareas</td>
										<td>Siena</td>
										<td>Fecha</td>
										<td>Fecha inicio</td>
										<td>Fecha fin</td>
										<td>Victima</td>
									</tr>
								</thead>
								<tbody class="list">
									<?php if(!empty($listOp)){
										foreach ($listOp as $item) {
											echo $item;
										}
									}
								?>						
								</tbody>
							</table>
					</div>
					<?php } else { ?>
						<p>La operación no tiene IOCs asignados todavia.</p>
					<?php } ?>
				<?php } ?>
			<?php } ?>
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
