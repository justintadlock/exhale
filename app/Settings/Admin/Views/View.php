<?php
/**
 * Settings View Base.
 *
 * Abstract base class for creating views.
 *
 * @package    Exhale
 * @link       https://themehybrid.com/plugins/members
 *
 * @subpackage Admin
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  2023 Justin Tadlock
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Settings\Admin\Views;

/**
 * View class.
 *
 * @since  1.0.0
 *
 * @access public
 */
abstract class View {

    /**
     * Returns the view name/ID.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    abstract public function name();

    /**
     * Returns the internationalized, human-readable view label.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    abstract public function label();

    /**
     * Called on the `admin_init` hook and should be used to register theme
     * settings via the Settings API.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {}

    /**
     * Called on the `load-{$page}` hook when the view is booted. Use this
     * to add any actions or filters needed.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {}

    /**
     * Called when the page's HTML is output for the view.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function template() {}

}
