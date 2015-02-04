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

			$footerFields = [
				array(
	            	'name'	=> 'Footer Heading'
	            	,'id'	=> 'footer_heading'
				)
				,array(
	            	'name'	=> 'Footer Sub Heading'
	            	,'id'	=> 'footer_sub_heading'
				)
			];	        

			foreach( $footerFields as $field )
			{

		        register_setting(
		            'footer_content' // Option group
		            ,$field['id'] // Option name
		            ,array( $this, 'sanitizeEditor' ) // Sanitize
		        );  

				add_settings_field(
		            $field['id'] // Option group
		            ,$field['name'] // Option name
		            ,array( $this, 'textField' ) // Sanitize
		            ,$this->options['menu_slug']
		            ,'footer_content'
		            ,array(
		            	'id'	=> $field['id']
		            )
		        ); 	

			}

			/// Social Meta Section
			add_settings_section( 
				'petition_content' 
				,'Petition Info'
				,array( $this, 'sectionInfo' ) 
				,$this->options['menu_slug'] 
			);

			$petitionFields = [
				array(
					'id'	=> 'petition_link'
					,'name'	=> 'Link'
				)
				,array(
					'id'	=> 'petition_text'
					,'name'	=> 'Summary'
				)
				,array(
					'id'	=> 'petition_heading'
					,'name'	=> 'Heading'
				)
			];

			foreach( $petitionFields as $field )
			{

		        register_setting(
		            'petition_content' // Option group
		            ,$field['id'] // Option name
		            ,array( $this, 'sanitizeEditor' ) // Sanitize
		        );  

				add_settings_field(
		            $field['id'] // Option group
		            ,$field['name'] // Option name
		            ,array( $this, 'textField' ) // Sanitize
		            ,$this->options['menu_slug']
		            ,'petition_content'
		            ,array(
		            	'id'	=> $field['id']
		            )
		        ); 	

			}			

			/// Social Meta Section
			add_settings_section( 
				'social_content' 
				,'Social Media'
				,array( $this, 'sectionInfo' ) 
				,$this->options['menu_slug'] 
			);

			$socialFields = [
				array(
					'id'	=> 'twitter_link'
					,'name'	=> 'Twitter'
				)
				,array(
					'id'	=> 'facebook_link'
					,'name'	=> 'Facebook'
				)
			];

			foreach( $socialFields as $field )
			{

		        register_setting(
		            'social_content' // Option group
		            ,$field['id'] // Option name
		            ,array( $this, 'sanitizeEditor' ) // Sanitize
		        );  

				add_settings_field(
		            $field['id'] // Option group
		            ,$field['name'] // Option name
		            ,array( $this, 'textField' ) // Sanitize
		            ,$this->options['menu_slug']
		            ,'social_content'
		            ,array(
		            	'id'	=> $field['id']
		            )
		        ); 	

			}
			//Footer Heading
	

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
	                settings_fields( 'footer_content' );
	                settings_fields( 'petition_content' );
	                settings_fields( 'social_content' );   
	                do_settings_sections( $this->options['menu_slug'] );
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
			var_dump($args);
?>			
					<input type="text" name="<?= $args['id']; ?>" value="<?php echo esc_attr( $option ); ?>" />
<?php
		}
		function subHeadingTextField() {
			$footerSubHeading = get_option('footer_sub_heading');	
			var_dump($footerSubHeading);		
?>
				<tr>	
					<td><input type="text" name="footer_sub_heading" value="<?php echo esc_attr( $footerSubHeading ); ?>" /></td>
				</tr>
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


