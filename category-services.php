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
		<main id="main" class="site-main service-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					print '<h1 class="page-title">' . str_replace( 'Category: ', '', $title ) . '</h1>';
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			
			<p>Our communications and marketing team upholds the University of Rhode Island brand and all of its promises in being an affordable university with outstanding students, alumni, faculty and staff. We ensure our message is being shared around the world and that it is clear, concise and consistent.</p>
			
			<p>Learn more about <a href="http://ppkr.local/news/wordpress/what-we-do/">what we do</a>.</p>
			
			<h2>Self-Service Resources</h2>
			
			<p>Download URI Logos, Templates, Photos, and style guides.</p>
			
			<div class="self-service-wrapper cols thirds">

				<div class="self-service">
					<h3>Templates</h3>
					<ul>
						<li><a href="http://ppkr.local/news/wordpress/what-we-do/uri-brand-visual-standards/">Style Guide</a></li>
						<li><a href="https://drive.google.com/drive/folders/0B27sIR84YA5LM2hTZHdpeGpkNHc">Office Documents</a></li>
					</ul>
				</div>

				<div class="self-service">
					<h3>Photos</h3>
					<ul>
						<li><a href="http://uriphotography.photoshelter.com/archive">URI Photography</a></li>
						<li><a href="https://www.flickr.com/photos/123450604@N07/sets/72157670337959872">125th Anniversary Historic Photos</a></li>
					</ul>
				</div>

				<div class="self-service">
					<h3>Logos</h3>
					<ul>
						<li><a href="http://uriphotography.photoshelter.com/gallery/URI-Logos/G0000n1lWE0SKe9E/1/">URI Logos</a></li>
						<li><a href="https://drive.google.com/drive/folders/0B27sIR84YA5LTG9hUm1HRVlwWUU">125th Anniversary Logos</a></li>
					</ul>
				</div>

			</div>
			


			<h2>Custom Solutions</h2>

			<p>We're here to help beyond templates and guidelines.  We tailor customized solutions to meet your objectives.</p>

			<div class="categories-wrapper cols thirds">
			
			<?php
				$params = array(
					 'child_of' => $wp_query->get_queried_object_id()
					,'echo' => TRUE
					,'order' => 'ASC'
					,'orderby' => 'name'
					,'show_count' => TRUE
					,'title_li' => ''
				);
				//wp_list_categories($params);
				
				$categories = get_categories($params);
				$post_count = 3;
				foreach ( $categories as $c) {
					$args = array(
						'posts_per_page'   => 3,
						'category'         => $c->term_id,
						'post_type'        => 'post',
						'post_status'      => 'publish',
						'suppress_filters' => true 
					);
					$posts = get_posts( $args );

					?>
					<div class="category-block">
						<h3><a href="<?php print get_category_link( $c->term_id ); ?>"><?php print $c->name; ?></a></h3>
						<p class="description"><?php print category_description($c->term_id); ?></p>
						<?php
							if( is_array( $posts ) ) {
								print '<ul>';
								$count = 0;
								foreach ( $posts as $p ) {
									$li = '<li><a href="%s">%s</a></li>';
									print sprintf( $li, esc_url( get_permalink( $p->ID ) ), $p->post_title ); 
									$count++;
								}
								if ( $count >= $post_count ) {
									print '<li><a href="' . get_category_link( $c->term_id ) . '">All ' . $c->name . '</a> (' . $c->category_count . ')</li>';
								}
								print '</ul>';
							}
						?>
					</div>
					<?php
				}
				
							
			?>
			</div>

			<?php
			
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
