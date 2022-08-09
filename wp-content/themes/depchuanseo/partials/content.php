<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package depchuanseo
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php

        the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                dcs_posted_on();
                dcs_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <picture class="thumbnail-image">
        <?php echo wp_kses(dcs_image(array(
            'img_src' => 'w600',
            'img_sizes' => '(max-width: 575px) calc(100vw - 26px), (max-width: 767px) 244px, (max-width: 991px) 334px, (max-width: 1199px) 294px, (max-width: 1399px) 354px, 414px',
            'img_id' => 'https://basewp.lndo.site/demo/anh-1.jpeg'
        )), wp_kses_allowed_html('post')) ?>
    </picture>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'dcs'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'dcs'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php dcs_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
