<?php
if (!defined('ABSPATH')) {
	exit;
}
get_header();
?>
<main id="primary" class="site-main container">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			the_content();
		}
	} else {
		echo '<p>' . esc_html__('No posts found.', 'lottery-theme') . '</p>';
	}
	?>

	<?php
	// Demo blocks (remove or keep as needed)
	echo do_shortcode('[lottery_participants]');
	echo do_shortcode('[wallet_balance]');
	echo do_shortcode('[referral_link]');
	?>
</main>
<?php
get_footer();
