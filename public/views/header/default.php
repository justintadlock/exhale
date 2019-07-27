<!DOCTYPE html>
<html <?php Hybrid\Attr\display( 'html' ) ?>>

<head>
<?php wp_head() ?>
</head>

<body <?php Hybrid\Attr\display( 'body' ) ?>>

<?php wp_body_open() ?>

<div class="app">

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'exhale' ) ?></a>

	<header <?php Hybrid\Attr\display( 'app-header', '', [
		'class' => 'app-header flex flex-wrap items-center justify-between h-auto border-b'
	] ) ?>>

		<div class="app-header__branding overflow-hidden flex justify-start items-center flex-grow md:flex-grow-0 max-w-full h-16 px-8 has-text-align-center">
			<?php the_custom_logo() ?>
			<?php Hybrid\Site\display_title( [
				'class'      => 'app-header__title m-0 mr-2 leading-none text-xl',
				'link_class' => 'app-header__title-link no-underline hover:underline focus:underline'
			] ) ?>
			<span class="app-header__sep hidden sm:block mx-3 leading-none">&middot;</span>
			<?php Hybrid\Site\display_description( [ 'class' => 'app-header__description hidden sm:block m-0 ml-2 leading-none text-sm' ] ) ?>
		</div>

		<?php the_custom_header_markup() ?>

		<?php $engine->display( 'nav/menu', 'primary', [ 'location' => 'primary' ] ) ?>

	</header>
