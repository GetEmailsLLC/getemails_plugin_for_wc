<?php

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

remove_action( 'woocommerce_after_add_to_cart_button', 'call_add_to_cart_script' );
remove_action( 'woocommerce_order_status_completed',   'call_order_script');

?>