<?php
$svg = Exhale\Tools\Svg::render( 'patterns/texture' );

$svg = sprintf( $svg, '333333', '0.5' );

$svg = preg_replace(
	[ '~<~', '~>~', '~#~', '~"~' ],
	[ '%3C', '%3E', '%23', '\''  ],
	$svg
);

var_dump( $svg );

"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%239295ac' fill-opacity='0.45' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E"

data:image/svg+xml,%3Csvg+xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22+width%3D%224%22+height%3D%224%22+viewBox%3D%220+0+4+4%22%3E%3Cpath+fill%3D%22%23000000%22+d%3D%22M1+3h1v1H1V3zm2-2h1v1H3V1z%22%3E%3C%2Fpath%3E%3C%2Fsvg%3E

<svg xmlns="http://www.w3.org/2000/svg" width="4" height="4" viewBox="0 0 4 4"><path fill="#000000" d="M1 3h1v1H1V3zm2-2h1v1H3V1z"></path></svg>
