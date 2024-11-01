<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @version       1.0.0
 * @package       JLT_City_Weather_Report
 * @license       Copyright JLT_City_Weather_Report
 */

if ( ! function_exists( 'jltctwr_option' ) ) {
	/**
	 * Get setting database option
	 *
	 * @param string $section default section name jltctwr_general .
	 * @param string $key .
	 * @param string $default .
	 *
	 * @return string
	 */
	function jltctwr_option( $section = 'jltctwr_general', $key = '', $default = '' ) {
		$settings = get_option( $section );

		return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
	}
}

if ( ! function_exists( 'jltctwr_exclude_pages' ) ) {
	/**
	 * Get exclude pages setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltctwr_exclude_pages() {
		return jltctwr_option( 'jltctwr_triggers', 'exclude_pages', array() );
	}
}

if ( ! function_exists( 'jltctwr_exclude_pages' ) ) {
	/**
	 * Get exclude pages except setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltctwr_exclude_pages_except() {
		return jltctwr_option( 'jltctwr_triggers', 'exclude_pages_except', array() );
	}
}