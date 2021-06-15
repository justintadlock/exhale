<?php

register_block_style( 'jvm/details-summary', [
	'name'  => 'plus-minus',
	'label' => __( 'Plus Minus' ),
	'inline_style' => '
		.wp-block-jvm-details-summary.is-style-plus-minus summary::after { content: "+"; }
		.wp-block-jvm-details-summary.is-style-plus-minus[open] summary::after { content: "-"; transform: none; }
	'
] );

register_block_style( 'jvm/details-summary', [
	'name'  => 'plus-x',
	'label' => __( 'Plus X' ),
	'inline_style' => '
		.wp-block-jvm-details-summary.is-style-plus-x summary::after { content: "+"; }
		.wp-block-jvm-details-summary.is-style-plus-x[open] summary::after { content: "\00D7"; transform: none; }
	'
] );
