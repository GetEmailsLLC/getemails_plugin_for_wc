<?php
/*

@link              https://github.com/GetEmails-com/getemails_plugin_for_wc
@since             1.0.0
@package           getemails

@wordpress-plugin
Plugin Name:  GetEmails for WooCommerce
Plugin URI:   https://github.com/GetEmails-com/getemails_plugin_for_wc/archive/master.zip
Description:  GetEmails plugin
Author:       Getemails
Author URI:   https://www.getemails.com
Version:      1.0.0
Copyright:    © 2020 Getemails (email : support@getemails.com)
License:      GPL-2.0+
License URI:  http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:  getemails
Domain Path:  /getemails-plugin
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GETEMAILS_VERSION', '1.0.0' );

/**
 * Define plugin constants
 */
define( 'GETEMAILS_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );

if ( ! class_exists( 'Getemails' ) ) :
  class Getemails {
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
        require_once GETEMAILS_PATH . '/admin/getemails-script.php';
        
        // Register the integration.
        add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );

        // Set the plugin slug
        define( 'GETEMAILS_PLUGIN_FOR_WC_SLUG', 'wc-settings' );

        // Setting action for plugin
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'getemails_action_links' );
      }
    }
    /**
     * Add a new integration to WooCommerce.
     */
    public function add_integration( $integrations ) {
      $integrations[] = '\Getemails\Getemails_Script';
      return $integrations;
    }
  }

  $Getemails = new Getemails( __FILE__ );

  function getemails_action_links( $links ) {
    $links[] = '<a href="'. menu_page_url( GETEMAILS_PLUGIN_FOR_WC_SLUG, false ) .'&tab=integration&section=getemails-integration">Settings</a>';
    return $links;
  }
  
endif;