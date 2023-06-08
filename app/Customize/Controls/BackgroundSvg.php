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
class BackgroundSvg extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'exhale-background-svg';

	public $svgs;

	public $background;

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;
		$this->json['background'] = maybe_hash_hex_color( $this->background );

		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
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

			<div class="wp-tab-panel svg-background-panel">
				<ul>
					<li class="svg-background">
						<label>
							<input type="radio" value="" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( ! data.value ) { #> checked="checked" <# } #> />
							<?php esc_html_e( 'None', 'exhale' ) ?>
							<div data-svg="" class="svg-background__block" style="background-color: {{ data.background }};"></div>
						</label>
					</li>

					<# _.each( data.choices, function( args, choice ) { #>
						<li class="svg-background">
							<label>
								<input type="radio" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice === data.value ) { #> checked="checked" <# } #> />
								{{ args.label }}
								<div data-svg="{{ choice }}" class="svg-background__block" style="background-color: {{ data.background }}; background-image: {{ args.cssValue }};"></div>
							</label>
						</li>
					<# } ) #>
				</ul>
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
