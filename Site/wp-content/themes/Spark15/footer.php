<?php 

	$footerContext['header'] = array(
		'heading' 	=> get_option( 'footer_heading')
		,'sub_heading'	=> get_option( 'footer_sub_heading')
	);

	$footerContext['social'] = array(
		'twitter' 	=> get_option( 'twitter_link')
		,'facebook'	=> get_option( 'facebook_link')
	);

	var_dump($footerContext);

	wp_footer(); 
?>
</body>
</html>