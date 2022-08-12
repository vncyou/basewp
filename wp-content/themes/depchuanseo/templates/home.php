<?php

/**
 * Template Name: Home-Page
 * Template Post Type: page
 */

get_header();
?>
    <main id="primary" class="site-main">
        <?=get_module('hero', [
            'title' => 100,
            'desc' => 200
        ]);?>
        <?=dcs_get_image('https://basewp.lndo.site/demo/anh-1.jpeg', ''); ?>
    </main>
<?php
get_footer();
