<?php
/**
 * Font Size Component.
 *
 * Manages the font size component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Editor\Font\Size;

use Exhale\Tools\Config;
use Hybrid\Contracts\Bootable;

/**
 * Font size component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the font size object.
     *
     * @since  2.0.0
     * @var    \Exhale\Editor\Font\Size\Sizes
     *
     * @access protected
     */
    protected $sizes;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Sizes $sizes ) {
        $this->sizes = $sizes;
    }

    /**
     * Bootstraps the component.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {

        // Run registration on `after_setup_theme`.
        add_action( 'after_setup_theme', [ $this, 'register' ], 5 );

        // Register default sizes and choices.
        add_action( 'exhale/editor/font/size/register', [ $this, 'registerDefaultSizes' ] );
    }

    /**
     * Runs the register actions.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        do_action( 'exhale/editor/font/size/register', $this->sizes );

        $_sizes = [];

        foreach ( $this->sizes as $size ) {
            $_sizes[] = [
                'name' => $size->label(),
                'size' => $size->size(),
                'slug' => $size->name(),
            ];
        }

        add_theme_support( 'editor-font-sizes', $_sizes );
    }

    /**
     * Registers default sizes.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function registerDefaultSizes( Sizes $sizes ) {

        // Back-compat with child themes that registered a config of
        // `config/font-sizes.php` pre-2.0.
        $config = is_child_theme() ? Config::get( 'font-sizes' ) : [];

        $config = $config ?: Config::get( 'editor-font-sizes' );

        foreach ( $config as $name => $options ) {
            $sizes->add( $name, $options );
        }
    }

}
