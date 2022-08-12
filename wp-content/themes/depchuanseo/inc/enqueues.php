<?php

/**
 * Enqueue scripts and styles.
 */
function dcs_scripts()
{
    wp_enqueue_style('dcs-style', get_template_directory_uri() . '/assets/main.min.css', array(), _S_VERSION);

    wp_enqueue_script('dcs-navigation', get_template_directory_uri() . '/assets/main.min.js', null, _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'dcs_scripts');
