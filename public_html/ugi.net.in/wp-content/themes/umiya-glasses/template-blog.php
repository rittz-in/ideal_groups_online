<?php 
/* Template Name: Blog Template */
get_header(); 
?>
    <div class="blog-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    BLOG
                </h1>
            </div>
        </div>
    </div>


    <section class="blogpage about-us logo-after">
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    
                    <?php
                    	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args = array(
						    'posts_per_page' => 4,
						    'post_type'     => 'post',
						    'post_status'   => 'publish',
						    'orderby'       => 'date',
						    'order'         => 'DESC',
						    'paged' 		=> $paged
						);
						$loop = new WP_Query($args);
            			if($loop->have_posts()) :
            				while($loop->have_posts()) : $loop->the_post();
            				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
            				$featuredImage = $image[0];
                    ?>
		                <div class="card mb-4 post-<?php the_ID(); ?>">
		                    <a href="<?php the_permalink(); ?>">
		                    	<img class="card-img-top" src="<?php echo $featuredImage; ?>">
		                    </a>
		                    <div class="card-body">
		                        <div class="small text-muted">
		                        	<?php 
		                        		echo get_the_date();
		                        	?>
		                        </div>
		                        <h2 class="card-title"><?php the_title(); ?></h2>
		                        <p class="card-text">
		                        	<?php the_excerpt(); ?>
		                        </p>
		                        <a class="btn btn-primary card-btn" href="<?php the_permalink(); ?>">Read more →</a>
		                    </div>
		                </div>
         			<?php
         					endwhile;
         				endif;
         				wp_reset_postdata();
         			?>
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                    	<div class="pagination">
							<?php
							$big = 999999999; // need an unlikely integer

							echo paginate_links( array(
							    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							    'format' => '?paged=%#%',
							    'current' => max( 1, get_query_var('paged') ),
							    'total' =>  $loop->max_num_pages
							) );
							?>
						</div>
                        <!-- <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"
                                    aria-disabled="true">PREVIOUS</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">NEXT</a></li>
                        </ul> -->
                    </nav>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header card-head">Search</div>
                        <!-- <div class="card-body card-bg">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..."
                                    aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary card-btn" id="button-search" type="button">Go!</button>
                            </div>
                        </div> -->
                        <?php get_search_form(); ?>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header card-head">Categories</div>
                        <div class="card-body card-bg">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                    	<?php
                                    		$args = array(
											    'hide_empty'      => false,
											    'orderby' => 'name',
    											'parent'  => 0
											);
											$categories = get_categories($args);
											foreach( $categories as $category ){
												$catId   = $category->term_id;
												$catName = $category->name;
												$catLink = get_permalink($catId);
											
                                    	?>
                                        	<li>
                                        		<a href="<?php echo $catLink; ?>"><?php echo $catName; ?></a>
                                        	</li>
                                        <?php } ?>
                                    </ul>
                                </div>
                               <!--  <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <!-- <div class="card mb-4">
                        <div class="card-header card-head">Side Widget</div>
                        <div class="card-body card-bg">You can put anything you want inside of these side widgets. They
                            are easy
                            to use,
                            and feature the Bootstrap 5 card component!</div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>