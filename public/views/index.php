<?php

// Access the template view.
$view = Hybrid\App::resolve( 'theme.view' );

// Load header/* template.
$view->make( 'header', [ 'slugs' => $view->slugs() ] )->display();

// Load content/* template.
$view->make( 'content', [ 'slugs' => $view->slugs() ] )->display();

// Load footer/* template.
$view->make( 'footer', [ 'slugs' => $view->slugs() ] )->display();
