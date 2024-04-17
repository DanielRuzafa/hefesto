<?php
/*
Template Name: G IOC
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if ($current_user->ID > 0) { ?>
		<div class="iocPanel buttonBlock">

			<a href="<?php bloginfo('url');?>/ioc/insertar/" class="button1">Añadir IOC</a>

		</div>

			<?php if(isset($_GET['result'])){ ?><p class="hiddenMessage <?php if($_GET['result']==1){ echo "correct";} else if($_GET['result']==2){ echo "incorrect";} ?>"><?php echo $_SESSION['error'];?></p><?php } ?>

		<select id="listOperations" class="generalSelect">
			<?php $operations=getOperations();
				foreach($operations as $ope){
					echo $ope;
				}
			?>
				
		</select>
		
		<div class="usersTable generalTable resultItem hiddenTag">
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
						<td></td>
					</tr>
				</thead>
				<tbody>
					
				</tbody>

			</table>
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
