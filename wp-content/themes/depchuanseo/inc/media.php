<?php
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
function dcs_media($attrs)
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

    if ($img) {

        /*get image sizes, src, srcset*/
        $img_sizes = "sizes='" . $attrs['img_sizes'] . "'";

        $img_src = esc_url(wp_get_attachment_image_url($img, $attrs['img_src']));
        $img_srcset = wp_get_attachment_image_srcset($img);

        /*get image alt if existing or add title instead*/
        $img_alt = "alt='" . esc_attr(get_post_meta($img, '_wp_attachment_image_alt', true)) . "'";
        if (!get_post_meta($img, '_wp_attachment_image_alt', true)) {
            $img_alt = "alt='" . get_post($img)->post_title . "'";
        }

        /*get image sizes*/
        $size = wp_get_attachment_image_src($img, 'full');
        if (0 != $size[1]) {
            $img_width = "width='" . $size[1] . "'";
        }
        if (0 != $size[2]) {
            $img_height = "height='" . $size[2] . "'";
        }

        /*return image markup*/
        return '<img class="lazy" ' . $lazy . ' src="' . $img_src . '" srcset="' . $img_srcset . '" ' . $img_sizes . ' ' . $img_alt . ' ' . $img_width . ' ' . $img_height . '/>';

    } else {
        /*return onepixel placeholder if both image and placeholder ID missing*/
        return '<img class="img-fluid" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Image"' . $img_width . ' '  . $img_height . '/>';
    }
}

function dcs_get_media(
    $id,
    $src = 'w800',
    $sizes = '(max-width: 575px) calc(100vw - 24px), (max-width: 767px) 516px, (max-width: 991px) 336px, (max-width: 1199px) 456px, (max-width: 1399px) 546px, 636px'
) {
    return wp_kses(dcs_media(array(
        'img_src' => $src,
        'img_sizes' => $sizes,
        'img_id' => $id
    )), wp_kses_allowed_html('post'));
}

function dcs_get_image($url, $alt, $class)
{
    return '<img src="' . esc_url($url) . '" loading="lazy" class="lazy ' . $class . '" alt="' . esc_attr($alt) . '" />';
}
