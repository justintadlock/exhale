const path = require( 'node:path' );
const fse = require( 'fs-extra' );

/**
 * Copy items (files or folders) to the specified export path.
 * @param {string} exportPath - The path where items will be exported.
 * @param {object[]} items - List of items (files or folders) to be copied.
 */
async function copyItems( exportPath, items ) {
	for ( const { name, trimPath = null } of items ) {
		if ( await fse.pathExists( name ) ) {
			const destination = getDestinationPath( exportPath, name, trimPath );
			await fse.copy( name, destination, { filter: createFilter( name ) } );
			console.log( `${name} copied successfully to ${destination}` );
		}
	}
}

/**
 * Remove items (files or folders).
 * @param {string[]} itemsToRemove - List of items (files or folders) to be removed.
 */
async function removeItems( itemsToRemove ) {
	for ( const item of itemsToRemove ) {
		await removeItem( item );
	}
}

/**
 * Remove an item (file or folder).
 * @param {string} item - The item (file or folder) to be removed.
 */
async function removeItem( item ) {
	if ( await fse.pathExists( item ) ) {
		await fse.remove( item );
		console.log( `${item} removed successfully` );
	}
}

/**
 * Create a filter function to exclude the root folder name from the destination.
 * @param {string} itemName - Name of the item (file or folder).
 * @returns {Function} Filter function.
 */
function createFilter( itemName ) {
	return ( src ) => {
		const relativePath = path.relative( itemName, src );

		return !relativePath.startsWith( itemName );
	};
}

/**
 * Get the destination path considering the trim path.
 * @param {string} exportPath - The export path.
 * @param {string} itemName - Name of the item (file or folder).
 * @param {string|null} trimPath - The path to be trimmed from the item name.
 * @returns {string} Destination path.
 */
function getDestinationPath( exportPath, itemName, trimPath ) {
	if ( trimPath && itemName.startsWith( trimPath ) ) {
		return path.join( exportPath, itemName.substring( trimPath.length ) );
	}

	return path.join( exportPath, itemName );
}

module.exports = { copyItems, removeItems };
