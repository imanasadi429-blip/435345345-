<?php
if (!defined('ABSPATH')) {
	exit;
}

function lottery_theme_setup() {
	load_theme_textdomain('lottery-theme', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));

	register_nav_menus(array(
		'primary' => esc_html__('Primary Menu', 'lottery-theme'),
	));
}
add_action('after_setup_theme', 'lottery_theme_setup');

function lottery_theme_enqueue_assets() {
	$version = wp_get_theme()->get('Version');

	wp_enqueue_style('lottery-theme-style', get_stylesheet_uri(), array(), $version);
	wp_style_add_data('lottery-theme-style', 'rtl', 'replace');

	wp_enqueue_script(
		'lottery-theme-main',
		get_template_directory_uri() . '/js/main.js',
		array(),
		$version,
		true
	);

	wp_localize_script('lottery-theme-main', 'lotteryTheme', array(
		'copyLabel'    => esc_html__('Copy', 'lottery-theme'),
		'copiedLabel'  => esc_html__('Copied!', 'lottery-theme'),
		'darkOn'       => esc_html__('Dark', 'lottery-theme'),
		'darkOff'      => esc_html__('Light', 'lottery-theme'),
	));
}
add_action('wp_enqueue_scripts', 'lottery_theme_enqueue_assets');

function lottery_shortcode_participants($atts) {
	$atts = shortcode_atts(array(
		'current' => get_option('lottery_current_participants', 850),
		'max'     => get_option('lottery_max_participants', 1000),
	), $atts, 'lottery_participants');

	$current = (int) $atts['current'];
	$max     = (int) $atts['max'];

	if ($current < 0) $current = 0;
	if ($max <= 0) $max = 1;
	if ($current > $max) $current = $max;

	$percent = $max > 0 ? round(($current / $max) * 100) : 0;

	ob_start();
	?>
	<div class="lottery-participants" role="group" aria-label="<?php echo esc_attr__('Participants', 'lottery-theme'); ?>">
		<span class="lottery-participants__count">
			<?php echo esc_html(number_format_i18n($current)); ?> / <?php echo esc_html(number_format_i18n($max)); ?>
		</span>
		<div class="lottery-progress" aria-hidden="true">
			<div class="lottery-progress__bar" style="width: <?php echo esc_attr($percent); ?>%"></div>
		</div>
	</div>
	<?php
	return trim(ob_get_clean());
}
add_shortcode('lottery_participants', 'lottery_shortcode_participants');

function lottery_shortcode_wallet_balance($atts) {
	if (!is_user_logged_in()) {
		return '<div class="lottery-wallet">' . esc_html__('Please log in to view your wallet balance.', 'lottery-theme') . '</div>';
	}
	$user_id = get_current_user_id();
	$balance = get_user_meta($user_id, 'lottery_wallet_balance', true);
	if ($balance === '' || $balance === false) {
		$balance = 0;
	}
	$balance   = floatval($balance);
	$formatted = number_format_i18n($balance, 0);

	return '<div class="lottery-wallet">' . sprintf(
		esc_html__('Wallet balance: %s', 'lottery-theme'),
		esc_html($formatted)
	) . '</div>';
}
add_shortcode('wallet_balance', 'lottery_shortcode_wallet_balance');

function lottery_shortcode_referral_link($atts) {
	if (!is_user_logged_in()) {
		return '<div class="lottery-referral">' . esc_html__('Please log in to get your referral link.', 'lottery-theme') . '</div>';
	}
	$user_id  = get_current_user_id();
	$ref_param = 'ref';
	$url      = add_query_arg(array($ref_param => $user_id), home_url('/'));
	$url      = esc_url($url);
	$copy_id  = 'referral-link-' . (int) $user_id;

	ob_start();
	?>
	<div class="lottery-referral">
		<input type="text" readonly id="<?php echo esc_attr($copy_id); ?>" class="lottery-referral__input" value="<?php echo $url; ?>" aria-label="<?php echo esc_attr__('Referral link', 'lottery-theme'); ?>" />
		<button type="button" class="lottery-referral__copy" data-target="#<?php echo esc_attr($copy_id); ?>">
			<?php echo esc_html__('Copy', 'lottery-theme'); ?>
		</button>
	</div>
	<?php
	return trim(ob_get_clean());
}
add_shortcode('referral_link', 'lottery_shortcode_referral_link');

