<?php

/* Spark Category Roll */

get_header();

/* Content

	Category Sidebar
	*/
	$catContext = array('nav' => new TimberTerm('categories') );
	$context['categories'] = Timber::compile('/views/components/category_nav.html.twig');
/*
	Blogroll
		Date
		Title
		Thumb
		Excerpt

*/
	$blogArgs = array(
		"post_type" 		=> ( 'post' ) ,
		"posts_per_page"	=>	'10'
	);
	$blogContext = Timber::get_posts($blogArgs);
	$blogContext = array(
		'feed' 				=> $blogContext 
		,'slide_template'	=> '/views/content/news_post.html.twig'
	);
	$context['blog'] = Timber::compile('/views/components/static_feed.html.twig', $blogContext);

	Timber::render('/views/pages/blog.html.twig', $context);	

get_footer();