<?php
function wpdocs_selectively_enqueue_admin_script() {
    wp_enqueue_style('sg-abandon-cart-admin-css', '/wp-content/plugins/sg-abandon-cart/admin/assets/css/abandon-cart-admin.css',array() );
    wp_enqueue_script('sg-abandon-cart-admin-js', '/wp-content/plugins/sg-abandon-cart/admin/assets/js/abandon-cart-admin.js',array() );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );
?>