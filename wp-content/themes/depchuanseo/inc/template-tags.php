<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package depchuanseo
 */

if (! function_exists('dcs_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function dcs_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'dcs'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (! function_exists('dcs_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function dcs_posted_by()
    {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('by %s', 'post author', 'dcs'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (! function_exists('dcs_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function dcs_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'dcs'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'dcs') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'dcs'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'dcs') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dcs'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'dcs'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (! function_exists('dcs_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function dcs_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || ! has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                    the_post_thumbnail(
                        'post-thumbnail',
                        array(
                            'alt' => the_title_attribute(
                                array(
                                    'echo' => false,
                                )
                            ),
                        )
                    );
                ?>
            </a>

            <?php
        endif; // End is_singular().
    }
endif;

if (! function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
endif;

if (!function_exists('dcs_excerpt')) :
    function dcs_excerpt($excerpt, $count = 30)
    {
        $raw_str = strip_tags($excerpt);
        $trim_str = rtrim($raw_str);

        echo wp_trim_words($trim_str, $count);
    }
endif;

if (!function_exists('dcs_pagination')):
    function dcs_pagination()
    {
        $paginates = paginate_links([
            'mid_size' => 1,
            'type' => 'array'
        ]);

        if ($paginates) {
            $html = '<nav aria-label="Page pagination" class="d-flex justify-content-center"><ul class="pagination">';
            foreach ($paginates as $paginate) {
                $html .= '<li class="page-item">' . $paginate . '</li>';
            }
            $html .= '</ul></nav>';

            echo $html;
        }

        echo '';
    }
endif;

if (!function_exists('dcs_post_navigation')):
    function dcs_post_navigation($args = array())
    {
        // Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
        if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
            $args['aria_label'] = $args['screen_reader_text'];
        }

        $args = wp_parse_args(
            $args,
            array(
                'prev_text'          => '%title',
                'next_text'          => '%title',
                'in_same_term'       => false,
                'excluded_terms'     => '',
                'taxonomy'           => 'category',
                'screen_reader_text' => __( 'Post navigation' ),
                'aria_label'         => __( 'Posts' ),
                'class'              => 'post-navigation',
            )
        );

        $navigation = '';

        $previous = get_previous_post_link(
            '<div class="col-sm-6 bg-primary-soft p-4 position-relative border-end border-1 rounded-start nav-previous"><span><i class="ti ti-arrow-big-left-lines me-1 rtl-flip"></i>' . __('Bài cũ') . '</span><h5 class="m-0 btn-link text-decoration-none">%link</h5></div>',
            $args['prev_text'],
            $args['in_same_term'],
            $args['excluded_terms'],
            $args['taxonomy']
        );

        $next = get_next_post_link(
            '<div class="col-sm-6 bg-primary-soft p-4 position-relative text-sm-end rounded-end nav-next"><span>' . __('Bài mới') . '<i class="ti ti-arrow-big-right-lines ms-1 rtl-flip"></i></span><h5 class="m-0 btn-link text-decoration-none">%link</h5></div>',
            $args['next_text'],
            $args['in_same_term'],
            $args['excluded_terms'],
            $args['taxonomy']
        );

        // Only add markup if there's somewhere to navigate to.
        if ( $previous || $next ) {
            $class = $args['class'];
            $screen_reader_text = $args['screen_reader_text'];
            $links = $previous . $next;
            $aria_label = $args['aria_label'];

            if ( empty( $screen_reader_text ) ) {
                $screen_reader_text = __( 'Posts navigation' );
            }
            if ( empty( $aria_label ) ) {
                $aria_label = $screen_reader_text;
            }

            $template = '<nav class="post-navigation %1$s" aria-label="%4$s"><h2 class="screen-reader-text">%2$s</h2><div class="row g-0 nav-links">%3$s</div></nav>';

            /**
             * Filters the navigation markup template.
             *
             * Note: The filtered template HTML must contain specifiers for the navigation
             * class (%1$s), the screen-reader-text value (%2$s), placement of the navigation
             * links (%3$s), and ARIA label text if screen-reader-text does not fit that (%4$s):
             *
             *     <nav class="navigation %1$s" aria-label="%4$s">
             *         <h2 class="screen-reader-text">%2$s</h2>
             *         <div class="nav-links">%3$s</div>
             *     </nav>
             *
             * @since 4.4.0
             *
             * @param string $template The default template.
             * @param string $class    The class passed by the calling function.
             * @return string Navigation template.
             */
            $template = apply_filters( 'navigation_markup_template', $template, $class );

            $navigation = sprintf( $template, sanitize_html_class( $class ), esc_html( $screen_reader_text ), $links, esc_html( $aria_label ) );
        }

        echo $navigation;
    }
endif;
