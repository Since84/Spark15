<?php 

	$footerContext = Timber::get_context();
	
	/// Header
	$footerContext['header'] = array(
		'heading' 		=> get_option( 'footer_heading')
		,'sub_heading'	=> get_option( 'footer_sub_heading')
	);

	/// Content Area
	$twitterContext = array( 
		'widget'	=> Timber::get_widgets('social')
		,'link' 	=> get_option( 'twitter_link') 
	);
	$footerContext['twitter'] = Timber::compile('/views/components/twitter_block.html.twig', $twitterContext);
	
	$petitionContext = array(
		'heading'	=> get_option('petition_heading')
		,'text'		=> get_option('petition_text')
		,'link'		=> get_option('petition_link')
	);
	$footerContext['petition'] = Timber::compile('/views/content/petition_block.html.twig', $petitionContext);

	$footerContext['newsletter'] = Timber::compile('/views/components/newsletter_block.html.twig');//, $newsletterContext);
	

	/// Contact Area
	$contactContext = array( 'nav' => new TimberMenu('Footer Contact') );
	$footerContext['contact_menu'] = Timber::compile('views/components/nav.html.twig', $contactContext);

	$socialContext = array( 
		'twitter'	=> get_option('twitter_link')
		,'facebook'	=> get_option('facebook_link')
		,'email'	=> get_option('email_link')
	);
	$footerContext['social_menu'] = Timber::compile('views/components/social.html.twig', $contactContext);


	Timber::render('views/content/footer.html.twig', $footerContext);

	wp_footer(); 
?>
</body>
</html>