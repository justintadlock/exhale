<?php

use Hybrid\Template;
use Hybrid\View;

// Load header/* template.
View\display( 'header', Template\hierarchy(), [ 'hierarchy' => Template\hierarchy() ] );

// Load content/* template.
View\display( 'content', Template\hierarchy(), [ 'hierarchy' => Template\hierarchy() ] );

// Load footer/* template.
View\display( 'footer', Template\hierarchy(), [ 'hierarchy' => Template\hierarchy() ] );
