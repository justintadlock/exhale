<?php
/**
 * CSS filter customize control.
 *
 * Creates a control that allows users to select a CSS filter and the amount to
 * apply by default and on hover/focus.
 *
 * @package   Hybrid
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
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
class BackgroundPosition extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'exhale-background-position';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;

		$this->json['choices'] = [
			[
				'left-top' => [
					'label' => __( 'Top Left', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-left-alt'
				],
				'top' => [
					'label' => __( 'Top', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-up-alt'
				],
				'right-top'  => [
					'label' => __( 'Top Right', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-right-alt'
				]
			],
			[
				'left'   => [
					'label' => __( 'Left', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-left-alt'
				],
				'center' => [
					'label' => __( 'Center', 'exhale' ),
					'icon'  => 'background-position-center-icon'
				],
				'right'  => [
					'label' => __( 'Right', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-right-alt'
				]
			],
			[
				'left-bottom'   => [
					'label' => __( 'Bottom Left', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-left-alt'
				],
				'bottom' => [
					'label' => __( 'Bottom', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-down-alt'
				],
				'right-bottom'  => [
					'label' => __( 'Bottom Right', 'exhale' ),
					'icon'  => 'dashicons dashicons-arrow-right-alt'
				]
			]
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
