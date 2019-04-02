<?php
/**
 * Image Sizes Collection.
 *
 * Houses the collection of image sizes in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Size;

use Hybrid\Tools\Collection;

/**
 * Image sizes class.
 *
 * @since  1.0.0
 * @access public
 */
class Sizes extends Collection {

	/**
	 * Adds a new image size to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Size( $name, $value ) );
	}

	public function customizeChoices() {

		$choices = [];

		foreach ( $this->all() as $size ) {

			if ( $size->isFeaturedSize() ) {
				$choices[ $size->name() ] = sprintf(
					// Translators: 1 is image size name, 2 is image size width, and 3 is image size height.
					esc_html__( '%1$s - %2$s&times;%3$s', 'exhale' ),
					$size->label(),
					$size->width(),
					$size->height()
				);
			}
		}

		return $choices;
	}
}
