<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uri2016
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer site" role="contentinfo">
		<div class="site-info">
			<div class="feedback">Send URI Today website feedback to <a href="mailto:jpennypacker@uri.edu">John Pennypacker</a> or call 874-4890.</a></div>
			<div class="copyright">Copyright &copy; <a href="//uri.edu">University of Rhode Island</a></div>
			<ul class="tactical">
				<li><a href="//web.uri.edu/about/services/">A-Z</a></li>
				<li><a href="http://directory.uri.edu">Directory</a></li>
				<li><a href="//map.uri.edu">Maps</a></li>
				<li><a href="//web.uri.edu/about/contact/">Contact Us</a></li>
				<li><a href="//web.uri.edu/alert/">Alerts</a></li>
			</ul>
			<p>University of Rhode Island, Kingston, RI 02881, USA 1.401.874.1000<br />
			URI is an equal opportunity employer committed to the principles of affirmative action.</p>
			<ul class="internal">
				<li><a href="http://web.uri.edu/ecampus" rel="nofollow">eCampus</a></li>
				<li><a href="http://sakai.uri.edu/" rel="nofollow">Sakai</a></li>
				<li><a href="//web.uri.edu/its/uri-email/" rel="nofollow">Email</a></li>
				<li><a href="https://rhodynet.uri.edu" rel="nofollow">RhodyNet</a></li>
				<li><a href="<?php echo wp_login_url(); ?>" rel="nofollow">Login</a></li>
			</ul>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="site uri-navigation">
	<?php
		// include the global URI nav
		get_template_part( 'template-parts/uri', 'menu' );
	?>
</div>

<?php wp_footer(); ?>

</body>
</html>
