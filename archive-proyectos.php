<?php
/**
 * Template Name: Proyectos
 * Template Post Type: post, page
 * 
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header(); get_template_part( 'template-parts/entry-header' );?>



<main id="site-content" role="main">
<div class="post-inner thin">

<div class="section-inner">
<div class="uk-grid-match" uk-grid="" uk-height-match="target: .uk-card">
	<?php

$args = array(
	'post_type' => 'proyectos', // enter your custom post type
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'posts_per_page'=> '5', // overrides posts per page in theme settings
	'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	);
	$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) :

		while ( $loop->have_posts() ) :
			$loop->the_post(); global $post; ?>

<div class="uk-width-1-3@m">
<article class="jd-project-teaser uk-text-center">
<?php if ( has_post_thumbnail() && ! post_password_required() ) :

$featured_media_inner_classes = '';

// Make the featured media thinner on archive pages.
if ( ! is_singular() ) {
	$featured_media_inner_classes .= ' medium';
}
?>

<div class="uk-inline uk-dark">
			<?php the_post_thumbnail(); ?>
            <div class="uk-overlay-default uk-position-cover">
                <div class="uk-position-center">
                    <span uk-overlay-icon></span>
                </div>
            </div>
        </div>

		



<?php
endif;
?>


<div class="uk-card uk-card-default uk-card-body">
<div class="uk-card-badge uk-label">Badge</div>
            <h3 class="uk-card-title"><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
		</div>
		

		</article>


		</div>	
		<?php endwhile; wp_reset_postdata();  wp_reset_query();?>
		
		
		</div>





		<ul class="uk-pagination uk-flex-center uk-margin-top">
    <?php foreach( wpdocs_get_paginated_links( $loop ) as $link ) : ?>
    <li>
        <?php if ( $link->isCurrent ): ?>
            <strong><?php _e( $link->page ) ?></strong>
        <?php else : ?>
            <a href="<?php esc_attr_e( $link->url ) ?>">
                <?php _e( $link->page ) ?>
            </a>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>






		<?php 
		
		/*previous_posts_link('Previous page', $loop->max_num_pages);
		next_posts_link('Next page', $loop->max_num_pages);*/
		
		/*echo paginate_links(array(
			'total' => $loop->max_num_pages
		));*/

		?>

<?php
else :
	echo '<p>No content found</p>';

endif; ?>


		</div>
		</div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>