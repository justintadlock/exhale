<?php
/**
 * Theme bootstrap file.
 *
 * This file is used to create a new application instance and bind items to the
 * container. This is the heart of the application.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

# ------------------------------------------------------------------------------
# Create a new application.
# ------------------------------------------------------------------------------
#
# Creates the one true instance of the Hybrid Core application. You may access
# this instance via the `\Hybrid\app()` function or `\Hybrid\App` static class
# after the application has booted.

$exhale = new \Hybrid\Core\Application();

# ------------------------------------------------------------------------------
# Register service providers with the application.
# ------------------------------------------------------------------------------
#
# Before booting the application, add any service providers that are necessary
# for running the theme. Service providers are essentially the backbone of the
# bootstrapping process.

$exhale->provider( \Exhale\Provider::class            );
$exhale->provider( \Exhale\Block\Provider::class      );
$exhale->provider( \Exhale\CleanWP\Provider::class    );
$exhale->provider( \Exhale\Color\Provider::class      );
$exhale->provider( \Exhale\Customize\Provider::class  );
$exhale->provider( \Exhale\Editor\Provider::class     );
$exhale->provider( \Exhale\Image\Provider::class      );
$exhale->provider( \Exhale\Settings\Provider::class   );
$exhale->provider( \Exhale\Typography\Provider::class );

$exhale->provider( \Exhale\Template\BlockHierarchyServiceProvider::class );

# ------------------------------------------------------------------------------
# Perform bootstrap actions.
# ------------------------------------------------------------------------------
#
# Creates an action hook for child themes (or even plugins) to hook into the
# bootstrapping process and add their own bindings before the app is booted by
# passing the application instance to the action callback.

do_action( 'exhale/bootstrap', $exhale );

# ------------------------------------------------------------------------------
# Bootstrap the application.
# ------------------------------------------------------------------------------
#
# Calls the application `boot()` method, which launches the application. Pat
# yourself on the back for a job well done.

$exhale->boot();
