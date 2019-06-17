<?php
/**
 * CSS filter customize control.
 *
 * Creates a control that allows users to select a CSS filter and the amount to
 * apply by default and on hover/focus.
 *
 * @package   Hybrid
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2018, Justin Tadlock
 * @link      https://github.com/justintadlock/hybrid-customize
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Customize\Controls;

use WP_Customize_Manager;
use WP_Customize_Control;

/**
 * Multiple select customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class Font extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'exhale-font';

	/**
	 * Font family sub-control options.
	 *
	 * @since  1.3.0
	 * @access public
	 * @var    array
	 */
	public $family = [];

	/**
	 * Font style sub-control options.
	 *
	 * @since  1.3.0
	 * @access public
	 * @var    array
	 */
	public $style = [];

	/**
	 * Font variant caps sub-control options.
	 *
	 * @since  1.3.0
	 * @access public
	 * @var    array
	 */
	public $caps = [];

	/**
	 * Text transform sub-control options.
	 *
	 * @since  1.3.0
	 * @access public
	 * @var    array
	 */
	public $transform = [];

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		if ( $this->family ) {
			$this->json['family'] = wp_parse_args( $this->family, [
				'link'    => $this->get_link( 'family' ),
				'value'   => $this->value( 'family' ),
				'label'   => __( 'Family', 'exhale' ),
				'choices' => $this->family['choices']
			] );
		}

		if ( $this->style ) {
			$this->json['style'] = wp_parse_args( $this->style, [
				'link'    => $this->get_link( 'style' ),
				'value'   => $this->value( 'style' ),
				'label'   => __( 'Style', 'exhale' ),
				'choices' => $this->style['choices']
			] );
		}

		if ( $this->caps ) {
			$this->json['caps'] = wp_parse_args( $this->caps, [
				'link'    => $this->get_link( 'caps' ),
				'value'   => $this->value( 'caps' ),
				'label'   => __( 'Variant: Caps', 'exhale' ),
				'choices' => $this->caps['choices']
			] );
		}

		if ( $this->transform ) {
			$this->json['transform'] = wp_parse_args( $this->transform, [
				'link'    => $this->get_link( 'transform' ),
				'value'   => $this->value( 'transform' ),
				'label'   => __( 'Text Transform', 'exhale' ),
				'choices' => $this->transform['choices']
			] );
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
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
	<?php }

	/**
	 * This is the PHP callback for rendering the control content. JS-based
	 * controls require this method to be empty.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	protected function render_content() {}
}
