<?php
// Enqueue styles and scripts for the theme
function luckycar_enqueue_assets() {
    // Check if wp_enqueue_style exists
    if (function_exists('wp_enqueue_style')) {
        wp_enqueue_style('luckycar-style', get_stylesheet_uri(), array(), '1.0');
    }

    // Check if wp_enqueue_script exists
    if (function_exists('wp_enqueue_script')) {
        wp_enqueue_script('luckycar-js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
    }

    // Check if wp_localize_script exists
    if (function_exists('wp_localize_script')) {
        wp_localize_script('luckycar-js', 'luckycar_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
    }
}
add_action('wp_enqueue_scripts', 'luckycar_enqueue_assets');

// Add dark mode toggle script
function luckycar_dark_mode_script() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('dark-mode-toggle');
            if (toggle) {
                toggle.addEventListener('click', function() {
                    const body = document.body;
                    const currentTheme = body.dataset.theme || 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    body.dataset.theme = newTheme;
                    localStorage.setItem('theme', newTheme);
                });

                const savedTheme = localStorage.getItem('theme');
                if (savedTheme) {
                    document.body.dataset.theme = savedTheme;
                } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.body.dataset.theme = 'dark';
                }
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'luckycar_dark_mode_script');

// Shortcode for participant counter
function luckycar_participant_counter($atts) {
    $atts = shortcode_atts(array('total' => 1000, 'current' => 850), $atts, 'participant_counter');
    $percent = ($atts['current'] / $atts['total']) * 100;
    $output = '<div class="progress-bar"><div class="progress-fill" style="width: ' . $percent . '%;"></div></div>';
    $output .= '<p>' . $atts['current'] . '/' . $atts['total'] . ' شرکت‌کننده</p>';
    return $output;
}
add_shortcode('participant_counter', 'luckycar_participant_counter');

// Shortcode for wallet balance
function luckycar_wallet() {
    $balance = 0; // Placeholder, as get_user_meta is WordPress-specific
    $formatted_balance = number_format($balance, 0, '', ',');
    $output = '<div class="widget"><h3>موجودی کیف پول</h3><p>' . $formatted_balance . ' تومان</p></div>';
    return $output;
}
add_shortcode('wallet_balance', 'luckycar_wallet');

// Shortcode for referral link
function luckycar_referral() {
    $user_id = 0; // Placeholder, as get_current_user_id is WordPress-specific
    $ref_link = 'http://example.com' . '?ref=' . $user_id; // Placeholder URL
    $output = '<div class="widget"><h3>دعوت دوستان</h3><p>لینک شما: <span>' . $ref_link . '</span></p></div>';
    return $output;
}
add_shortcode('referral_link', 'luckycar_referral');
?>