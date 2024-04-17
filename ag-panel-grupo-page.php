<?php
/*
Template Name: AGP grupo
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
	<?php require_once("includes/panel-menu.php"); ?>

	<div class="clear"></div>

	<?php if (($current_user->ID > 0)&&($nameRole=="administrator")) { ?>
		<div class="generalContent">
	        
	        <div id="dialog-confirm" title="¿Borrar el miembro de su grupo?" class="hiddenTag">
			  	<p>No podrá ser recuperado.</p>
			</div> 

			<div>
				<p>Para añadir miembros a su grupo, debe pasarles el siguiente enlace de registro:</p>
				<p><?php bloginfo("url");?>/registro/?idRegistro=<?php echo $current_user->ID;?></p>
			</div>	

			<div class="usersTable generalTable resultItem">
				<table>
					<thead>
						<tr>
							<td>Nombre</td>
							<td>Email</td>
							<td>CP</td>
							<td>Teléfono</td>
							<td class="codigoCell">Activo</td>
							<td></td>
							
						</tr>
					</thead>
				<?php $listUsers = getUsers($current_user->ID);
					if(!empty($listUsers)){
						foreach ($listUsers as $item) {
							echo $item;
						}
					}
				?>

				</table>
			</div>
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
