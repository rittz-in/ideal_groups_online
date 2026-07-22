<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="about-banner conatct-banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="main-heading">
                    <?php
                    	echo get_the_title();
                    ?>
                </h1>
            </div>
        </div>
    </div>

    <section class="blog-details">
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-12">
                    <!-- Featured blog post-->
                    <?php
                    	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
            			$featuredImage = $image[0];
                    ?>
                    <img class="card-img-top mt-4" src="<?php echo $featuredImage; ?>" alt="blog-img" />
              
                    <div class="blog-body">
                        <div class="small text-muted" style="padding: 5px;"><?php echo get_the_date(); ?></div>
                        <div class="blog-text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</article><!-- .post -->
