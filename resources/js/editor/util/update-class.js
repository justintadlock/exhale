/**
 * Replace Class Utility Function.
 *
 * Updates an HTML class name.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

const TokenList = wp.tokenList;

/**
 * Helper function for updating class names.
 *
 * @since  2.1.0
 * @access public
 * @param  string  className  HTML class name.
 * @param  string  add        New class to add.
 * @param  array   remove     Old classes to remove.
 * @return string
 */
export default ( className, add, remove = [] ) => {

	const list = new TokenList( className );

	// If there are classes to remove, loop through the list and remove them
	// if they exist in the class name.
	if ( 0 !== remove.length ) {

		list.forEach( ( oldClassName ) => {

			if ( remove.includes( oldClassName ) ) {
				list.remove( oldClassName );
			}
		} );
	}

	// If there's a new class name, add it.
	if ( add ) {
		list.add( add );
	}

	// Return the class string.
	return list.value;
};
