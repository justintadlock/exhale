/**
 * Primary front-end script.
 *
 * Primary JavaScript file. Any includes or anything imported should
 * be filtered through this file and eventually saved back into the
 * `/dist/js/app.js` file.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
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

	let body       = document.body;
	let menu       = document.querySelector( '.menu--primary' );
	let menuButton = document.querySelector( '.menu--primary .menu__toggle' );

	menuButton.onclick = function menuToggle() {
		body.classList.toggle( 'menu-open' );
		menu.classList.toggle( 'is-open' );
		menuButton.classList.toggle( 'is-active' );
	};

	document.onclick = function closeMenuOutsideClick() {
		body.classList.remove( 'menu-open' );
		menu.classList.remove( 'is-open' );
		menuButton.classList.remove( 'is-active' );
	};

	menu.onclick = function clickInsideMenu( e ) {
		e.stopPropagation();
	};

	let blockquoteCite = document.querySelectorAll( 'blockquote > p > cite' );

	blockquoteCite.forEach( function( cite ) {
		cite.parentNode.classList.add( 'has-cite' );
	} );

	let images = document.querySelectorAll( 'img' );

	images.forEach( function( image ) {
		let classes = image.classList;

		image.onload = function() {
			if ( ( classes.contains( 'alignleft' ) || classes.contains( 'alignright' ) ) && 300 >= image.naturalWidth ) {
				classes.add( 'is-small' );
			}
		}
	} );

	let paras = document.querySelectorAll( 'p' );

	paras.forEach( function( p ) {
		if ( 0 === p.clientHeight ) {
			p.classList.add( 'is-collapsed' );
		}
	} );

})();
