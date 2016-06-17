<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package uri2016
 */

get_header(); ?>

	<div id="primary" class="content-area error-404">

		<header class="page-header">
			<hgroup>
				<h1 class="page-title">Page Missing</h1>
				<h2>404 Not Found</h2>
			</hgroup>
		</header><!-- .page-header -->
		<main id="main" class="site-main" role="main">

			<section class="not-found">

				<div class="page-content entry-content">
					<!--div class="hanging-right">
						<figure>
							<img src="http://web2.uri.edu/wp-content/themes/uri2016/img/no-rhody.jpg" alt="something is missing"/>
							<!--iframe width="620" height="465" src="https://www.youtube.com/embed/Us6jo8bl2lk?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe-->
						</figure>
					</div-->
					<p>It looks like nothing was found at this location.  Maybe try one of the links below or a search?</p>

					<div class="search-wrapper">
					<?php
						get_search_form();
					?>
					</div>
					
					<h2 class="clearfix">Recent Articles</h2>
					<?php


						// the query
						$the_query = new WP_Query( array( 'category_name' => 'news', 'posts_per_page' => 5 ) ); 

						// The Loop
						if ( $the_query->have_posts() ) {
							$string .= '<ul class="recent-news-404">';
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
									if ( has_post_thumbnail() ) {
										$string .= '<li class="clearfix">';
										$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 150, NULL) ) . get_the_title() .'</a></li>';
									} else { 
										// if no featured image is found
										$string .= '<li class="clearfix"><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
									}
								}
							} else {
							// no posts found
						}
						$string .= '</ul>';

						echo $string;


// 						the_widget( 'WP_Widget_Recent_Posts' );

						// Only show the widget if site has multiple categories.
						// Only show if 1 equals 2 (never) -jp
						if ( 1==2 && uri2016_categorized_blog() ) :
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'uri2016' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->

					<?php
						endif;

						/* translators: %1$s: smiley */
// 						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'uri2016' ), convert_smilies( ':)' ) ) . '</p>';
// 						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
// 
// 						the_widget( 'WP_Widget_Tag_Cloud' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
