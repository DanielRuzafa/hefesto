<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>


<div id="page_content" class="group generalContent">
	<div class="container group">
		<div class="loginBlock">
			<p class="strong">Bienvenido a Hefesto</p>
			<p>Inteligencia para investigación de ataques de ransomware</p>
			
			<?php if ($current_user->ID == 0) { ?>

			<form id="formLogin" method="POST" action="<?php bloginfo("template_url");?>/includes/log-in.php">
				<input class="form-input" type="email" placeholder="Email" name="email">
				<input class="form-input" type="password" name="pass" placeholder="Contraseña">
				<input class="button1" type="submit" value="Acceder"> 
			</form>

			<a class="linkLogin" href="<?php bloginfo('url');?>/wp-login.php?action=lostpassword"><i class="fa-solid fa-arrow-right"></i> ¿Olvidaste tu contraseña?</a>
			<a class="linkLogin" href="mailto:<?php echo get_setting('Email'); ?>"><i class="fa-solid fa-arrow-right"></i> ¿Algún problema? <?php echo get_setting('Email'); ?></a>	

			<?php } else{ ?>
				<br>
				<br>
				<p>Usted está logueado en el sistema como:</p>
				<?php $user = get_user_by( 'ID', $current_user->ID ); ?>
				<p><?php echo $user->first_name . ' ' . $user->last_name;?></p>

                <?php if ($current_user->ID > 0) { ?>

                    <?php if($current_user->roles[0]== "subscriber"){ ?>
                        <a class="button1" href="<?php bloginfo('url');?>/grupo/">Área privada</a>

                    <?php } else { ?>
                        <a class="button1" href="<?php bloginfo('url');?>/administrador-grupo/">Área privada</a>
                    <?php } ?>


                <?php } ?>

			<?php } ?>		
			
		
		</div>

		<div class="clear"></div>

			<?php if(isset($_GET['result'])){ ?><p class="hiddenMessage <?php if($_GET['result']==1){ echo "correct";} else if($_GET['result']==2){ echo "incorrect";} ?>"><?php echo $_SESSION['error'];?></p><?php } ?>
	</div>
</div>


<?php get_footer(); ?>
