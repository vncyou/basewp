<?php

add_action('wp_head', 'dns_prefetch', 0);
function dns_prefetch()
{
    ?>
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <link rel="dns-prefetch" href="//fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <?php
}

// Removes block editor
add_filter('use_block_editor_for_post', '__return_false');
// Remove Unnecessary Code from wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'feed_links', 2);

add_filter('use_block_editor_for_post', '__return_false'); // Disables the block editor for editing posts.
add_filter('gutenberg_use_widgets_block_editor', '__return_false'); // Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter('use_widgets_block_editor', '__return_false'); // Disables the block editor from managing widgets.

add_action('init', 'dcs_disable_emojis');
function dcs_disable_emojis()
{
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
    add_filter('emoji_svg_url', '__return_false');
    function disable_emojicons_tinymce($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }
}

add_action('init', 'dcs_disable_gutenberg');
function dcs_disable_gutenberg()
{
    function dcs_disable_gutenberg_scripts()
    {
        wp_dequeue_style('wp-block-library');
        // Remove Gutenberg theme.
        wp_dequeue_style('wp-block-library-theme');
        // Remove inline global CSS on the front end.
        wp_dequeue_style('global-styles');
    }

    add_action('wp_enqueue_scripts', 'dcs_disable_gutenberg_scripts');
    add_filter('use_block_editor_for_post', '__return_false'); // Disables the block editor for editing posts.
    add_filter('gutenberg_use_widgets_block_editor', '__return_false'); // Disables the block editor from managing widgets in the Gutenberg plugin.
    add_filter('use_widgets_block_editor', '__return_false'); // Disables the block editor from managing widgets.
}

add_action('init', function () {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    add_filter('xmlrpc_enabled', '__return_false');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_generator');
    add_filter('show_recent_comments_widget_style', '__return_false');
});

add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_php_nag', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
});

function dcs_adjust_the_wp_menu() {
    remove_submenu_page( 'themes.php', 'widgets.php' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'themes.php', 'customize.php');
    remove_submenu_page( 'themes.php', 'themes.php');

    $customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );
    remove_submenu_page( 'themes.php', $customizer_url);
}
add_action( 'admin_menu', 'dcs_adjust_the_wp_menu', 999 );

add_action( 'admin_bar_menu', function ($adminBar) {
    {
        $adminBar->remove_node('wp-logo');
        $adminBar->remove_node('about');
        $adminBar->remove_node('wporg');
        $adminBar->remove_node('documentation');
        $adminBar->remove_node('support-forums');
        $adminBar->remove_node('feedback');
        $adminBar->remove_node('widgets');
        $adminBar->remove_node('themes');
        $adminBar->remove_menu('customize');
        $adminBar->remove_menu('litespeed-menu');
    }
}, 999 );
