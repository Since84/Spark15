<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- <meta name="viewport" content="width=device-width"> -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class('rights_app'); ?> >

<?php

	$context['nav'] = new TimberMenu('main-nav');
	$context['action'] = array(
							'template' 	=> Timber::compile('/views/components/social.html.twig')
							,'twitter' 	=> get_option('twitter_link')
							,'facebook'	=> get_option('facebook_link')
							,'donate'	=> esc_url( get_permalink( get_page_by_title( 'Donate' ) ) )
						);

	Timber::render('/views/components/header.html.twig', $context);


