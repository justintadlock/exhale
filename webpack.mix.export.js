/**
 * Theme Export Script
 *
 * Exports the production-ready theme with only the files and folders needed for
 * uploading to a site or zipping. Edit the `files` or `folders` variables if
 * you need to change something.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @link      https://themehybrid.com/themes/exhale
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

// Import required packages.
const mix = require( 'laravel-mix' );

const {
	copyItems,
	removeItems,
} = require( './bin-dev/copy/fileUtils' );

// Folder name to export the files to.
const exportPath = 'exhale';

// Theme root-level files to include.
const files = [
	{ name: 'style.css' },
	{ name: 'changelog.md' },
	{ name: 'functions.php' },
	{ name: 'index.php' },
	{ name: 'license.md' },
	{ name: 'readme.md' },
	{ name: 'screenshot.png' },
];

// Folders to include.
const folders = [
	{ name: 'app' },
	{ name: 'config' },
	{ name: 'public' },
	// { name: 'resources/js' }, // Required for WordPress.org theme review.
	// { name: 'resources/scss' }, // Required for WordPress.org theme review.
	{ name: 'vendor' },
];

// Delete unnecessary files and folders.
const deleteFiles = [
	'mix-manifest.json',
	`${exportPath}/vendor/bin`,
	`${exportPath}/vendor/composer/installers`,
];

// Run tasks sequentially.
async function runTasks() {
	try {
		await copyItems( exportPath, files );
		await copyItems( exportPath, folders );
		await removeItems( deleteFiles );
	}
 catch ( error ) {
		console.error( 'An error occurred:', error );
	}
}

runTasks();
