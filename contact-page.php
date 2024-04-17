<?php
/*
Template Name: Contacto


<p class="firstLine marginRight">[text* nombre placeholder "Nombre"] </p>

<p class="firstLine">[text* telephone placeholder "Teléfono"] </p>

<p class="firstLine marginRight">[email* email placeholder "Email"] </p>

<p class="firstLine">[text* subject placeholder "Asunto"] </p>

<p class="thirdLine comunBlock">[textarea message x8 placeholder "Mensaje"]</p>


<p class="buttonSubmit">[submit "Enviar"]</p>
<p class="thirdLine ">[recaptcha id:RecaptchaField2]</p>




*/
?>

<?php get_header(); ?>


<div id="page_content">
	<div class="generalContent contactPage">
		<div class="container group">
			<div class="partRight">
	            <p class="header-phone"><?php get_setting('TelNumber'); ?>23123123123</p>
	            
	            <p class="header-email"><a href="mailto:<?php get_setting('Email'); ?>"><?php get_setting('Email'); ?>asdasdsdasda</a></p>
	            
	            <p class="header-times"><?php get_setting('OpeningTimes'); ?></p>			
			</div>
			<div class="partLeft">

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					the_content();
				endwhile;
				?>

			</div>
		</div>
	</div>
</div>


<?php get_footer(); ?>