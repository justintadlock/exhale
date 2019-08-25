<?php
/**
 * Helper functions.
 *
 * This file holds various helper functions needed in the theme.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\App;

/**
 * Handles back-compat for the `custom-background` feature color.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_color_compat() {
	$compat = App::resolve( 'exhale/compat/background' );
	$color  = get_theme_mod( 'background_color', $compat['default-color'] );

	return $color ?: 'f3f3f3';
}

/**
 * Handles back-compat for the `custom-background` feature image.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_image_compat() {
	$compat = App::resolve( 'exhale/compat/background' );
	$image  = get_theme_mod( 'background_image', $compat['default-image'] );

	return $image ?: '';
}

/**
 * Handles back-compat for the `custom-background` feature attachment.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_attachment_compat() {
	$compat     = App::resolve( 'exhale/compat/background' );
	$attachment = get_theme_mod( 'background_attachment', $compat['default-attachment'] );

	return in_array( $attachment, [ 'scroll', 'fixed' ], true ) ? $attachment : 'scroll';
}

/**
 * Handles back-compat for the `custom-background` feature size.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_size_compat() {
	$compat = App::resolve( 'exhale/compat/background' );
	$size   = get_theme_mod( 'background_size', $compat['default-size'] );

	return in_array( $size, [ 'auto', 'contain', 'cover' ], true ) ? $size : 'auto';
}

/**
 * Handles back-compat for the `custom-background` feature repeat.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_repeat_compat() {
	$compat = App::resolve( 'exhale/compat/background' );
	$repeat = get_theme_mod( 'background_repeat', $compat['default-repeat'] );

	return in_array( $repeat, [ 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ], true ) ? $repeat : 'repeat';
}

/**
 * Handles back-compat for the `custom-background` feature position.
 *
 * @since  2.2.0
 * @access public
 * @return string
 */
function body_bg_position_compat() {
	$compat     = App::resolve( 'exhale/compat/background' );
	$position_x = get_theme_mod( 'background_position_x', $compat['default-position-x'] );
	$position_y = get_theme_mod( 'background_position_y', $compat['default-position-y'] );

	$position = 'center';

	if ( 'center' === $position_x && 'bottom' === $position_y ) {
		$position = 'bottom';
	} elseif ( 'left' === $position_x && 'center' === $position_y ) {
		$position = 'left';
	} elseif ( 'left' === $position_x && 'bottom' === $position_y ) {
		$position = 'left-bottom';
	} elseif ( 'left' === $position_x && 'top' === $position_y ) {
		$position = 'left-top';
	} elseif ( 'right' === $position_x && 'center' === $position_y ) {
		$position = 'right';
	} elseif ( 'right' === $position_x && 'bottom' === $position_y ) {
		$position = 'right-bottom';
	} elseif ( 'right' === $position_x && 'top' === $position_y ) {
		$position = 'right-top';
	} elseif ( 'center' === $position_x && 'top' === $position_y ) {
		$position = 'top';
	}

	return $position;
}
