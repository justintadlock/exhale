<?php
/**
 * View service provider.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\View;

use Exhale\Template\ErrorPage;
use Hybrid\Core\ServiceProvider;
use Hybrid\Theme\Facades\View;

/**
 * View service provider.
 */
class Provider extends ServiceProvider {

    /**
     * Boot.
     */
    public function boot() {
        // Adds error data for the 404 content template.
        // Passes in the `ErrorPage` object as the `$error` variable.
        View::composer( 'content.404', static function ( $view ) {
            $view->with(
                'error_page',
                new ErrorPage()
            );
        } );
    }

}
