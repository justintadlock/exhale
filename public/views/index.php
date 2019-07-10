<?php

// Access the view template engine.
$engine = Hybrid\App::resolve( 'view/engine' );

// Load header/* template.
$engine->display( 'header', Hybrid\Template\hierarchy() );

// Load content/* template.
$engine->display( 'content', Hybrid\Template\hierarchy() );

// Load footer/* template.
$engine->display( 'footer', Hybrid\Template\hierarchy() );
