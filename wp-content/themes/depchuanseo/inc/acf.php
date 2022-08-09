<?php

/**
 * Integration with Advanced Custom Fields
 */

// https://www.advancedcustomfields.com/resources/options-page/

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Cấu hình thông tin website',
        'menu_title' => 'Tùy biến',
        'menu_slug' => 'dcs-theme-settings',
        'capability' => 'edit_posts',
        'position' => 1,
        'parent_slug' => 'themes.php',
        'redirect' => false,
    ]);
}
