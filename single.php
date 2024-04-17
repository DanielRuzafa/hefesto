<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div id="page_content">
	<div class="generalContent blogPage">
		<div class="container group">
			<aside>
				<?php dynamic_sidebar('sidebar');?>
			</aside>
		    <div class="grid2Block comunBlock">	
	        	<?php while ( have_posts() ) : the_post(); // run the loop ?>	    				
	                    <?php $url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

	                	<div class="imageBlog">
	                		<img class="responsiveImage" src="<?php echo $url ?>" alt="<?php the_title();?>">
	                	</div>
	                    <div class="product-link-content">
		            		<p class="categoryName">
			            		<?php
			            		$categories = get_the_category($post->ID);
			            		$total = count($categories);
			            		$i = 1;

			            		foreach ($categories as $cat) {
			            			if($i==$total){
			            				echo $cat->name;
			            			}else{
			            				echo $cat->name . ", ";
			            			}
			            		}	
			            		?>
		            		</p>
	                        				                          
	                        <p class="textContent responsiveText"><?php the_content(); ?></p>
	                    </div>			                      
					            		

	            	<?php endwhile; ?>		    		
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
