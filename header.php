<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sigara
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="header">
		<nav <?php echo is_user_logged_in() ? 'style="top:32px !important"' : ''; ?> class="<?php echo get_site_url(); ?> navbar navbar-expand-lg navbar-light fixed-top shadow-sm bg_custom_header">
			<div class="container">
				<a class="navbar-brand" href="<?php echo site_url(); ?> ">
					<?php if (getLogo() == null) {
						echo "<span class='logo_text'>" . get_bloginfo() . "</span>";
					} else { ?>
						<img data-src="<?php echo getLogo(); ?>" alt="logo" class="lozad" height="35">
					<?php } ?>

				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'header_1',
					'depth'           => 2,
					'container'       => 'div',
					'container_id'    => 'navbarTogglerDemo02',
					'container_class' => 'collapse navbar-collapse',
					'menu_class'      => 'navbar-nav mr-auto mt-2 mt-lg-0',
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker()
				));
				?>

			</div>
		</nav>
	</div>