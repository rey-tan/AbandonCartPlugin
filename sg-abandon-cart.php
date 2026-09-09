<?php

/**
* Plugin Name: SG Abandon Cart
 * Plugin URI: https://splendourgroup.org/
 * Description: Woocommerce Cart Abandon Plugin
 * Version: 1.0.0
 * Author: Splendour Group
 * Requires Plugins: woocommerce
 * Author URI: https://splendourgroup.org/
 * Text Domain: sg-abandon-cart
 */


if (!defined('ABSPATH')) {
    exit;
}

if (!defined('SG_ABANDON_CART_DIR')) :
    define('SG_ABANDON_CART_DIR', plugin_dir_path(__FILE__));
    define('SG_ABANDON_CART_URL', plugins_url('/', __FILE__));
endif;

add_action('plugins_loaded', function(){

    if (!class_exists('WooCommerce')) {

        add_action('admin_notices', function(){

            echo '<div class="notice notice-error">
                <p>SG Abandon Cart requires WooCommerce.</p>
            </div>';

        });

        return;
    }

});


//loads the files inside include in the current plugin directory
require_once SG_ABANDON_CART_DIR . 'includes/functions.php';
if(is_admin()){
    require_once SG_ABANDON_CART_DIR . 'admin/sg-abandon-cart-admin.php';
    require_once SG_ABANDON_CART_DIR . 'admin/metabox/metabox.php';
    require_once SG_ABANDON_CART_DIR . 'admin/includes/enqueue.php';
    require_once SG_ABANDON_CART_DIR . 'admin/includes/functions.php';
    require_once SG_ABANDON_CART_DIR . 'admin/includes/sg-abandon-cart-db.php';
}



//load files if in admin dashboard
if(is_admin()){
    require_once SG_ABANDON_CART_DIR . 'admin/sg-abandon-cart-admin.php';
}


/**
 * Run on plugin activation
 */
register_activation_hook(__FILE__,function(){
    error_log("SG Abandon Cart plugin activated");
    create_abandon_cart_table();
});


/**
 * Run on plugin deactivation
 */ 
register_deactivation_hook(__FILE__,function(){
    error_log("SG Abandon Cart plugin deactivated");
});