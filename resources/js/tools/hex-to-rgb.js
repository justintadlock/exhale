
export function hexToRgb( str ) {

	let pattern = /^#?(?:([\da-f]{3})[\da-f]?|([\da-f]{6})(?:[\da-f]{2})?)$/i;

	let [ , short, long ] = String( str ).match( pattern ) || [];

	if ( long ) {
		let value = Number.parseInt( long, 16 );

		return [
			value >> 16,
			value >> 8 & 0xFF,
			value & 0xFF
		];

	} else if ( short ) {

		return Array.from(
			short,
			s => Number.parseInt( s, 16 )
		).map( n => ( n << 4 ) | n );
	}
}
