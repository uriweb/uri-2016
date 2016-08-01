<?php
/**
 * uri2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri2016
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function uri2016_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on uri2016, use a find and replace
	 * to change 'uri2016' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'uri2016', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 300, FALSE );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'uri2016' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
//		'aside',
//		'image',
		'video',
//		'quote',
//		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'uri2016_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'uri2016_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uri2016_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uri2016_content_width', 640 );
}
add_action( 'after_setup_theme', 'uri2016_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uri2016_widgets_init() {
	register_sidebar( array(
		'name'          => 'Prefix',
		'id'            => 'prefix',
		'description'   => esc_html__( 'Add widgets for the prefix area here.', 'uri2016' ),
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="region-prefix">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Front Page',
		'id'            => 'front',
		'description'   => esc_html__( 'Add widgets for front page here.', 'uri2016' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="region-front">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uri2016' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'uri2016' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="region-sidebar">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uri2016_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function uri2016_scripts() {
	$theme = get_template_directory_uri();

	$cache_buster = '20160710';
	$cache_buster = NULL;

	wp_register_script( 'wp_environment', null);
	wp_enqueue_script( 'wp_environment', false, array(), false, true );
	$data = array(
		'theme_url' => $theme,
		'base_url' => get_site_url()
	);
	//after wp_enqueue_script
	wp_localize_script( 'wp_environment', 'wordpress_environment', $data );


	wp_enqueue_style( 'uri2016-style', get_stylesheet_uri() );
	wp_enqueue_script( 'uri2016-menu', $theme . '/js/uri-menu.js', array(), $cache_buster, true );
	wp_enqueue_script( 'uri2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $cache_buster, true );
	
	if( is_front_page() ) {
		//wp_enqueue_style( 'uri2016-style-front', $theme . '/css/front.css' );
		wp_register_script( 'uri2016-social',  $theme . '/js/uri-social.js', array(), $cache_buster, true );
		wp_enqueue_script( 'uri2016-social' );
	}

	wp_enqueue_script( 'uri2016-skip-link-focus-fix', $theme . '/js/skip-link-focus-fix.js', array(), $cache_buster, true );
	wp_enqueue_script( 'uri-next', $theme . '/js/uri-next.js', array(), $cache_buster, true );
	wp_enqueue_script( 'uri-search', $theme . '/js/uri-search.js', array(), $cache_buster, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'typekit', 'https://use.typekit.net/sbo8fzm.js');
	wp_enqueue_script( 'typekit' );

}
add_action( 'wp_enqueue_scripts', 'uri2016_scripts' );



/**
 * Add inline javascript to enable URI's Typekit package
 */
function uri2016_typekit_inline() {
  if ( wp_script_is( 'typekit', 'done' ) ) { ?>
    <script type="text/javascript">try{Typekit.load({ async: true });}catch(e){}</script>
<?php }
}
add_action( 'wp_head', 'uri2016_typekit_inline' );



/**
 * Replace footer credits for JetPack Infinite Scroll
 */
function uri2016_infinite_scroll_credit() {
    $content = '';
    return $content;
}
add_filter('infinite_scroll_credit','uri2016_infinite_scroll_credit');



/**
 * Runs a custom query for the experts page
 * @todo: move this out of the theme and into an experts plugin
 */
function uri2016_experts_page($query) {
	if ( is_category( 'experts' ) && $query->is_main_query() ) {
		$query->set( 'meta_key', 'sort_name');
		$query->set( 'orderby', 'meta_value');
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', 100 );
		return $query;
	}
}
add_action( 'pre_get_posts', 'uri2016_experts_page');


/**
 * Limit the number of posts per page on archives to the same as the posts per page setting
 */
function uri2016_limit_posts_per_archive_page() {
	$posts_per_page = get_option('posts_per_page');
	if ( is_category() )
		set_query_var('posts_per_archive_page', $posts_per_page);
}

add_filter('pre_get_posts', 'uri2016_limit_posts_per_archive_page');



/**
 * Adds an image class of "no-hang' to images that are right aligned, 
 * but aren't sufficiently wide to "look good"
 */
function uri2016_add_image_class($class, $id, $align, $size) {
	if($size[0] < 250) {
		$class .= ' no-hang ' . print_r($id, TRUE);
	}
	return $class;
}
add_filter('get_image_tag_class','uri2016_add_image_class');




/**
 * Replace the default caption shortcode handler.
 *
 * This is a trick to add a "no-hang" class to right-aligned images that
 * are narrower than 320px
 *
 * @return void
 */
