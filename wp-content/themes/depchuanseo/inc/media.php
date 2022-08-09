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
        $img = _ASSETS_URL . $image;
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
function _svg($data=false,$echo=true,$inline=false,$responsive=true){
    if ($inline):
        $return = _structure_svg($data,$responsive);
    else:
        $return = _get_svg($data);
    endif;

    if ($echo) {
        echo $return;
    }

    return $return;
}

function _structure_svg($data,$responsive){
    $return = '';
    $yes = preg_match('/viewBox="(.[^"]*)"/',$data,$matches);
    if ($yes):
        $vb = $matches[1];
        $nums = explode(' ',$vb);
        $aspect = 100*(int) $nums[3] / (int) $nums[2];

        if ($responsive):
            $return = "<div class='u-svg' style='padding-top:{$aspect}%'>{$data}</div>";
        else:
            $return = "<div class='u-svg' style='height:50px'>{$data}</div>";
        endif;
    endif;

    return $return;
}

function _get_svg($name){
    $dir  = _ASSETS_URL .'/assets/svg/';
    $path = $dir.$name.'.svg';

    if ( $name && file_exists($path) ){
        return file_get_contents($path);
    }

    return '';
}
