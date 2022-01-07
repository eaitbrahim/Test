<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bw_wp_boilerplate
 */

?>

	<?php get_sidebar( 'footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-footer__title">
		<?php bloginfo( 'name' ); ?>
		</div>
		<div class="site-footer__copyright">
			&copy; <?php echo date('Y'); ?> 
			<?php echo esc_html__( 'All Right Reserved' ); ?>
		</div>
		<div class="site-footer__terms">
			<a href="<?php echo site_url('/terms-and-conditions') ?>">Terms and Conditions </a>
			<a href="<?php echo site_url('/privacy-policy') ?>"> Privacy Policy</a>
		</div>
		<div class="site-footer__social-menu">
		<?php
					// Make sure there is a social menu to display.
					if ( has_nav_menu( 'social' ) ) { ?>
						<nav class="social-menu">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'social',
									'menu_class'     => 'social-links-menu',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>' . bw_wp_boilerplate_get_svg( array( 'icon' => 'chain' ) ),
								) );
							?>
						</nav><!-- .social-menu -->
				<?php } ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
