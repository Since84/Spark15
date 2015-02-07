<?php
class Theme_Theme {
	
	function __construct() {

		//Add Actions
		add_action('init', array($this, 'initAction'));
		$this->createAdminPage(array(
			'page_name' 	=> 'Global'
			,'menu_title' 	=> 'Global'
			,'capability' 	=> 'edit_pages'
			,'menu_slug'	=> 'global_admin'
		));
	}

	/** FUNCTION initAction
	  * applies actions to be run at init
	**/
	function initAction(){
		// Register Post Types ( custom, nav, sidebars, etc.)
		require_once(get_template_directory().'/include/enqueue.php');
		// require_once(get_template_directory().'/functions/nav.php');
		require_once(get_template_directory().'/functions/sidebars.php');
		require_once(get_template_directory().'/functions/post_types.php');
		// require_once(get_template_directory().'/functions/hooks_filters.php');
		// require_once(get_template_directory().'/functions/post_styles.php');

		// Theme Support
		add_theme_support( 'custom-header' );
		// add_theme_support( 'post-formats', array( 'image', 'gallery' ) );
		add_theme_support( 'post-thumbnails' );

		// add_post_type_support( 'post', 'post-formats' );
		// add_post_type_support( 'page', 'post-formats' );
	}

	/** FUNCTION adminInitAction
	  * applies actions to be run at admin init
	**/
	function adminInitAction(){
	}

	/** FUNCTION adminMenuAction
	  * applies actions to be run at admin init
	**/
	function createAdminPage($options){
		$sparkAdmin = new Adminpage_Adminpage($options);
	}

	/** FUNCTION sparkCreateHomePageAdminMenu
	  * applies actions to be run at admin init
	**/
	function createHomePageAdminMenu(){
		if ( !$homeGallery = get_option( 'home_gallery' ) )
			add_option( 'home_gallery', '' );
?>
	<div class="wrap">
		<form name="form1" method="post" action="">
<?php
		settings_fields( 'home_gallery' );
		do_settings_sections( 'home_gallery' );
?>
			<div id="poststuff">
				<div id="post-body">
					<div id="postdivrich" class="postarea">
						<h3><?php _e('Content') ?></h3>
						<?php the_editor($homeGallery); ?>
						<?php wp_nonce_field( 'autosave', 'autosavenonce', false ); ?>
						<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
						<?php wp_nonce_field( 'getpermalink', 'getpermalinknonce', false ); ?>
						<?php wp_nonce_field( 'samplepermalink', 'samplepermalinknonce', false ); ?>
						<?php submit_button(); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php
	}	


	/*******************
	
	Resource Functions
	
	********************/

	/** FUNCTION processPosts
	  * processes data from posts into viewable content
	  * RETURN posts object
	**/
	static function processPosts($posts) {
		foreach( $posts as $key => $post ) {
			$posts[$key]->post_meta = get_post_meta($post->ID);
			$posts[$key]->post_date 	= get_the_date( "m.d.Y", $post->ID );
			$posts[$key]->post_subtitle = get_post_meta( $post->ID, 'subtitle', true );
			$posts[$key]->post_content 	= apply_filters('the_content', $posts[$key]->post_content);
		}
	}




}