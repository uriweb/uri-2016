<?php
/**
 * uri2016 functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uri2016
 */

if ( ! function_exists( 'uri2016_setup' ) ) :
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
endif;
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
 * Register widget area.
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


	wp_register_script( 'wp_environment', null);
	wp_enqueue_script( 'wp_environment' );
	$data = array(
		'theme_url' => $theme
	);
	//after wp_enqueue_script
	wp_localize_script( 'wp_environment', 'wordpress_environment', $data );




	wp_enqueue_style( 'uri2016-style', get_stylesheet_uri() );
	wp_enqueue_script( 'uri2016-menu', $theme . '/js/uri-menu.js', array(), '20151215', true );

	wp_enqueue_script( 'uri2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
	if( is_front_page() ) {
		//wp_enqueue_style( 'uri2016-style-front', $theme . '/css/front.css' );
		wp_register_script( 'uri2016-social',  $theme . '/js/uri-social.js', array(), '20151215', true );
		wp_enqueue_script( 'uri2016-social' );
	}

	wp_enqueue_script( 'uri2016-skip-link-focus-fix', $theme . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'uri-next', $theme . '/js/uri-next.js', array(), '20160510', true );




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
 * Replace footer credits for JetPack Inifite Scroll
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
 * Adds custom css to the admin section so that not all text areas are the same height.
 */
function uri2016_custom_admin_styles() {
  echo '<style>
    .wp-admin .field textarea {
      min-height: 0;
    } 
  </style>';
}
add_action('admin_head', 'uri2016_custom_admin_styles');


function uri2016_limit_posts_per_archive_page() {
	$posts_per_page = get_option('posts_per_page');
	if ( is_category() )
		set_query_var('posts_per_archive_page', $posts_per_page);
}

add_filter('pre_get_posts', 'uri2016_limit_posts_per_archive_page');


/**
 * Display navigation to next/previous set of posts when applicable.
 * Based on paging nav function from Twenty Fourteen
 */

function uri2016_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'uri2016' ),
		'next_text' => __( 'Next &rarr;', 'uri2016' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'uri2016' ); ?></h1>
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}





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
