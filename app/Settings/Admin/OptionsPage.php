<?php
/**
 * Options Page Class.
 *
 * Displays the theme settings page in the admin.
 *
 * @package    Exhale
 * @link       https://themehybrid.com/plugins/members
 *
 * @subpackage Admin
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  2023 Justin Tadlock
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Settings\Admin;

use Hybrid\Contracts\Bootable;

/**
 * Options page class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class OptionsPage implements Bootable {

    /**
     * Settings page name/slug.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Collection of views to display.
     *
     * @since  1.0.0
     * @var    \Exhale\Settings\Admin\Views\Views
     *
     * @access protected
     */
    protected $views;

    /**
     * Internationalized text label for the page.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label = '';

    /**
     * Required capability for accessing the page.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $capability = 'edit_theme_options';

    /**
     * The settings page defined by WordPress.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $page = '';

    /**
     * Creates the settings page object.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  array  $args
     * @return void
     *
     * @access public
     */
    public function __construct( $name, Views\Views $views, array $args = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

            if ( isset( $args[ $key ] ) ) {
                $this->$key = $args[ $key ];
            }
        }

        $this->name  = $name;
        $this->views = $views;
    }

    /**
     * Bootstraps the options page.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        add_action( 'admin_menu', [ $this, 'adminMenu' ] );
    }

    /**
     * Adds the settings page to WordPress.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function adminMenu() {

        $this->page = add_theme_page(
            esc_html( $this->label ),
            esc_html( $this->label ),
            $this->capability,
            $this->name,
            [ $this, 'template' ]
        );

        if ( $this->page ) {

            add_action( 'admin_init', [ $this, 'init' ] );
            add_action( "load-{$this->page}", [ $this, 'load' ] );
        }
    }

    /**
     * Called on `admin_init` to register views.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function init() {

        $this->views->add( 'general', Views\General::class );
        $this->views->add( 'themes', Views\Themes::class );

        $this->registerViews();
    }

    /**
     * Called on `load-{$this->page}`. Primarily for booting the current view.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function load() {

        // Print custom styles.
        add_action( 'admin_head', array( $this, 'print_styles' ) );

        // Get the current view and boot it.
        $view = $this->currentView();

        if ( $view ) {
            $this->bootView( $view );
        }
    }

    /**
     * Print styles to the header.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function print_styles() { ?>

        <style type="text/css">
            <?php
            printf(
                '.appearance_page_%1$s .wp-filter { margin-bottom: 15px; }
				 .appearance_page_%1$s .theme-browser .theme:hover,
				 .appearance_page_%1$s .theme-browser .theme:focus { cursor: auto; }',
                esc_html( $this->name )
            )
            ?>
        </style>
        <?php
    }

    /**
     * Outputs the settings page to the screen.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function template() {
        ?>

        <div class="wrap">
            <h1 class="wp-heading-inline"><?php echo esc_html( $this->label ); ?></h1>

            <?php if ( current_user_can( 'customize' ) ) : ?>
                <a href="<?php echo esc_url( wp_customize_url() ); ?>" class="hide-if-no-js page-title-action"><?php esc_html_e( 'Customize', 'exhale' ); ?></a>
            <?php endif ?>

            <div class="wp-filter">
                <?php $this->filterLinks(); ?>
            </div>

            <?php $this->currentView()->template(); ?>
        </div><!-- wrap -->
        <?php
    }

    /**
     * Displays the filter links (tabs) bar at the top of the page.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    protected function filterLinks() {
        ?>

        <ul class="filter-links">

            <?php
            foreach ( $this->views as $view ) :

                // Get the URL.
                $url = admin_url( 'themes.php' );

                $url = add_query_arg( [
                    'page' => $this->name,
                    'view' => $view->name(),
                ], $url );

                if ( 'general' === $view->name() ) :
                    $url = remove_query_arg( 'view', $url );
                endif;
                ?>

                <li class="<?php echo sanitize_html_class( $view->name() ); ?>">
                    <?php
                    printf(
                        '<a href="%s"%s>%s</a>',
                        esc_url( $url ),
                        $view->name() === $this->currentView()->name() ? ' class="current"' : '',
                        esc_html( $view->label() )
                    )
                    ?>
                </li>

            <?php endforeach ?>

        </ul>
        <?php
    }

    /**
     * Adds a view.
     *
     * @since  1.0.0
     * @param  string|object $view
     * @return void
     *
     * @access public
     */
    public function addView( $view ) {

        if ( is_string( $view ) ) {
            $view = $this->resolveView( $view );
        }

        $this->views[ $view->name() ] = $view;
    }

    /**
     * Resolves a view in the case that it is a string and not an object.
     *
     * @since  1.0.0
     * @param  string
     * @return \Exhale\Settings\Admin\Views\View
     *
     * @access public
     */
    protected function resolveView( $view ) {
        return new $view( $this );
    }

    /**
     * Calls a view's `register()` method.
     *
     * @since  1.0.0
     * @param  \Exhale\Settings\Admin\Views\View $view
     * @return void
     *
     * @access public
     */
    protected function registerView( $view ) {

        if ( method_exists( $view, 'register' ) ) {
            $view->register();
        }
    }

    /**
     * Calls a view's `boot()` method.
     *
     * @since  1.0.0
     * @param  \Exhale\Settings\Admin\Views\View $view
     * @return void
     *
     * @access public
     */
    protected function bootView( $view ) {

        if ( method_exists( $view, 'boot' ) ) {
            $view->boot();
        }
    }

    /**
     * Returns the collection of views.
     *
     * @since  1.0.0
     * @return \Exhale\Settings\Admin\Views\Views
     *
     * @access public
     */
    protected function getViews() {

        return $this->views;
    }

    /**
     * Registers all views.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    protected function registerViews() {

        foreach ( $this->views as $view ) {
            $this->registerView( $view );
        }
    }

    /**
     * Boots all views.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    protected function bootViews() {

        foreach ( $this->views as $view ) {
            $this->bootView( $view );
        }
    }

    /**
     * Returns the current view object or `null`.
     *
     * @since  1.0.0
     * @return \Exhale\Settings\Admin\Views\View|null
     *
     * @access public
     */
    public function currentView() {

        $current = isset( $_GET['view'] ) ? sanitize_key( $_GET['view'] ) : 'general';

        if ( isset( $this->views[ $current ] ) ) {
            return $this->views[ $current ];
        }

        return null;
    }

}
