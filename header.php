<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri2016
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<header id="uri-header" class="uri-branding">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'uri2016' ); ?></a>
	<div class="site">
		<hgroup>
			<!--h1><a href="http://uri.edu"><object type="image/svg+xml" data="<?php print get_template_directory_uri(); ?>/img/uri-logo.svg" id="uri-logo">The University of Rhode Island</object></a></h1-->
			<h1><a href="http://uri.edu">
				<span id="logo">
					<span class="the">The</span>
					<span class="university"><b>U</b>nive<b>r</b>s<b>i</b>ty</span>
					<span class="of-rhode-island">of Rhode Island</span>
				</span>
			</a></h1>
			<h2 class="think-big-we-do">Think Big. We Do.</h2>
		</hgroup>
		<div class="search-wrapper"><?php get_search_form(); ?></div>
	</div>
</header>

<div id="page">
	<header id="masthead" class="site-header" role="banner"<?php if ( get_header_image() ) { echo ' style="background-image:url(' . get_header_image() . '); height: ' . esc_attr( get_custom_header()->height ) . 'px;"'; } ?>>
		<div class="site site-branding-wrapper">
			<div class="site-branding">
			
				<?php
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-branding -->
		</div>
		<div class="site nav-wrapper">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'uri2016' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content site">
