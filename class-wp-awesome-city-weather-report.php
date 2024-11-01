<?php
namespace JLTCTWR;

use JLTCTWR\Libs\Assets;
use JLTCTWR\Libs\Helper;
use JLTCTWR\Libs\Featured;
use JLTCTWR\Inc\Classes\City_Weather_Report;
use JLTCTWR\Inc\Classes\Recommended_Plugins;
use JLTCTWR\Inc\Classes\Notifications\Notifications;
use JLTCTWR\Inc\Classes\Pro_Upgrade;
use JLTCTWR\Inc\Classes\Row_Links;
use JLTCTWR\Inc\Classes\Upgrade_Plugin;
use JLTCTWR\Inc\Classes\Feedback;

/**
 * Main Class
 *
 * @wp-awesome-city-weather-report
 * Jewel Theme <support@jeweltheme.com>
 * @version     1.0.4
 */

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * JLT_City_Weather_Report Class
 */
if ( ! class_exists( '\JLTCTWR\JLT_City_Weather_Report' ) ) {

	/**
	 * Class: JLT_City_Weather_Report
	 */
	final class JLT_City_Weather_Report {

		const VERSION            = JLTCTWR_VER;
		private static $instance = null;

		/**
		 * what we collect construct method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			$this->includes();
			add_action( 'plugins_loaded', array( $this, 'jltctwr_plugins_loaded' ), 999 );
			// Body Class.
			add_filter( 'admin_body_class', array( $this, 'jltctwr_body_class' ) );
			// This should run earlier .
			// add_action( 'plugins_loaded', [ $this, 'jltctwr_maybe_run_upgrades' ], -100 ); .
			add_action('widgets_init', array( $this, 'register_city_weather_report' ) );
		}

		/**
		 * plugins_loaded method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltctwr_plugins_loaded() {
			$this->jltctwr_activate();
		}


		/**
		 * Register Widget
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		function register_city_weather_report(){
			$wether_report = new City_Weather_Report();
			register_widget($wether_report);
		}


		/**
		 * Version Key
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function plugin_version_key() {
			return Helper::jltctwr_slug_cleanup() . '_version';
		}

		/**
		 * Activation Hook
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function jltctwr_activate() {
			$current_jltctwr_version = get_option( self::plugin_version_key(), null );

			if ( get_option( 'jltctwr_activation_time' ) === false ) {
				update_option( 'jltctwr_activation_time', strtotime( 'now' ) );
			}

			if ( is_null( $current_jltctwr_version ) ) {
				update_option( self::plugin_version_key(), self::VERSION );
			}

			$allowed = get_option( Helper::jltctwr_slug_cleanup() . '_allow_tracking', 'no' );

			// if it wasn't allowed before, do nothing .
			if ( 'yes' !== $allowed ) {
				return;
			}
			// re-schedule and delete the last sent time so we could force send again .
			$hook_name = Helper::jltctwr_slug_cleanup() . '_tracker_send_event';
			if ( ! wp_next_scheduled( $hook_name ) ) {
				wp_schedule_event( time(), 'weekly', $hook_name );
			}
		}


		/**
		 * Add Body Class
		 *
		 * @param [type] $classes .
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltctwr_body_class( $classes ) {
			$classes .= ' wp-awesome-city-weather-report ';
			return $classes;
		}

		/**
		 * Run Upgrader Class
		 *
		 * @return void
		 */
		public function jltctwr_maybe_run_upgrades() {
			if ( ! is_admin() && ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Run Upgrader .
			$upgrade = new Upgrade_Plugin();

			// Need to work on Upgrade Class .
			if ( $upgrade->if_updates_available() ) {
				$upgrade->run_updates();
			}
		}

		/**
		 * Include methods
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function includes() {
			new Assets();
			new Recommended_Plugins();
			new Row_Links();
			new Pro_Upgrade();
			new Notifications();
			new Featured();
			new Feedback();
		}


		/**
		 * Initialization
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltctwr_init() {
			$this->jltctwr_load_textdomain();
		}


		/**
		 * Text Domain
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltctwr_load_textdomain() {
			$domain = 'wp-awesome-city-weather-report';
			$locale = apply_filters( 'jltctwr_plugin_locale', get_locale(), $domain );

			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, false, dirname( JLTCTWR_BASE ) . '/languages/' );
		}
		
		
		

		/**
		 * Returns the singleton instance of the class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof JLT_City_Weather_Report ) ) {
				self::$instance = new JLT_City_Weather_Report();
				self::$instance->jltctwr_init();
			}

			return self::$instance;
		}
	}

	// Get Instant of JLT_City_Weather_Report Class .
	JLT_City_Weather_Report::get_instance();
}