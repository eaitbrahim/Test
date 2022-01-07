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

	<footer class="top-footer">
		<div class="top-footer__site-identity">
			<figure><img src="<?php echo wp_get_attachment_image_url(2015); ?>" alt="logo"></figure>
			
			<div class="top-footer__titles">
				<h1 class="heading-1"><?php bloginfo( 'name' ); ?></h1>
				<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : 
				?>
						<span><?php echo $description; ?></span>
				<?php endif; ?>

			</div>
		</div>

		<div id="google-map" class="google-map">
			<?php 
				$address = get_theme_mod( 'address_text', 'display' );
      ?>
			<div class="marker" data-address="<?php echo $address ?>" data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
				<h5><?php bloginfo( 'name' ); ?></h5>
				<?php echo $address; ?>
			</div>
		</div>
	</footer>
	
	<footer class="big-footer">
		<div class="big-footer__about--excerpt">
			<h4 class="heading-4">About</h4>
			<p>
			We  have much planned for the future, working with great clients and continued software development. If you'd like to join our team, then we'd also love to hear from you.
			</p>
		</div>
		<div class="big-footer__menu">
			<h6 class="heading-6">Blog</h6>
			<ol class="big-footer__menu-list">
			<?php
          $homepagePosts = new WP_Query(array(
            'posts_per_page' => 4
          ));

          while ($homepagePosts->have_posts()) {
            $homepagePosts->the_post(); ?>
            <li><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
          <?php } 
					wp_reset_postdata();
        	?> 
				</ol>
		</div>
		<div class="big-footer__menu">
			<h6 class="heading-6">About</h6>
			<ul class="big-footer__menu-list">
				<li><a href="#">Our Story</a></li>
				<li><a href="#">Benefits</a></li>
				<li><a href="#">Careers</a></li>
			</ul>
		</div>
		<div class="big-footer__menu">
			<h6 class="heading-6">Contact Us</h6>
			<ul class="big-footer__menu-list">
				<li><a href="#">FAQs</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</div>
		<div class="big-footer__send-message">
			<h4 class="heading-4">Send a Message</h4>
			<?php get_template_part('template-parts/content', 'send-message'); ?>
		</div>
	</footer>

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
