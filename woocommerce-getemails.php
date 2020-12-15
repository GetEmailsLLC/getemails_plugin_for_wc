<?php
/*
Plugin Name: WooCommerce GetEmails
Plugin URI: https://www.getemails.com/woocommerce-plugin
Description: GetEmails plugin
Author: Getemails
Author URI: https://www.getemails.com
Version: 1.0.0
Copyright: © 2020 Getemails (email : support@getemails.com)
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Define plugin constants
 */
define( 'GETEMAILS_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );

if ( ! class_exists( 'WoocommerceGetemails' ) ) :
  class WoocommerceGetemails {
    /**
    * Construct the plugin.
    */
    public function __construct() {
      add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    /**
    * Initialize the plugin.
    */
    public function init() {
      // Checks if WooCommerce is installed.
      if ( class_exists( 'WC_Integration' ) ) {

        // Include our integration class.
        require_once GETEMAILS_PATH . '/admin/wc-getemails.php';
        
        // Register the integration.
        add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );

        // Set the plugin slug
        define( 'MY_PLUGIN_SLUG', 'wc-settings' );

        // Setting action for plugin
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_getemails_action_links' );
      }
    }
    /**
     * Add a new integration to WooCommerce.
     */
    public function add_integration( $integrations ) {
      $integrations[] = 'WC_Getemails';
      return $integrations;
    }
  }

  $WoocommerceGetemails = new WoocommerceGetemails( __FILE__ );

  function wc_getemails_action_links( $links ) {
    $links[] = '<a href="'. menu_page_url( MY_PLUGIN_SLUG, false ) .'&tab=integration&section=getemails-integration">Settings</a>';
    return $links;
  }
  
endif;