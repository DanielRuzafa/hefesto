<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div id="page_content">
	<section id="section1Home" class="generalContent">
		<div class="container group">
			<h1>Esta página no existe, por favor vuelva a la página principal.</h1>
			<br>
			<br>
			<br>
			<a class="button1" href="<?php bloginfo('url');?>">Inicio</a>
			<br>
			<br>
			<br>
		</div>

<?php get_footer(); ?>