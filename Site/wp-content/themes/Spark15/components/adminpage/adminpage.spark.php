<?php 
/*
	CLASS SparkAdminPage
	Contains all functions for this component
	Includes all dependencies
*/

	class Adminpage_Adminpage {
		private $options;

		function __construct($options=null) {
			$this->options = $options ? $options : $this->options;

			//Add Actions
			add_action('admin_menu', array($this, 'addAdminPage'));
			add_action('admin_init', array($this, 'initAdminPage'));
		}

		/** FUNCTION addAdminPage
		  * applies actions to be run at admin init
		**/
		function addAdminPage(){
			// add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function );
			add_theme_page( 
				$this->options['page_name']
				, $this->options['menu_title']
				, $this->options['capability']
				, $this->options['menu_slug']
				, array( $this, 'createAdminPage') 
			);			
		}

		/** FUNCTION initAdminPage
		  * applies actions to be run at admin init
		**/
		function initAdminPage(){

			/// Footer Meta Section
			add_settings_section( 
				'footer_content' 
				,'Footer Header'
				,array( $this, 'sectionInfo' ) 
				,$this->options['menu_slug'] 
			);       

			/// Social Meta Section
			add_settings_section( 
				'petition_content' 
				,'Petition Info'
				,array( $this, 'sectionInfo' ) 
				,$this->options['menu_slug'] 
			);

			/// Social Meta Section
			add_settings_section( 
				'social_content' 
				,'Social Media'
				,array( $this, 'sectionInfo' ) 
				,$this->options['menu_slug'] 
			);

			$fields = array(
				array(
	            	'name'	=> 'Heading'
	            	,'id'	=> 'footer_heading'
					,'section'	=> 'footer_content'
				)
				,array(
	            	'name'	=> 'Sub Heading'
	            	,'id'	=> 'footer_sub_heading'
					,'section'	=> 'footer_content'
				)
				,array(
					'id'	=> 'petition_link'
					,'name'	=> 'Link'
					,'section'	=> 'petition_content'
				)
				,array(
					'id'	=> 'petition_text'
					,'name'	=> 'Summary'
					,'section'	=> 'petition_content'
				)
				,array(
					'id'	=> 'petition_heading'
					,'name'	=> 'Heading'
					,'section'	=> 'petition_content'
				)
				,array(
					'id'	=> 'twitter_link'
					,'name'	=> 'Twitter'
					,'section'	=> 'social_content'
				)
				,array(
					'id'	=> 'facebook_link'
					,'name'	=> 'Facebook'
					,'section'	=> 'social_content'
				)				
				,array(
					'id'	=> 'email_link'
					,'name'	=> 'Contact Email'
					,'section'	=> 'social_content'
				)
			);

			foreach( $fields as $field )
			{

				add_settings_field(
		            $field['id'] // Option group
		            ,$field['name'] // Option name
		            ,array( $this, 'textField' ) // Sanitize
		            ,$this->options['menu_slug']
		            ,$field['section']
		            ,array(
		            	'id'	=> $field['id']
		            )
		        ); 	

		        register_setting(
		            'global_content' // Option group
		            ,$field['id'] // Option name
		            ,array( $this, 'sanitizeEditor' ) // Sanitize
		        );  

			}			
		}

		/** FUNCTION createAdminPage
		  * applies actions to be run at admin init
		**/
		function createAdminPage(){
?>
	        <div class="wrap">
	            <h2>Global Settings</h2>           
	            <form method="post" action="options.php">
	            <?php
	                // This prints out all hidden setting fields
	                do_settings_sections( $this->options['menu_slug'] );
	                settings_fields( 'global_content' );
	                // settings_fields( 'petition_content' );
	                // settings_fields( 'social_content' );   
	                
	                submit_button();
	            ?>
	            </form>
	        </div>
	        <?php		
		}

		/** FUNCTION gallerySectionInfo
		  * applies actions to be run at admin init
		**/
		function sectionInfo(){	
			// var_dump('here');
		}	

		/** FUNCTION galleryIdsField
		  * applies actions to be run at admin init
		**/
		function textField($args){	
			$option = get_option($args['id']);
?>			
					<input type="text" name="<?= $args['id']; ?>" value="<?php echo esc_attr( $option ); ?>" />
<?php
		}

		/** FUNCTION sanitizeEditor
		  * applies actions to be run at admin init
		**/
		function sanitizeEditor($input){	
			 return $input;
		}			

		/** FUNCTION sparkEnqueueScripts
		  * applies actions to be run at admin init
		**/
		function enqueueScripts(){
			wp_enqueue_script( 'content-script', get_template_directory_uri().'/classes/components/content/content.spark.js', array('jquery'),'',true );
			wp_enqueue_style( 'content-style', get_template_directory_uri().'/classes/components/content/content.spark.css' );
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

		/** FUNCTION getView
		  * returns TIMBER template.
		**/
		public static function getView(){
			return Timber::compile( 
				'/classes/components/content/views/' 
				. self::$spark_options['template']
				.'.html.twig', 
				self::getContext() );
		}

	}


