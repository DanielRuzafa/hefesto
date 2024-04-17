
<?php get_header(); ?>


<div id="page_content">
	<div class="generalContent blogPage">
		<div class="container group">
			<aside>
				<?php dynamic_sidebar('sidebar');?>
			</aside>
		    <div class="grid2Block comunBlock">
            <?php
	            	$aux = explode("/", $_SERVER[REQUEST_URI]);
					$category = $aux[count($aux)-2];
	                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	                $query_args = array(
	                    'post_type' => 'post',
	                    'posts_per_page' => 7,
	                    'order' => 'DESC',
	                    'category_name' => $category,
	                    'paged' => $paged
	                );

                $the_query = new WP_Query( $query_args ); ?>
                <?php $i=1; $second=false; $j=1; ?>
            	<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
            			<?php $url = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
			                <article class="column">
		                        <div class="image backgroundImage" style="background-image: url('<?php echo $url ?>')">
		                        	<a class="generalLink" href="<?php the_permalink(); ?>"></a>
		                        </div>
		                        
		                        <div class="product-link-content">
		                        	<a class="generalLink" href="<?php the_permalink(); ?>"></a>
		                            <h3><?php short_text(get_the_title(),38); ?></h3>
		                            				                          
		                            <p class="textContent"><?php short_text(get_the_content(), 140); ?></p>
		                        </div>		

	                        	<div class="socialShare">
									<?php include("inc/social_links.php");?>
								</div>	                      
	            				
			            	</article>

		                <?php if($i==3){
		                    $i=1;
		                    $second=true;
		                    echo '<div class="clear clearThree"></div>';
		                }else{
		                	if($i==2){

		                		echo '<div class="clear clearTwo"></div>';

		            		}
		                    $i++;
		                }?>	                
            

	            	<?php endwhile; ?>
		            <?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
		              <div id="pagination">
		                <?php wp_pagenavi( array( 'query' => $the_query ) ); ?>
		              </div>
		            <?php } ?>
        		<?php endif; ?>
			</div>
				  	
	    </div>
	</div>
</div>


<?php get_footer(); ?>
