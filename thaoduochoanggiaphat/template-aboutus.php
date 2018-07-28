<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: About us
 *
 *
 */
get_header(); ?>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post();
				
				do_action( 'storefront_page_before' );
				
				//get_template_part( 'content',us' );
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					//	/**
					//	 * Functions hooked in to storefront_page add_action
					//	 *
					//	 * @hooked storefront_page_header          - 10
					//	 * @hooked storefront_page_content         - 20
					//	 */
					//	do_action( 'storefront_page' );
					?>
					<header class="entry-header">
						<?php
						storefront_post_thumbnail( 'full' );
						the_title( '<h1 class="entry-title" style = "text-align: center">', '</h1>' );
						?>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
							'after'  => '</div>',
						) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
				
				<?php
			
				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );
			
			endwhile; // End of the loop. ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();