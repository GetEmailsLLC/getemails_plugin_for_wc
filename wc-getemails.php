<?php
/*

@link              http://example.comhttps://github.com/GetEmails-com/woocommerce_ge_plugin
@since             1.0.0
@package           wc_getemails

@wordpress-plugin
Plugin Name:  WC GetEmails
Plugin URI:   https://github.com/GetEmails-com/woocommerce_ge_plugin/archive/master.zip
Description:  GetEmails plugin
Author:       Getemails
Author URI:   https://www.getemails.com
Version:      1.0.0
Copyright:    © 2020 Getemails (email : support@getemails.com)
License:      GPL-2.0+
License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:  wc-getemails
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WC_GETEMAILS_VERSION', '1.0.0' );

/**
 * Define plugin constants
 */
define( 'GETEMAILS_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );

if ( ! class_exists( 'WCGetemails' ) ) :
  class WCGetemails {
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
        require_once GETEMAILS_PATH . '/admin/wc-getemails-plugin.php';
        
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
      $integrations[] = 'WC_Getemails_plugin';
      return $integrations;
    }
  }

  $WCGetemails = new WCGetemails( __FILE__ );

  function wc_getemails_action_links( $links ) {
    $links[] = '<a href="'. menu_page_url( MY_PLUGIN_SLUG, false ) .'&tab=integration&section=getemails-integration">Settings</a>';
    return $links;
  }
  
endif;