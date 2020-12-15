<?php
/**
 * @link              http://example.comhttps://github.com/GetEmails-com/woocommerce_ge_plugin
 * @since             1.0.0
 * @package           wc_getemails
 *
 * @package    WC_Getemails
 * @subpackage WC_Getemails/admin
 */

/**
 *
 * @package    WC_Getemails
 * @subpackage WC_Getemails/admin
 * @author     Getemails <https://getemails.com/>
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if WooCommerce is active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	function cart_script_template() {
		$product_id = get_the_ID();
		$product = wc_get_product( $product_id );

		echo "<script>
		var item = {
            ProductID: '" . $product->get_id() ."',
            ProductType: '" . $product->get_type() ."',
            ImageURL: '" . get_the_post_thumbnail_url($product_id) ."',
            Name: '" . $product->get_name() . "',
            Categories: '" . json_encode($product->get_category_ids()) . "',
            URL: '" . get_permalink( $product->get_id() ) . "',
            Slug: '" . $product->get_slug() ."',
            Price: '" . $product->get_price() . "',
            CompareAtPrice: '" . $product->get_regular_price() . "'
        };

		geq.page();
		geq.addToCart(item);
		
		</script>";
    }
}