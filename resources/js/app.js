/**
 * Primary front-end script.
 *
 * Primary JavaScript file. Any includes or anything imported should
 * be filtered through this file and eventually saved back into the
 * `/dist/js/app.js` file.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

/**
 * A simple immediately-invoked function expression to kick-start
 * things and encapsulate our code.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
(function() {

	let menu   = document.querySelector( '.menu--primary' );
	let toggle = document.querySelector( '.toggle--menu-primary .toggle__button' );
	let burger = document.querySelector( '.toggle--menu-primary .toggle__hamburger' );
	let svg_x = document.querySelector( '.toggle--menu-primary .toggle__x' );

	if ( null !== menu && null !== toggle ) {

		toggle.onclick = () => {
			menu.classList.toggle( 'hidden' );
			burger.classList.toggle( 'hidden' );
			svg_x.classList.toggle( 'hidden' );
		}
	}

	let images = document.querySelectorAll( 'img' );

	images.forEach( function( image ) {
		let classes = image.classList;

		image.onload = function() {
			if ( ( classes.contains( 'alignleft' ) || classes.contains( 'alignright' ) ) && 300 >= image.naturalWidth ) {
				classes.add( 'is-small' );
			}
		}
	} );

	//let paras = document.querySelectorAll( 'p' );

	//paras.forEach( function( p ) {
	//	if ( 0 === p.clientHeight ) {
	//		p.classList.add( 'is-collapsed' );
	//	}
	//} );

})();
