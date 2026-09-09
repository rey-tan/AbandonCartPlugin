<?php 

add_action('admin_menu', 'abandon_cart_admin_menu');

function abandon_cart_admin_menu() {

    // Top-level menu
    add_menu_page(
        'Abandon Cart',          // Page title
        'Abandon Cart',          // Menu title
        'manage_options',       // Capability
        'abandon-cart',          // Menu slug
        'abandon_cart_page',    // Callback
        'dashicons-cart',       // Icon
        25                      // Position
    );
}
function abandon_cart_page() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'abandon_carts';

    $carts = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT *
             FROM $table_name
             WHERE updated_at < %s
             ORDER BY updated_at ASC",
            wp_date(
                'Y-m-d H:i:s',
                time() - DAY_IN_SECONDS
            )
        )
    );
    ?>

    <div class="wrap">

        <h1>Abandoned Carts</h1>

        <table class="widefat striped">

            <thead>
                <tr>
                    <th>Email</th>
                    <th>Cart Hash</th>
                    <th>Last Activity</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($carts)): ?>

                    <tr>
                        <td colspan="3">
                            No abandoned carts found.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($carts as $cart): ?>

                        <tr>
                            <td>
                                <?php echo esc_html($cart->email); ?>
                            </td>

                            <td>
                                <?php echo esc_html($cart->cart_hash); ?>
                            </td>

                            <td>
                                <?php echo esc_html($cart->updated_at); ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <?php
}