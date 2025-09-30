<?php
if (!defined('ABSPATH')) {
	exit;
}
?>
<footer class="footer" role="contentinfo">
	<div class="footer__inner">
		<?php
		echo esc_html__('© ', 'lottery-theme') . esc_html(date_i18n('Y')) . ' ' . esc_html(get_bloginfo('name'));
		?>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
