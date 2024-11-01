<?php
/**
 * Plugin Name: WP Awesome City Weather Report
 * Plugin URI:  https://jeweltheme.com
 * Description: WP Awesome City Weather Report is a Widget that displays a specified city weather Report
 * Version:     1.0.4
 * Author:      Jewel Theme
 * Author URI:  https://jeweltheme.com
 * Text Domain: wp-awesome-city-weather-report
 * Domain Path: languages/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package wp-awesome-city-weather-report
 */

/*
 * don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( esc_html__( 'You can\'t access this page', 'wp-awesome-city-weather-report' ) );
}

$jltctwr_plugin_data = get_file_data(
	__FILE__,
	array(
		'Version'     => 'Version',
		'Plugin Name' => 'Plugin Name',
		'Author'      => 'Author',
		'Description' => 'Description',
		'Plugin URI'  => 'Plugin URI',
	),
	false
);

// Define Constants.
if ( ! defined( 'JLTCTWR' ) ) {
	define( 'JLTCTWR', $jltctwr_plugin_data['Plugin Name'] );
}

if ( ! defined( 'JLTCTWR_VER' ) ) {
	define( 'JLTCTWR_VER', $jltctwr_plugin_data['Version'] );
}

if ( ! defined( 'JLTCTWR_AUTHOR' ) ) {
	define( 'JLTCTWR_AUTHOR', $jltctwr_plugin_data['Author'] );
}

if ( ! defined( 'JLTCTWR_DESC' ) ) {
	define( 'JLTCTWR_DESC', $jltctwr_plugin_data['Author'] );
}

if ( ! defined( 'JLTCTWR_URI' ) ) {
	define( 'JLTCTWR_URI', $jltctwr_plugin_data['Plugin URI'] );
}

if ( ! defined( 'JLTCTWR_DIR' ) ) {
	define( 'JLTCTWR_DIR', __DIR__ );
}

if ( ! defined( 'JLTCTWR_FILE' ) ) {
	define( 'JLTCTWR_FILE', __FILE__ );
}

if ( ! defined( 'JLTCTWR_SLUG' ) ) {
	define( 'JLTCTWR_SLUG', dirname( plugin_basename( __FILE__ ) ) );
}

if ( ! defined( 'JLTCTWR_BASE' ) ) {
	define( 'JLTCTWR_BASE', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'JLTCTWR_PATH' ) ) {
	define( 'JLTCTWR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'JLTCTWR_URL' ) ) {
	define( 'JLTCTWR_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}

if ( ! defined( 'JLTCTWR_INC' ) ) {
	define( 'JLTCTWR_INC', JLTCTWR_PATH . '/Inc/' );
}

if ( ! defined( 'JLTCTWR_LIBS' ) ) {
	define( 'JLTCTWR_LIBS', JLTCTWR_PATH . 'Libs' );
}

if ( ! defined( 'JLTCTWR_ASSETS' ) ) {
	define( 'JLTCTWR_ASSETS', JLTCTWR_URL . 'assets/' );
}

if ( ! defined( 'JLTCTWR_IMAGES' ) ) {
	define( 'JLTCTWR_IMAGES', JLTCTWR_ASSETS . 'images' );
}

if ( ! class_exists( '\\JLTCTWR\\JLT_City_Weather_Report' ) ) {
	// Autoload Files.
	include_once JLTCTWR_DIR . '/vendor/autoload.php';
	// Instantiate JLT_City_Weather_Report Class.
	include_once JLTCTWR_DIR . '/class-wp-awesome-city-weather-report.php';
}