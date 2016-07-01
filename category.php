<?php
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

$title = get_the_archive_title();
get_header();

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					print '<h1 class="page-title">' . str_replace( 'Category: ', '', $title ) . '</h1>';
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php if ( $title == 'Category: Experts' ): ?>
				<div class="letters">
					<span>Find by last initial:</span><br />
					<?php
						$letters = $wpdb->get_results( "SELECT DISTINCT LEFT(meta_value, 1) as fl, COUNT(meta_id) AS count FROM wp_postmeta WHERE meta_key = 'sort_name' GROUP BY fl ORDER BY fl ASC" );
						if ( $letters ) {
							foreach ( $letters as $l ) {
								$l = esc_attr( $l->fl );
								echo '<a href="?n=' . strtolower($l) . '">' . strtoupper($l) . '</a>';
							}
						}
					?>
				</div>
			<?php endif; ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			//the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		
		<?php
				echo uri2016_paging_nav();		
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
