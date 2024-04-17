<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div id="page_content" class="group generalContent">
	<div class="container group">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			the_content();
		endwhile;
		?>
	</div>
</div>


<?php get_footer(); ?>
