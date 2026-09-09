<?php

if (!defined('ABSPATH')) {
    exit;   
}


function sg_abandon_cart_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'abandon_carts';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        cart_hash VARCHAR(64) NOT NULL,
        email VARCHAR(320) NOT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NOT NULL,
        abandoned TINYINT(1) NOT NULL DEFAULT 0,
        cart_amount DECIMAL(19,4) NOT NULL DEFAULT 0.0000,

        PRIMARY KEY (id),
        UNIQUE KEY cart_hash (cart_hash),
        KEY email (email),
        KEY updated_at (updated_at),
        KEY abandoned (abandoned)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    dbDelta($sql);
}