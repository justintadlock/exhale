<?php
/**
 * Font Settings Collection.
 *
 * Houses the collection of font settings in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Setting;

use Exhale\Tools\Collection;

/**
 * Font settings class.
 *
 * @since  1.3.0
 * @access public
 */
class Settings extends Collection {

	/**
	 * Adds a new font setting to the collection.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Setting( $name, $value ) );
	}
}
