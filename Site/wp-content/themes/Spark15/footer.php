<?php 

	$footerContext = Timber::get_context();
	

	/// Contact Area
	$sitemapContext = array( 'nav' => new TimberMenu('Main Nav') );
	$footerContext['contact_menu'] = Timber::compile('views/components/nav.html.twig', $sitemapContext);

	$footerContext['social_menu'] = Timber::get_widgets('social_links');

	Timber::render('views/content/footer.html.twig', $footerContext);

	wp_footer(); 
?>
</body>
</html>