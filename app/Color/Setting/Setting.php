<?php
/**
 * Customize Color.
 *
 * Creates a customize color object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Color\Setting;

use Closure;
use Exhale\Contracts\CssCustomProperty;
use JsonSerializable;
use function Hybrid\Theme\hex_to_rgb;

/**
 * Customize color class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Setting implements JsonSerializable, CssCustomProperty {

    /**
     * Color name.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Color label.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * Color description.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $description = '';

    /**
     * Color default (hex).
     *
     * @since  1.0.0
     * @var    string|\Closure
     *
     * @access protected
     */
    protected $color = '000000';

    /**
     * Whether the setting should appear in the block editor.
     *
     * @since  1.0.0
     * @var    bool
     *
     * @access protected
     */
    protected $is_editor_color = false;

    protected $section = 'colors';

    /**
     * Set up the object properties.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  array  $options
     * @return void
     *
     * @access public
     */
    public function __construct( $name, array $options = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $options[ $key ] ) ) {
                $this->$key = $options[ $key ];
            }
        }

        $this->name = $name;
    }

    /**
     * Returns a JSON-ready array of only the properties we'll need for use
     * in the customize-preview JS.
     *
     * @since  1.0.0
     * @return array
     *
     * @access public
     */
    public function jsonSerialize() {

        return [
            'modName'  => $this->modName(),
            'property' => $this->cssProperty(),
        ];
    }

    /**
     * Returns the setting name.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the setting label.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return apply_filters(
            "exhale/color/setting/{$this->name}/label",
            $this->label ?: $this->name(),
            $this
        );
    }

    /**
     * Returns the setting name as a theme mod.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function modName() {
        return sprintf( 'color_%s', str_replace( '-', '_', $this->name() ) );
    }

    /**
     * Returns the setting description.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function description() {
        return $this->description;
    }

    public function section() {
        return $this->section ?: 'colors';
    }

    /**
     * Returns the default setting value.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function color() {

        $color = $this->color instanceof Closure
                ? $this->color()
            : $this->color;

        return apply_filters( "exhale/color/setting/{$this->name}/default", $color, $this );
    }

    /**
     * Returns the theme mod for the setting.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function mod() {
        return get_theme_mod( $this->modName(), $this->color() );
    }

    /**
     * Returns the hex color code of the setting value.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function hex() {
        return maybe_hash_hex_color( $this->mod() );
    }

    /**
     * Returns an array (`r`, `g`, `b`, keys) of the setting value in RGB.
     *
     * @since  1.0.0
     * @return array
     *
     * @access public
     */
    public function rgb() {
        return hex_to_rgb( $this->mod() );
    }

    /**
     * Returns whether the setting should be shown in the block editor.
     *
     * @since  1.0.0
     * @return bool
     *
     * @access public
     */
    public function isEditorColor() {
        return $this->is_editor_color;
    }

    /**
     * Returns a valid CSS selector for the property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssSelector() {
        return ':root';
    }

    /**
     * Returns the CSS property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssProperty() {
        return sprintf( '--color-%s', $this->name() );
    }

    /**
     * Returns the CSS property value.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssValue() {
        return $this->hex() ?: 'transparent';
    }

    /**
     * Returns the CSS custom property selector for the setting name.
     *
     * @since      1.0.0
     * @return     string
     * @deprecated 1.1.0
     *
     * @access     public
     */
    public function property() {
        return $this->cssProperty();
    }

}
