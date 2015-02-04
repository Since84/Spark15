<?php 
/*
	CLASS Content_Content
	Contains all functions for this component
	Includes all dependencies
*/

	class Content_Content {
		private static $spark_options = array(
			'context'		=> false,
			'template'		=> 'content'
		);

		function __construct($options=false) {
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
			wp_enqueue_script( 'content-script', get_template_directory_uri().'/components/content/script/content.spark.js', array('jquery'),'',true );
			wp_enqueue_style( 'content-style', get_template_directory_uri().'/components/content/style/content.spark.css' );
		}

		/** FUNCTION getOptions
		  * applies actions to be run at admin init
		**/
		public static function getOptions(){
	       return self::$spark_options;
		}	

		public static function getContext(){
			  $context 	= ( self::$spark_options['context'] ? self::$spark_options['context'] : Timber::get_context() );

			  return $context;
		}

		/** FUNCTION getRoll 
		  * returns string of HTML Slides
		**/
		public static function getRoll( $temp=null, $args=null, $posts=null ){
			
			$context = Timber::get_context();
			
			if ( $posts ){
				foreach( $posts as $post ){
					$post->post_excerpt = 
						$post->post_excerpt 
							? $post->post_excerpt
							: wp_trim_words( $post->post_content, 55 );

					$post->post_thumbnail = get_the_post_thumbnail( $post->ID, 'medium' );
					$newPosts[] = $post;

				}
				$posts = $newPosts;
				$context['content'] = $posts;
			} 
			else if ( $args ){
				$context['content'] = Timber::get_posts($args);
			} else{
				$context['content']= new TimberPost();
			}

			$template = $temp ? $temp : 'content';

			return self::getView( $context, $template );
		}

		/** FUNCTION getView
		  * returns TIMBER template.
		**/
		public static function getView( $context=null, $template ){
			$newContext = $context ? $context : self::getContext();

			return Timber::compile( 
				'/components/content/views/' 
				. ( $template ? $template : self::$spark_options['template'] )
				.'.html.twig', 
				$newContext );
		}

		/** FUNCTION processPosts
		  * processes data from posts into viewable content
		  * RETURN posts object
		**/
		static function processPosts($posts) {
			foreach( $posts as $key => $post ) {
				
				$posts[$key]->post_date 	= get_the_date( "m.d.Y", $post->ID );
				$posts[$key]->post_subtitle = get_post_meta( $post->ID, 'subtitle', true );
				$posts[$key]->post_content 	= apply_filters('the_content', $posts[$key]->post_content);
			}
		}	

	}




