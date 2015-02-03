<?php
/*
 * Spark Component: Header 
 * Description: Base Header Class for Spark
 */

class Header_Header {

	private static $class_id = "header";
	private static $spark_options = array(
		'showLogo'		=>	true
		,'headerRight'	=>  null //Template for right side ( /views/components/... )
		,'nav'			=>	null //Menu name for nav menu
		,'template'		=>	null //Name of header template
		,'isJs'			=> 	false
		,'isMobile'		=>  true
		,'context'		=> 	false
	);	
  
	function __construct($options) {
		// Set Options
		self::$spark_options = ( 
			$options 
			? array_merge( self::$spark_options , $options ) 
			: self::$spark_options 
		);

		//Add Actions
		add_action('init', array($this, 'initAction'));
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));

	}

	/** FUNCTION initAction
	  * applies actions to be run at init
	**/
	function initAction(){

	}

	/** FUNCTION adminInitAction
	  * applies actions to be run at admin init
	**/
	function adminInitAction(){

	}

	/** FUNCTION sparkEnqueueScripts
	  * applies actions to be run at admin init
	**/
	function enqueueScripts(){
		wp_enqueue_script( 'sidr', get_template_directory_uri().'/classes/components/'.$class_id.'/js/sidr/jquery.sidr.min.js', array('jquery', 'backbone'),'',true );
		wp_enqueue_script( $class_id.'-script', get_template_directory_uri().'/classes/components/'.$class_id.'/'.$class_id.'.spark.js', array('jquery', 'backbone'),'',true );
		
		wp_enqueue_style( 'sidrcss', get_template_directory_uri().'/classes/components/'.$class_id.'/js/sidr/stylesheets/jquery.sidr.light.css');
		wp_enqueue_style( $class_id.'-style', get_template_directory_uri().'/classes/components/'.$class_id.'/'.$class_id.'.spark.css' );
	}

	/** FUNCTION getOptions
	  * applies actions to be run at admin init
	**/
	public static function getOptions(){
       return self::$spark_options;
	}	

	/** FUNCTION getContext
	  * processes context from options
	**/	
	public static function getContext(){
	  	if ( self::$spark_options['context'] ) {
		  $context        					= self::$spark_options['context'];
		} else {
		  $context        					= Timber::get_context();
		  $context['nav']  					= new TimberMenu( self::$spark_options['nav'] );
		  $context[''.self::$class_id.'_right']	= Timber::compile(self::$spark_options['headerRight']);
		  $context['logo']					= get_header_image();
		}

		  return $context;
	}

	/** FUNCTION getView
	  * returns TIMBER template.
	**/
	public static function getView(){
		return Timber::compile( 
			'/components/header/views/' 
			. self::$spark_options['template']
			.'.html.twig', 
			self::getContext() );
	}

}

