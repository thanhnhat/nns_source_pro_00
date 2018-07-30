<?php
/**
 * Template used to display post content on single pages.
 *
 * @package storefront
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
	
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			storefront_posted_on();
			the_title( '<h1 class="entry-title" style="text-align: center">', '</h1>' );
		} else {
			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			if ( 'post' == get_post_type() ) {
				storefront_posted_on();
			}
		}
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<div class="post-detail-thumbnail">
			<?php
			do_action( 'storefront_post_content_before' );
			?>
		</div>
		
		<div class="post-detail-content">
			<?php
			the_content(
				sprintf(
					__( 'Continue reading %s', 'storefront' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);
			
			do_action( 'storefront_post_content_after' );
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
