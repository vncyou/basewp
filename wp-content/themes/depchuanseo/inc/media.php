<?php

/**
 * Construct and return an image tag for lazy-loading
 *
 * @param array|string|int $image
 * @param string $size
 * @param string $class
 * @param string $sizes
 * @param string $alt
 */
function _get_image($image, $size, $class, $alt, $sizes = '')
{
    if (is_array($image)) {
        $id = $image['ID'];
        $img = wp_get_attachment_image_src($id, $size)[0];
    } elseif (is_numeric($image)) {
        $id = $image;
        $img = wp_get_attachment_image_src($id, $size)[0];
    } else {
        $id = null;
        $img = $image;
    }

    if (empty($img)) {
        return;
    }

    $class = "class='lazy ${class}'";
    $sizes = empty($sizes) ? '' : "sizes='${sizes}'";
    $blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
    $html = '<img %s src="%s" data-normal="%s" data-retina="%s" data-srcset="%s" alt="%s" %s>';
    printf(
        $html,
        $class,
        $img,
        $img,
        $img,
        wp_get_attachment_image_srcset($id, $size) ? wp_get_attachment_image_srcset($id, $size) : $img,
        $alt,
        $sizes
    );
}

//SVGs
function _svg($data = false, $echo = true, $inline = false, $responsive = true)
{
    if ($inline):
        $return = _structure_svg($data, $responsive);
    else:
        $return = _get_svg($data);
    endif;

    if ($echo) {
        echo $return;
    }

    return $return;
}

function _structure_svg($data, $responsive)
{
    $return = '';
    $yes = preg_match('/viewBox="(.[^"]*)"/', $data, $matches);
    if ($yes):
        $vb = $matches[1];
        $nums = explode(' ', $vb);
        $aspect = 100 * (int)$nums[3] / (int)$nums[2];

        if ($responsive):
            $return = "<div class='u-svg' style='padding-top:{$aspect}%'>{$data}</div>";
        else:
            $return = "<div class='u-svg' style='height:50px'>{$data}</div>";
        endif;
    endif;

    return $return;
}

function _get_svg($name)
{
    $dir = '/assets/svg/';
    $path = $dir . $name . '.svg';

    if ($name && file_exists($path)) {
        return file_get_contents($path);
    }

    return '';
}

/**
 * @param $attrs array ['img_src', 'img_sizes', 'img_id']
 * @return string
 */
function dcs_image($attrs)
{
    /*
     * get image ID or placeholder image
     */
    $img = $attrs['img_id'] ?: get_field('_theme_image_placeholder', 'option');

    /*
     * get image lazy parameter
     */
    $lazy = (isset($attrs['lazy'])) ? '' : 'loading="lazy"';

    /*
     * default values
     */
    $img_width = 'width="100%"';
    $img_height = 'height="100%"';
    $img_markup = '';
    $img_alt = '';

    if ($img) {

        /*get image sizes, src, srcset*/
        $img_sizes = "sizes='" . $attrs['img_sizes'] . "'";

        if (is_numeric($img)) {

            /*add webp image if enabled*/
//        if (wp_get_attachment_image_srcset($img)) {
//            $img_srcset_webp = str_ireplace(array('.jpg ', '.jpeg ', '.png '), array('.jpg.webp ', '.jpeg.webp ', '.png.webp '), $img_srcset);
//            $img_markup = "<source type='image/webp' srcset=\"$img_srcset_webp\" $img_sizes>";
//        }

            $img_src = esc_url(wp_get_attachment_image_url($img, $attrs['img_src']));
            $img_srcset = wp_get_attachment_image_srcset($img);

            /*get image alt if existing or add title instead*/
            $img_alt = "alt='" . esc_attr(get_post_meta($img, '_wp_attachment_image_alt', true)) . "'";
            if (!get_post_meta($img, '_wp_attachment_image_alt', true)) {
                $img_alt = "alt='" . get_post($img)->post_title . "'";
            }

            /*get image sizes*/
            if (0 != wp_get_attachment_image_src($img, 'full')[1]) {
                $img_width = "width='" . wp_get_attachment_image_src($img, 'full')[1] . "'";
            }
            if (0 != wp_get_attachment_image_src($img, 'full')[2]) {
                $img_height = "height='" . wp_get_attachment_image_src($img, 'full')[2] . "'";
            }
        }

        /*return image markup*/
        return $img_markup . '<img class="img-fluid" ' . $lazy . ' src="' . $img_src . '" srcset="' . $img_srcset . '" ' . $img_sizes . ' ' . $img_alt . ' ' . $img_width . ' ' . $img_height . '/>';

    } else {
        /*return onepixel placeholder if both image and placeholder ID missing*/
        return '<img class="img-fluid" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Image"' . $img_width . ' '  . $img_height . '/>';
    }
}
