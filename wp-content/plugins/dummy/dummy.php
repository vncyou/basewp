<?php
/**
 * Plugin Name: Dummy Data
 * Description: Create Post Demo
 * Version: 1.0.0
 * Author: TuanNDA
 * Author Uri: https://cyou.vn
 * Text Domain: dcs
 */

require_once(ABSPATH . 'wp-admin/includes/image.php');

class Dummy
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'adminMenu'));
    }

    public function adminMenu()
    {
        add_submenu_page('tools.php', 'Dummy Posts', 'Dummy Data', 'manage_options', 'dcs_dummy', array(
            $this,
            'adminLayout'
        ));
    }

    public function adminLayout()
    {
        if (isset($_POST['submit-post'])) {
            $catId = $_POST['cat_id'] ?: '';
            if ($catId > 0) {
//                $this->insertPosts($catId);
            }
        }
    ?>
        <div class="wrap">
            <h2><?php _e('Dummy Posts', 'base') ?></h2>
            <form id="dcs_dummy_post" method="post">
                <?php wp_dropdown_categories(array(
                    'hide_empty' => 0,
                    'name' => 'cat_id',
                    'id' => 'categories',
                    'hierarchical' => true,
                    'show_option_none' => __('None'),
                )); ?>
                <input type="submit" value="Dummy Posts" name="submit-post" class="button button-primary"/>
            </form>
        </div>
    <?php
    }
}

new Dummy();
