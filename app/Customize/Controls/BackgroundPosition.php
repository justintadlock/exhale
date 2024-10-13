<?php
/**
 * CSS filter customize control.
 *
 * Creates a control that allows users to select a CSS filter and the amount to
 * apply by default and on hover/focus.
 *
 * @package   Hybrid
 * @link      https://github.com/justintadlock/hybrid-customize
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Customize\Controls;

use WP_Customize_Control;

/**
 * Multiple select customize control class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class BackgroundPosition extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access public
     */
    public $type = 'exhale-background-position';

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function to_json() {
        parent::to_json();

        $this->json['link']  = $this->get_link();
        $this->json['value'] = $this->value();
        $this->json['id']    = $this->id;

        $this->json['choices'] = [
            [
                'left-top'  => [
                    'icon'  => 'dashicons dashicons-arrow-left-alt',
                    'label' => __( 'Top Left', 'exhale' ),
                ],
                'right-top' => [
                    'icon'  => 'dashicons dashicons-arrow-right-alt',
                    'label' => __( 'Top Right', 'exhale' ),
                ],
                'top'       => [
                    'icon'  => 'dashicons dashicons-arrow-up-alt',
                    'label' => __( 'Top', 'exhale' ),
                ],
            ],
            [
                'center' => [
                    'icon'  => 'background-position-center-icon',
                    'label' => __( 'Center', 'exhale' ),
                ],
                'left'   => [
                    'icon'  => 'dashicons dashicons-arrow-left-alt',
                    'label' => __( 'Left', 'exhale' ),
                ],
                'right'  => [
                    'icon'  => 'dashicons dashicons-arrow-right-alt',
                    'label' => __( 'Right', 'exhale' ),
                ],
            ],
            [
                'bottom'       => [
                    'icon'  => 'dashicons dashicons-arrow-down-alt',
                    'label' => __( 'Bottom', 'exhale' ),
                ],
                'left-bottom'  => [
                    'icon'  => 'dashicons dashicons-arrow-left-alt',
                    'label' => __( 'Bottom Left', 'exhale' ),
                ],
                'right-bottom' => [
                    'icon'  => 'dashicons dashicons-arrow-right-alt',
                    'label' => __( 'Bottom Right', 'exhale' ),
                ],
            ],
        ];
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @since  1.0.0
     * @return void
     *
     * @access protected
     */
    protected function content_template() { ?>

        <# if ( data.label ) { #>
            <span class="customize-control-title">{{ data.label }}</span>
        <# } #>

        <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
        <# } #>

        <# if ( data.choices ) { #>

            <div class="customize-control-content">
                <div class="background-position-control">
                    <# _.each( data.choices, function( group ) { #>
                        <div class="button-group">
                            <# _.each( group, function( args, choice ) { #>
                                <label>
                                    <input type="radio" class="screen-reader-text" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice === data.value ) { #> checked="checked" <# } #> />
                                    <span class="button display-options position"><span class="{{ args.icon }}" aria-hidden="true"></span></span>
                                    <span class="screen-reader-text">{{ args.label }}</span>
                                </label>
                            <# } ) #>
                        </div>
                    <# } ) #>
                </div>
            </div>
        <# } #>

        <?php
    }

    /**
     * This is the PHP callback for rendering the control content. JS-based
     * controls require this method to be empty.
     *
     * @since  1.0.0
     * @return bool
     *
     * @access public
     */
    protected function render_content() {}

}