function uri2016_replace_wp_caption_shortcode() {
	remove_shortcode( 'caption', 'img_caption_shortcode' );
	remove_shortcode( 'wp_caption', 'img_caption_shortcode' );
	add_shortcode( 'caption', 'uri2016_caption_shortcode' );
	add_shortcode( 'wp_caption', 'uri2016_caption_shortcode' );
}
add_action( 'after_setup_theme', 'uri2016_replace_wp_caption_shortcode' );


/**
 * Add the new class to the caption.
 *
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Caption text
 * @return string
 */
function uri2016_caption_shortcode( $attr, $content = NULL ) {
	$class = ( $attr['width'] < 320 ) ? 'no-hang' : 'hang';
	$caption = img_caption_shortcode( $attr, $content );
	$caption = str_replace( 'class="wp-caption', 'class="wp-caption ' . $class, $caption );
	return $caption;
}



/**
 * Customize the "Read More" link that shows up at the end of excerpts
 */
function uri2016_modify_read_more_link() {
	return '<a class="more-link" href="' . get_permalink() . '">More ...</a>';
}
add_filter( 'the_content_more_link', 'uri2016_modify_read_more_link' );


/**
 * Grab an excerpt with line breaks and remove images and videos from it.
 * @return str
 */
function uri2016_get_excerpt_with_line_breaks() {
	$content = get_the_content();
	$content = strip_tags($content, '<a><strong><em><p><div>');
	$content = preg_replace("/<img[^>]+\>/i", "(image) ", $content); 		
	$content = preg_replace("/<iframe[^>]+\>/i", "(video) ", $content);             
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]>', $content);
	return $content;
}


/**
 * Filter archive views by sortname if the 'n' parameter is set and one character long
 */
function uri2016_archive_meta_query( $query ) {
	if ( $query->is_archive && isset ( $_REQUEST['n'] ) && strlen ( $_REQUEST['n'] ) == 1 ) {
		// filter by first letter of sort name		
		$query->set('meta_key', 'sort_name');
		$query->set('meta_value', '^' . $_REQUEST['n']);
		$query->set('meta_compare', 'RLIKE');
	}
}
add_action( 'pre_get_posts', 'uri2016_archive_meta_query', 1 );


/**
 * Eliminate front-end dependency of ACF module
 * @todo: implement the $single functionality for parity with ACF's get_field()
 */
function uri2016_get_field( $field_name, $post_id, $single=FALSE ) {
	$post_meta = get_post_meta( $post_id, $field_name, $single );

	if(count($post_meta) == 1) {
		return $post_meta[0];
	} else {
		return NULL;
	}

}


function uri2016_open_graph() {
	global $post;
	$summary_type = 'summary';
	if( is_single() || is_page() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
		
		// use a larger image in twitter card if the image is wider than it is tall
		$landscape = ($image[1] > $image[2]);
		if($landscape === TRUE) {
			$summary_type = 'summary_large_image';
		}
		
		$image_thumb = $image[0];
		if( empty( $image_thumb ) ) {
			$image_thumb = 'http://today.uri.edu/wp-content/uploads/2016/06/URI-Wordmark.png';
		}
		
		$title = get_the_title();
		if( empty ( $title) ) { $title = 'URI Today'; }
		
		//$excerpt = get_the_excerpt($post);
		$excerpt = '';
		// since the excerpt is just about always empty...
		if( empty ( $excerpt ) ) {
			if( strpos( $post->post_content, '<!--more' ) !== FALSE && 1==2) {
				$bits = explode('<!--more', $post->post_content);
			} else {
				$bits = explode( "\n", wordwrap( $post->post_content, 200 ));
			}
			$excerpt = strip_tags($bits[0]);
			$excerpt = str_replace('"', '&quot;', $excerpt);
			$excerpt = trim($excerpt);
		}
		
		?>
<meta name="twitter:card" content="<?php print $summary_type; ?>" />
<meta name="twitter:site" content="@universityofri" />
<meta name="twitter:creator" content="@universityofri" />
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $excerpt; ?>" />
<?php if( $image_thumb ): ?><meta property="og:image" content="<?php echo $image_thumb; ?>" /><?php endif;
	}
}

add_action('wp_head', 'uri2016_open_graph');


/**
 * Exclude "links to" posts from the results
 * This avoids duplication and only shows the posts that are linked to.
 *
 * @param WP_Query $query Existing query object
 * @return WP_Query Amended query object
 */
function uri2016_search_filter( $query ) {
	if ( $query->is_search && !is_admin() ) {
		$meta_query[] = array(
			'key' => '_links_to',
			'compare' => 'NOT EXISTS',
		);
		$query->set('meta_query',$meta_query);
	}
	return $query;
}
add_filter( 'pre_get_posts', 'uri2016_search_filter' );



/**
 * Implement some admin-side customizations
 */
require get_template_directory() . '/inc/admin.php';

/**
 * Implement the Pagination feature.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
