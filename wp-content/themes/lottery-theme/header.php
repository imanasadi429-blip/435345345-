<?php
if (!defined('ABSPATH')) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" role="banner">
	<div class="site-header__inner">
		<div class="site-title">
			<a href="<?php echo esc_url(home_url('/')); ?>">
				<?php bloginfo('name'); ?>
			</a>
		</div>
		<nav class="nav-primary" role="navigation" aria-label="<?php echo esc_attr__('Primary', 'lottery-theme'); ?>">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'menu',
				'fallback_cb'    => false,
			));
			?>
		</nav>
		<button id="lottery-dark-toggle" class="dark-toggle" type="button" aria-label="<?php echo esc_attr__('Toggle dark mode', 'lottery-theme'); ?>">
			<?php echo esc_html__('Dark', 'lottery-theme'); ?>
		</button>
	</div>
</header>
