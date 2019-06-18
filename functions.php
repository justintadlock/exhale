<?php
/**
 * Theme functions file.
 *
 * This file is used to bootstrap the theme.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

# ------------------------------------------------------------------------------
# Compatibility check.
# ------------------------------------------------------------------------------
#
# Check that the site meets the minimum requirements for the theme before
# proceeding if this is a theme for public release. If building for a client
# that meets these requirements, this code is unnecessary.

if ( version_compare( $GLOBALS['wp_version'], '5.2', '<' ) || version_compare( PHP_VERSION, '5.6', '<' ) ) {

	require_once( get_parent_theme_file_path( 'app/bootstrap-compat.php' ) );
	return;
}

# ------------------------------------------------------------------------------
# Bootstrap the theme.
# ------------------------------------------------------------------------------
#
# Load the bootstrap files. Note that autoloading should happen first so that
# any classes/functions are available that we might need.

require_once( get_parent_theme_file_path( 'app/bootstrap-autoload.php' ) );
require_once( get_parent_theme_file_path( 'app/bootstrap-app.php'      ) );
