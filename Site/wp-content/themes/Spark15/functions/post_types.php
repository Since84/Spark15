<?php 
	
	/** 
	  * Register Post Types
	**/

	// register_post_type( $post_type, $args );


	//Team Post Type
	$label = array(
		'name'	=>	'Team'
		,'singular_name'	=> 'Member'
	);

	$teamArgs = array(
		'labels'	=>	$label
		,'public'	=>	true
		,'supports'	=>	array('title')
	);

	register_post_type( 'Team', $teamArgs );	


?>