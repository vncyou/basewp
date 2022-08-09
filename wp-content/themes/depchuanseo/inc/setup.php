<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
add_action('after_setup_theme', function () {
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on depchuanseo, use a find and replace
        * to change 'dcs' to the name of your theme in all the template files.
        */
    load_theme_textdomain('dcs', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
    add_theme_support('title-tag');

    /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary', 'dcs'),
        )
    );

    /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action('after_setup_theme', function () {
    $GLOBALS['content_width'] = apply_filters('dcs_content_width', 640);
}, 0);

add_filter('wp_trim_excerpt', function ($excerpt) {
    return wp_trim_words($excerpt, 30);
}, 99, 2);

add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_year()) {
        $title = get_the_date(_x('Y', 'yearly archives date format'));
    } elseif (is_month()) {
        $title = get_the_date(_x('F Y', 'monthly archives date format'));
    } elseif (is_day()) {
        $title = get_the_date(_x('F j, Y', 'daily archives date format'));
    } elseif (is_tax('post_format')) {
        if (is_tax('post_format', 'post-format-aside')) {
            $title = _x('Asides', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-gallery')) {
            $title = _x('Galleries', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-image')) {
            $title = _x('Images', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-video')) {
            $title = _x('Videos', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-quote')) {
            $title = _x('Quotes', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-link')) {
            $title = _x('Links', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-status')) {
            $title = _x('Statuses', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-audio')) {
            $title = _x('Audio', 'post format archive title');
        } elseif (is_tax('post_format', 'post-format-chat')) {
            $title = _x('Chats', 'post format archive title');
        }
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_tax()) {
        $queried_object = get_queried_object();
        if ($queried_object) {
            $title = single_term_title('', false);
        }
    }

    return $title;
});

add_action('intermediate_image_sizes', function ($sizes) {
    return array_diff($sizes, array('medium', 'medium_large', 'large', '1536x1536', '2048x2048'));
}, 999);

add_action('after_setup_theme', function () {
    add_image_size('w200', 200);
    add_image_size('w400', 400);
    add_image_size('w600', 600);
    add_image_size('w800', 800);
    add_image_size('w1000', 1000);
    add_image_size('w1200', 1200);
    add_image_size('w1400', 1400);
    add_image_size('w1600', 1600);
    add_image_size('w1800', 1800);
    add_image_size('w2000', 2000);
}, 999);

/**
 * Add source to allowed wp_kses_post tags
 *
 * @param array $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by.
 *
 * @return array
 * @since starter 1.0
 *
 */
add_filter('wp_kses_allowed_html', function ($tags, $context) {
    $tags['img']['sizes'] = true;
    $tags['img']['srcset'] = true;
    $tags['source'] = array(
        'srcset' => true,
        'sizes' => true,
        'type' => true,
    );
    return $tags;
}, 10, 2);

/**
 * Allow data protocol
 *
 * @param array $protocols Allowed protocols.
 *
 * @return array
 * @since starter 2.0
 *
 */
add_filter('kses_allowed_protocols', function ($protocols) {
    $protocols[] = 'data';
    return $protocols;
}, 10, 2);

/**
 * Allow upload svg files.
 *
 * @param array $mimes Mime types keyed by the file extension regex corresponding to those types.
 * @return array $mimes with svg.
 * @since starter 1.0
 *
 */
add_filter('upload_mimes', function ($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});
