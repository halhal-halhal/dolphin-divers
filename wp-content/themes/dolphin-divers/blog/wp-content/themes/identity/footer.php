<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Identity
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer-inner">
			<?php get_sidebar( 'footer' ); ?>
			<div class="site-info">
				<span class="site-info-left">copyright(c) 2013　 All rights reserved.<a href="<?php echo esc_url( __( 'http://dolphin-divers.jp/' ) ); ?>" rel="generator">ドルフィンダイバーズ</a></span>
				
			</div><!-- .site-info -->
		</div><!-- .footer-inner -->
	</footer><!-- #colophon -->

	<a href="#content" class="back-to-top"><span class="screen-reader-text">Back To Top</span><span class="genericon genericon-top" aria-hidden="true"></span></a>
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
