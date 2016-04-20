<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package uri2016
 */

get_header(); ?>
	
	<div id="primary" class="content-area front">
		<main id="main" class="site-main" role="main">

		<?php if ( is_active_sidebar( 'front' ) ) : ?>
			<div id="region-front" class="region-front widget-area">
				<?php dynamic_sidebar( 'front' ); ?>
			</div><!-- #region-front -->
		<?php endif; ?>

			<div class="news">
				<?php
					// get top four posts that have thumbnails
					$args = array(
						'posts_per_page'   => 4,
						'category_name'    => 'press-releases',
						'post_status'      => 'publish',
						'suppress_filters' => true ,
						'meta_query' => array(
							array(
							 'key' => '_thumbnail_id',
							 'compare' => 'EXISTS'
							),
						)
					);
					$posts_array = get_posts( $args );
					$count = 0;
					foreach($posts_array as $post) {
						setup_postdata( $post );
						if($count == 0) {
							?>
								<div class="primary">
									<figure>
										<?php echo get_the_post_thumbnail( $post->ID, array(620, '') ); ?>
									</figure>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<div class="read-more"><a href="<?php the_permalink(); ?>">Read More »</a></div>
								</div>
							<?php 
						} else {
							?>
								<div class="secondary">
									<figure>
										<?php echo get_the_post_thumbnail( $post->ID, array(300, '') ); ?>
									</figure>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php 
						}
						$count++;
					}
					wp_reset_postdata();


					// display them
				?>
				<div class="more"><a href="">More News »</a></div>
			</div>

			<div class="social">
				<h2>#URI</h2>
					<?php
						// Social Media goes here
						$args = array(
							'posts_per_page'   => 2,
							'category_name'    => 'social',
							'post_status'      => 'publish',
							'suppress_filters' => true ,
						);
						$posts_array = get_posts( $args );
						foreach($posts_array as $post) {
							setup_postdata( $post );
								?>
									<article>
										<div class="content"><?php the_content(); ?></div>
									</article>
								<?php 
							}
							wp_reset_postdata();


						// display them
					?>

				<div class="more-social more">
					<ul>
						<li class="twitter"><a href="#">Twitter</a></li>
						<li class="instagram"><a href="#">Instagram</a></li>
						<li class="facebook"><a href="#">Facebook</a></li>
						<li class="youtube"><a href="#">Youtube</a></li>
					</ul>				
				</div>
			</div>

			<div class="events">
				<h2>Events</h2>
				<!--script src="http://events.uri.edu/widget/view?schools=uri&days=30&num=10&picks=1"></script-->
				<script src="http://events.uri.edu/widget/view?schools=uri&days=30&num=10&picks=1&expand_descriptions=1"></script>

				<div class="more"><a href="http://events.uri.edu">More Events »</a></div>
			</div>

			<h2>Faculty Experts</h2>
			<?php
				// Experts
					$args = array(
						'posts_per_page'   => 4,
						'category_name'    => 'experts',
						'post_status'      => 'publish',
						'suppress_filters' => true,
						'meta_query' => array(
							array(
							 'key' => '_thumbnail_id',
							 'compare' => 'EXISTS'
							),
						)
					);
					$experts_array = get_posts( $args );
					foreach($experts_array as $post) {
						setup_postdata( $post );
						?>
							<div class="expert">
								<figure>
									<?php echo get_the_post_thumbnail( $post->ID, array(220, '') ); ?>
								</figure>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php the_excerpt(); ?>
							</div>
							<?php 
					}
					wp_reset_postdata();
			?>
			<div class="more"><a href="#">More Experts »</a></div>

			<h2>URI in the News</h2>
			<?php
				echo do_shortcode ( '[hungryfeed url="http://urinewsonline.blogspot.com/feeds/posts/default?alt=rss" item_fields="description" feed_fields="" link_item_title="0" max_items="1" template="1"]' )
				// URI in the News
			?>
			<div class="more"><a href="http://events.uri.edu">More URI in the News »</a></div>

			<h2>#RAMFAM</h2>
			<?php
				// RAMFAM
					$args = array(
						'posts_per_page'   => 4,
						'category_name'    => 'ramfam',
						'post_status'      => 'publish',
						'suppress_filters' => true,
						'meta_query' => array(
							array(
							 'key' => '_thumbnail_id',
							 'compare' => 'EXISTS'
							),
						)
					);
					$experts_array = get_posts( $args );
					foreach($experts_array as $post) {
						setup_postdata( $post );
						?>
							<div class="ramfam">
								<figure>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_the_post_thumbnail( $post->ID, array(220, '') ); ?></a>
								</figure>
							</div>
							<?php 
					}
					wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
