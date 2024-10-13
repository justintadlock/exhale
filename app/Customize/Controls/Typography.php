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
 * @since  2.0.0
 *
 * @access public
 */
class Typography extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access public
     */
    public $type = 'exhale-typography';

    /**
     * Font family sub-control options.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access public
     */
    public $family = [];

    /**
     * Font style sub-control options.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access public
     */
    public $style = [];

    /**
     * Font variant caps sub-control options.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access public
     */
    public $caps = [];

    /**
     * Text transform sub-control options.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access public
     */
    public $transform = [];

    /**
     * Add custom parameters to pass to the JS via JSON.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function to_json() {
        parent::to_json();

        if ( $this->family ) {
            $this->json['family'] = wp_parse_args( $this->family, [
                'choices' => $this->family['choices'],
                'label'   => __( 'Font Family', 'exhale' ),
                'link'    => $this->get_link( 'family' ),
                'value'   => $this->value( 'family' ),
            ] );
        }

        if ( $this->style ) {
            $this->json['style'] = wp_parse_args( $this->style, [
                'choices' => $this->style['choices'],
                'label'   => __( 'Font Style', 'exhale' ),
                'link'    => $this->get_link( 'style' ),
                'value'   => $this->value( 'style' ),
            ] );
        }

        if ( $this->caps ) {
            $this->json['caps'] = wp_parse_args( $this->caps, [
                'choices' => $this->caps['choices'],
                'label'   => __( 'Font Variant: Caps', 'exhale' ),
                'link'    => $this->get_link( 'caps' ),
                'value'   => $this->value( 'caps' ),
            ] );
        }

        if ( $this->transform ) {
            $this->json['transform'] = wp_parse_args( $this->transform, [
                'choices' => $this->transform['choices'],
                'label'   => __( 'Text Transform', 'exhale' ),
                'link'    => $this->get_link( 'transform' ),
                'value'   => $this->value( 'transform' ),
            ] );
        }
    }

    /**
     * Underscore JS template to handle the control's output.
     *
     * @since  2.0.0
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

        <ul>

        <# if ( data.family && data.family.choices ) { #>

            <li class="typography-font-family">

                <# if ( data.family.label ) { #>
                    <span class="customize-control-title">{{ data.family.label }}</span>
                <# } #>

                <select {{{ data.family.link }}}>

                    <# _.each( data.family.choices, function( group ) { #>

                        <optgroup label="{{ group.label }}">

                            <# _.each( group.choices, function( label, choice ) { #>

                                <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                            <# } ) #>

                        </optgroup>

                    <# } ) #>

                </select>
            </li>
        <# } #>

        <# if ( data.style && data.style.choices ) { #>

            <li class="typography-font-style">

                <# if ( data.style.label ) { #>
                    <span class="customize-control-title">{{ data.style.label }}</span>
                <# } #>

                <select {{{ data.style.link }}}>

                    <# _.each( data.style.choices, function( label, choice ) { #>

                        <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                    <# } ) #>

                </select>
            </li>
        <# } #>

        <# if ( data.caps && data.caps.choices ) { #>

            <li class="typography-text-caps">

                <# if ( data.caps.label ) { #>
                    <span class="customize-control-title">{{ data.caps.label }}</span>
                <# } #>

                <select {{{ data.caps.link }}}>

                    <# _.each( data.caps.choices, function( label, choice ) { #>

                        <option value="{{ choice }}" <# if ( choice === data.caps.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                    <# } ) #>

                </select>
            </li>
        <# } #>

        <# if ( data.transform && data.transform.choices ) { #>

            <li class="typography-text-transform">

                <# if ( data.transform.label ) { #>
                    <span class="customize-control-title">{{ data.transform.label }}</span>
                <# } #>

                <select {{{ data.transform.link }}}>

                    <# _.each( data.transform.choices, function( label, choice ) { #>

                        <option value="{{ choice }}" <# if ( choice === data.transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                    <# } ) #>

                </select>
            </li>
        <# } #>

        </ul>
        <?php
    }

    /**
     * This is the PHP callback for rendering the control content. JS-based
     * controls require this method to be empty.
     *
     * @since  2.0.0
     * @return bool
     *
     * @access public
     */
    protected function render_content() {}

}
