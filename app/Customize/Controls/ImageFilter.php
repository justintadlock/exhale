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

use WP_Customize_Control;

/**
 * Multiple select customize control class.
 *
 * @since  1.0.0
 * @access public
 */
class ImageFilter extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'exhale-image-filter';

	/**
	 * Array of label strings for the various fields.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $l10n = [];

	/**
	 * Array of filter objects.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    array
	 */
	public $filters = [];

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$filters = [];

		foreach ( $this->filters as $filter ) {
			$filters[ $filter->name() ] = $filter->label();
		}

		$current_filter = $this->filters->get( $this->value( 'function' ) );

		$this->json['function'] = [
			'link'        => $this->get_link( 'function' ),
			'value'       => $this->value( 'function' ),
			'label'       => $this->l10n['function']['label'],
			'description' => $this->l10n['function']['description'],
			'choices'     => $filters
		];

		$this->json['default_amount'] = [
			'link'        => $this->get_link( 'default_amount' ),
			'value'       => $this->value( 'default_amount' ),
			'label'       => $this->l10n['default_amount']['label'],
			'description' => $this->l10n['default_amount']['description'],
			'min'         => $current_filter->min(),
			'max'         => $current_filter->max(),
			'lacuna'      => $current_filter->lacuna()
		];

		$this->json['hover_amount'] = [
			'link'        => $this->get_link( 'hover_amount' ),
			'value'       => $this->value( 'hover_amount' ),
			'label'       => $this->l10n['hover_amount']['label'],
			'description' => $this->l10n['hover_amount']['description'],
			'min'         => $current_filter->min(),
			'max'         => $current_filter->max(),
			'lacuna'      => $current_filter->lacuna()
		];
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function content_template() { ?>

		<# if ( data.function && data.function.choices ) { #>

			<p class="exhale-image-filter-function">

				<label>
					<# if ( data.function.label ) { #>
						<span class="customize-control-title">{{ data.function.label }}</span>
					<# } #>

					<# if ( data.function.description ) { #>
						<span class="description customize-control-description">{{{ data.function.description }}}</span>
					<# } #>

					<select {{{ data.function.link }}}>

						<# _.each( data.function.choices, function( label, choice ) { #>
							<option value="{{ choice }}" <# if ( choice === data.function.value ) { #> selected="selected" <# } #>>{{ label }}</option>
						<# } ) #>

					</select>
				</label>
			</p>

		<# } #>

		<# if ( data.default_amount ) { #>

			<p class="exhale-image-default-filter-amount">

				<label>
					<# if ( data.default_amount.label ) { #>
						<span class="customize-control-title">{{ data.default_amount.label }} (%)</span>
					<# } #>

					<# if ( data.default_amount.description ) { #>
						<span class="description customize-control-description">{{{ data.default_amount.description }}}</span>
					<# } #>

					<input type="number" step="10" min="{{{ data.default_amount.min }}}" max="{{{ data.default_amount.max }}}" {{{ data.default_amount.link }}} value="{{ data.default_amount.value }}" />
				</label>
			</p>

		<# } #>

		<# if ( data.hover_amount ) { #>

			<p class="exhale-image-hover-filter-amount">

				<label>
					<# if ( data.hover_amount.label ) { #>
						<span class="customize-control-title">{{ data.hover_amount.label }} (%)</span>
					<# } #>

					<# if ( data.hover_amount.description ) { #>
						<span class="description customize-control-description">{{{ data.hover_amount.description }}}</span>
					<# } #>

					<input type="number" step="10" min="{{{ data.hover_amount.min }}}" max="{{{ data.hover_amount.max }}}" {{{ data.hover_amount.link }}} value="{{ data.hover_amount.value }}" />
				</label>
			</p>

		<# } #>
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
