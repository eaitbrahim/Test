<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bw_wp_boilerplate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'bw_wp_boilerplate' ); ?></a>

	<header class="top-header">
		<div class="top-header__contact-info">
				<a href="/#google-map">
					<img src="<?php echo get_theme_file_uri('/images/location.png'); ?>" alt="location: ">
					<span>
					<?php 
						$address = get_theme_mod( 'address_text', 'display' );
						if ( $address || is_customize_preview() ) : 
							echo $address;
						endif;
					?>
					</span>
				</a>
			
				<?php 
						$phone = get_theme_mod( 'phone_text', 'display' );
						if ( $phone || is_customize_preview() ) : 
				?>
				<a href="tel:<?php $phone; ?>">
					<img src="<?php echo get_theme_file_uri('/images/phone.png'); ?>" alt="phone: ">
					<span>
						<?php echo $phone; ?>
					</span>
				</a>
				<?php endif; ?>
		</div>
		<div class="top-header__social-menu">
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
		<div class="top-header__search">
			<form role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" class="top-header__search--input js-search-input" placeholder="Search"  aria-label="search" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>">
			</form>		
			<svg class="top-header__search--icon js-search-trigger">
					<use xlink:href="<?php echo get_theme_file_uri('/images/svg-icons.svg#icon-search'); ?>"></use>
			</svg>
		</div>
	</header>

	<header id="masthead" class="site-header">
		<div class="site-header__logo">
			<figure class="site-header__logo"><?php the_custom_logo(); ?></figure>
		</div>

		<div class="site-header__titles">
			<span class="site-header__titles--name">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</span>
			<?php
				$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : 
			?>
			<span class="site-header__titles--desc"><?php echo $description; /* WPCS: xss ok. */ ?></span>
			<?php endif; ?>
		</div>
		
		<div class="menu-wrap">
			<input type="checkbox" class="toggler" >
			<div class="hamburger"><div></div></div>

			<div class="main-nav">
				<div>
        	<div>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						<div class="site-header__action-button"><button onclick="location.href='/';">Call To Action</button></div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<?php if ( get_header_image() && is_front_page() ) : ?>
	<header class="banner-header">
		<img src="<?php echo header_image();?>" alt="Image banner" class="banner-header__img" >
		
		<div class="banner-header__content">
		<?php 
				$headerBanner = new WP_Query(array(  
								'posts_per_page' => 1,
								'post_type' => 'banner',
									));
					
							while($headerBanner->have_posts()) {
								$headerBanner->the_post();
								get_template_part('template-parts/content', 'banner');
							}      
			?>
		</div>
	</header>
	<?php endif; // End header image check. ?>