<?php
/**
 * Plugin Name:       Assets Ninja
 * Plugin URI:        https://saberhr.com/
 * Description:       WordPress Assets Management in Depth
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            SaberHR
 * Author URI:        https://saberhr.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       assets-ninja
 * Domain Path:       /languages
 */

define( "ASN_ASSETS_DIR", plugin_dir_url( __FILE__ ) . "assets/" );
define( "ASN_ASSETS_PUBLIC_DIR", plugin_dir_url( __FILE__ ) . "assets/public/" );
define( "ASN_ASSETS_ADMIN_DIR", plugin_dir_url( __FILE__ ) . "assets/admin/" );

class AssetsNinja {
	private $version;

	public function __construct() {
		$this->version = time();
		add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_front_assets' ) );
	}

	public function load_text_domain() {
		load_plugin_textdomain( 'assets-ninja', false, plugin_dir_url( __FILE__ ) . "/languages" );
	}

	public function load_front_assets() {
		wp_enqueue_style( 'asn-main-css', ASN_ASSETS_PUBLIC_DIR . "/css/main.css", null, $this->version );
		wp_enqueue_script( 'asn-main-js', ASN_ASSETS_PUBLIC_DIR . "/js/main.js", array(
			'jquery',
			'asn-another-js'
		), $this->version, true );
		wp_enqueue_script( 'asn-another-js', ASN_ASSETS_PUBLIC_DIR . "/js/another.js", array(
			'jquery',
			'asn-more-js'
		), $this->version, true );
		wp_enqueue_script( 'asn-more-js', ASN_ASSETS_PUBLIC_DIR . "/js/more.js", array( 'jquery' ), $this->version, true );

		$data = array(
			"name"=>"Saber",
			"url"=>"http://saberhr.com/"
		);
		wp_localize_script('asn-more-js', 'site_data', $data);
	}
}


new AssetsNinja();