<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mytest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<header id="masthead" class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container">
                <div class="container-logo">
                    <?= get_custom_logo() ?>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex w-100 align-items-center">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav w-100 justify-content-center">
                            <?php wp_nav_menu([
                                'theme_location' => 'top',
                                'menu_id' => 'primary-menu',
                                'container_class' => 'navbar-nav w-100 justify-content-center',
                                'menu_class' => 'navbar-nav ms-0 my-3 my-lg-0',
                            ]); ?>
                        </div>

                        <div class="nav-sidebar my-4 m-lg-0">
                            <ul class="inner-nav-sidebar">
                                <?php if (function_exists('dynamic_sidebar')) dynamic_sidebar('nav-sidebar'); ?>
                            </ul>
                        </div><!-- .nav-sidebar -->

                        <div class="container-callback ps-lg-3">
                            <button class="btn btn-primary btn-callback">Обратная связь</button>
                        </div>
                    </div>
                </div>

            </div>
        </nav><!-- #site-navigation -->
	</header><!-- #masthead -->
