<?php

/**
	ReduxFramework Sample Config File
	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
**/

if ( !class_exists( "ReduxFramework" ) ) {
	return;
} 

if ( !class_exists( "Redux_Framework_sample_config" ) ) {
	class Redux_Framework_sample_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;

		public function __construct( ) {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();
			
			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();
			
			if ( !isset( $this->args['opt_name'] ) ) { // No errors please
				return;
			}
			
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
			

			// If Redux is running as a plugin, this will remove the demo notice and links
			//add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
			
			// Function to test the compiler hook and demo CSS output.
			//add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
			// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

			// Change the arguments after they've been declared, but before the panel is created
			//add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
			
			// Change the default value of a field after it's been set, but before it's been used
			//add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

			// Dynamically add a section. Can be also used to modify sections/fields
			add_filter('redux/options/'.$this->args['opt_name'].'/sections', array( $this, 'dynamic_section' ) );

		}


		/**

			This is a test function that will let you see when the compiler hook occurs. 
			It only runs if a field	set with compiler=>true is changed.

		**/

		function compiler_action($options, $css) {
			echo "<h1>The compiler hook has run!";
			//print_r($options); //Option values
			
			// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
			/*
			// Demo of how to use the dynamic CSS and write your own static CSS file
		    $filename = dirname(__FILE__) . '/style' . '.css';
		    global $wp_filesystem;
		    if( empty( $wp_filesystem ) ) {
		        require_once( ABSPATH .'/wp-admin/includes/file.php' );
		        WP_Filesystem();
		    }

		    if( $wp_filesystem ) {
		        $wp_filesystem->put_contents(
		            $filename,
		            $css,
		            FS_CHMOD_FILE // predefined mode settings for WP files
		        );
		    }
			*/
		}



		/**
		 
		 	Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		 	Simply include this function in the child themes functions.php file.
		 
		 	NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		 	so you must use get_template_directory_uri() if you want to use any of the built in icons
		 
		 **/

		function dynamic_section($sections){
		    //$sections = array();
		    $sections[] = array(
		        'title' => __('Section via hook', 'redux-framework-demo'),
		        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				    // Leave this as a blank section, no options just some intro text set above.
		        'fields' => array()
		    );

		    return $sections;
		}
		
		
		/**

			Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		**/
		
		function change_arguments($args){
		    //$args['dev_mode'] = true;
		    
		    return $args;
		}
			
		
		/**

			Filter hook for filtering the default value of any given field. Very useful in development mode.

		**/

		function change_defaults($defaults){
		    $defaults['str_replace'] = "Testing filter hook!";
		    
		    return $defaults;
		}


		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {
			
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists('ReduxFrameworkPlugin') ) {
				remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2 );
			}

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );	

		}


		public function setSections() {

			/**
			 	Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 **/


			// Background Patterns Reader
			$sample_patterns_path = get_template_directory() . '/img/patterns/';
			$sample_patterns_url  = get_template_directory_uri() . '/img/patterns/';
			$sample_patterns      = array();

			if ( is_dir( $sample_patterns_path ) ) :
				
			  if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
			  	$sample_patterns = array();
			  	$sample_patterns[0] = array('alt' => '0' , 'img' => '');

			    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

			      if( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
			      	$name = explode(".", $sample_patterns_file);
			      	$name = str_replace('.'.end($name), '', $sample_patterns_file);
			      	$sample_patterns[] = array( 'alt'=>$name,'img' => $sample_patterns_url . $sample_patterns_file );
			      }
			    }
			  endif;
			endif;

			ob_start();

			$ct = wp_get_theme();
			$this->theme = $ct;
			$item_name = $this->theme->get('Name'); 
			$tags = $this->theme->Tags;
			$screenshot = $this->theme->get_screenshot();
			$class = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf( __( 'Customize &#8220;%s&#8221;','redux-framework-demo' ), $this->theme->display('Name') );

			?>
			<div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
				<?php if ( $screenshot ) : ?>
					<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
						<img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
					</a>
					<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php esc_attr_e( 'Current theme preview' ); ?>" />
				<?php endif; ?>

				<h4>
					<?php echo $this->theme->display('Name'); ?>
				</h4>

				<div>
					<ul class="theme-info">
						<li><?php printf( __('By %s','redux-framework-demo'), $this->theme->display('Author') ); ?></li>
						<li><?php printf( __('Version %s','redux-framework-demo'), $this->theme->display('Version') ); ?></li>
						<li><?php echo '<strong>'.__('Tags', 'redux-framework-demo').':</strong> '; ?><?php printf( $this->theme->display('Tags') ); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
					<?php if ( $this->theme->parent() ) {
						printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>',
							__( 'http://codex.wordpress.org/Child_Themes','redux-framework-demo' ),
							$this->theme->parent()->display( 'Name' ) );
					} ?>
					
				</div>

			</div>

			<?php
			$item_info = ob_get_contents();
			    
			ob_end_clean();

			$sampleHTML = '';
			if( file_exists( dirname(__FILE__).'/info-html.html' )) {
				/** @global WP_Filesystem_Direct $wp_filesystem  */
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once(ABSPATH .'/wp-admin/includes/file.php');
					WP_Filesystem();
				}  		
				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__).'/info-html.html');
			}




			// ACTUAL DECLARATION OF SECTIONS
			// Home Page Settings
			$this->sections[] = array(
				'title' => __('Home Settings', 'redux-framework-demo'),
				'desc' => __('You can upload your own website logo , fav icon , tracking code ..', 'redux-framework-demo'),
				'icon' => 'el-icon-home',
				'fields' => array(

						array(
						'id'=>'logo',
						'type' => 'media', 
						'title' => __('Logo', 'redux-framework-demo'),
						'compiler' => 'true',
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc' => __('Upload your own logo . <br /> <br /><b>Note: </b> You can change logo margin from <b>Theme Style Settings</b>', 'redux-framework-demo'),
						) ,
						array(
						'id'=>'favicon',
						'type' => 'media', 
						'title' => __('FavIcon', 'redux-framework-demo'),
						'compiler' => 'true',
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc' => __('Upload your own favicon .', 'redux-framework-demo')
						), 
						
						
						array(
						'id'=>'trackingcode',
						'type' => 'textarea', 
						'title' => __('Tracking Code', 'redux-framework-demo'),
						'compiler' => 'true',
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc' => __('Add you tracking / analytics code here ', 'redux-framework-demo')
						),

						array(
						'id'=>'copyrights',
						'type' => 'textarea', 
						'title' => __('Copyrights', 'redux-framework-demo'),
						'compiler' => 'true',
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc' => __('Add you copyrights , this will be printed in footer section .', 'redux-framework-demo')
						),

						array(
						'id'=>'enable_basic_seo',
						'type' => 'switch', 
						'title' => __('Enable Basic SEO Settings', 'redux-framework-demo'),
						'desc'=> __('You can enable or dissable basic seo settings  , set this option to "Disabled" if you use any advanced SEO plugin like Yoast .', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),	

						array(
						'id'=>'sticky_menu',
						'type' => 'switch', 
						'title' => __('Sticky Menu', 'redux-framework-demo'),
						'desc'=> __('You can disable / enable sticky menu', 'redux-framework-demo'),
						'default' => 2,
						'on' => 'Enabled',
						'off' => 'Disabled'
						)
					
				)
			);


			// social settings
			$this->sections[] = array(
				'title' => __('Social Media Settings', 'redux-framework-demo'),
				'desc' => __('Edit social icons link , add twitter secret keys .. etc', 'redux-framework-demo'),
				'icon' => 'el-icon-twitter',
				'fields' => array(

						

						array(
						'id'=>'facebook',
						'type' => 'text', 
						'title' => __('Facebook Page Name', 'redux-framework-demo'),
						'desc'=> __('You can add your Facebook page name here .', 'redux-framework-demo'),
						'default' => 'facebook'
						
						),
						array(
						'id'=>'twitter',
						'type' => 'text', 
						'title' => __('Twitter', 'redux-framework-demo'),
						'desc'=> __('You can add your Twitter page name here .', 'redux-framework-demo'),
						'default' => 'twitter'
						
						),
						array(
						'id'=>'twitter_consumer_key',
						'type' => 'text', 
						'title' => __('Twitter Consumer Key', 'redux-framework-demo'),
						'desc'=> __('You can add your Twitter consumer key here .', 'redux-framework-demo')
						
						),
						array(
						'id'=>'twitter_consumer_secret',
						'type' => 'text', 
						'title' => __('Twitter Consumer Secret', 'redux-framework-demo'),
						'desc'=> __('You can add your Twitter consumer secret here.', 'redux-framework-demo')
						
						),
						array(
						'id'=>'twitter_access_token',
						'type' => 'text', 
						'title' => __('Twitter Access Token', 'redux-framework-demo'),
						'desc'=> __('You can add your Twitter access token here..', 'redux-framework-demo')
						
						),
						array(
						'id'=>'twitter_access_token_secret',
						'type' => 'text', 
						'title' => __('Twitter Access Token Secret', 'redux-framework-demo'),
						'desc'=> __('You can add your Twitter access token secret here .', 'redux-framework-demo')
						
						),
						array(
						'id'=>'dribbble',
						'type' => 'text', 
						'title' => __('Dribbble', 'redux-framework-demo'),
						'desc'=> __('You can add url .', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'flickr',
						'type' => 'text', 
						'title' => __('Flickr', 'redux-framework-demo'),
						'desc'=> __('You can add your Flickr url .', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'youtube',
						'type' => 'text', 
						'title' => __('Youtube', 'redux-framework-demo'),
						'desc'=> __('You can add your Youtube channel url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'pinterest',
						'type' => 'text', 
						'title' => __('Pinterest', 'redux-framework-demo'),
						'desc'=> __('You can add your Pinterest  url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'linkedin',
						'type' => 'text', 
						'title' => __('Linkedin', 'redux-framework-demo'),
						'desc'=> __('You can add your Linkedin  url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'rss',
						'type' => 'text', 
						'title' => __('RSS', 'redux-framework-demo'),
						'desc'=> __('You can add your RSS url.', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'tumblr',
						'type' => 'text', 
						'title' => __('Tumblr', 'redux-framework-demo'),
						'desc'=> __('You can add your tumblr url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'vimeo',
						'type' => 'text', 
						'title' => __('Vimeo', 'redux-framework-demo'),
						'desc'=> __('You can add your vimeo url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'soundcloud',
						'type' => 'text', 
						'title' => __('Soundcloud', 'redux-framework-demo'),
						'desc'=> __('You can add your soundcloud url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'instagram',
						'type' => 'text', 
						'title' => __('Instagram', 'redux-framework-demo'),
						'desc'=> __('You can add your instagram url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'skype',
						'type' => 'text', 
						'title' => __('Skype', 'redux-framework-demo'),
						'desc'=> __('You can add your skype url', 'redux-framework-demo'),
						'default' => '#'
						
						),
						array(
						'id'=>'googleplus',
						'type' => 'text', 
						'title' => __('Google Plus', 'redux-framework-demo'),
						'desc'=> __('You can add your googleplus url', 'redux-framework-demo'),
						'default' => '#'
						
						)
						,
						array(
						'id'=>'github',
						'type' => 'text', 
						'title' => __('Github', 'redux-framework-demo'),
						'desc'=> __('You can add your Github url', 'redux-framework-demo'),
						'default' => '#'
						
						)
						

					
				)
			);
			

			
			// blog settings
			$this->sections[] = array(
				'title' => __('Blog Settings', 'redux-framework-demo'),
				'desc' => __('Edit blog settings .. ', 'redux-framework-demo'),
				'icon' => 'el-icon-pencil-alt',
				'fields' => array(

						array(
						'id'=>'limit_posts',
						'type' => 'spinner', 
						'title' => __('Limit Blog Posts', 'redux-framework-demo'),
						'desc'=> __('Limit blog posts number , click and hold mouse button to increase / decrease value .. ', 'redux-framework-demo'),
						'default' => '5' ,
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500"
						),

						array(
							'id'=>'blog_order',
							'type' => 'select',
							'title' => __('Order Posts By', 'redux-framework-demo'), 
							'desc' => __('order posts by comments count or date', 'redux-framework-demo'),
							'options' => array(
									'1' => 'date' ,
									'2' => 'comment_count'
							),
							'default' => '1'
							
						),
						array(
						'id'=>'enable_readmore',
						'type' => 'switch', 
						'title' => __('Enable Read More Button', 'redux-framework-demo'),
						'desc'=> __('You can disable / enable read more button', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),
						array(
						'id'=>'enable_numeric_pagination',
						'type' => 'switch', 
						'title' => __('Enable Numeric Pagination', 'redux-framework-demo'),
						'desc'=> __('You can enable numeric pagination (pages numbers) .', 'redux-framework-demo'),
						'default' => 2,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),
						
						array(
							'id'=>'sidebar_status',
							'type' => 'select',
							'title' => __('Sidebar Status', 'redux-framework-demo'), 
							'desc' => __('Sidebar is hidden by default , you can select on the following options for the sidebar : <br /> 1- Sidebar Hidden , and users can toggle it <br />2- Sidebar Visible , and users can toggle it . <br />3- Sidebar Always Visible , and users can hide the sidebar', 'redux-framework-demo'),
							'options' => array(
									'1' => 'Sidebar Hidden' ,
									'2' => 'Sidebar Visible',
									'3' => 'Sidebar Always Visible'
							),
							'default' => '1'
							
						)


					
				)
			);


			// post settings
			$this->sections[] = array(
				'title' => __('Post Settings', 'redux-framework-demo'),
				'desc' => __('Edit post settings .. ', 'redux-framework-demo'),
				'icon' => 'el-icon-pencil',
				'fields' => array(

						
						
						array(
						'id'=>'enable_share',
						'type' => 'switch', 
						'title' => __('Enable Post Share', 'redux-framework-demo'),
						'desc'=> __('You can enable / disable share post section.', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),
						array(
							'id'=> 'share_buttons',
							'type' => 'select',
							'title' => __('Share Buttons Style', 'redux-framework-demo'), 
							'desc' => __('Select share buttons type , you can use feather default share buttons or facebook and twitter native share buttons .', 'redux-framework-demo'),
							'options' => array(	
										'feather' => 'Feather Share Buttons' ,
										'native' => 'Facebook And Twitter Native Buttons'
												),
							'default' => 'feather'
							
						),
						array(
						'id'=>'enable_author_section',
						'type' => 'switch', 
						'title' => __('Enable Author Section', 'redux-framework-demo'),
						'desc'=> __('You can disable / enable about author section', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),
						array(
						'id'=>'ajax_limit',
						'type' => 'spinner', 
						'title' => __('Limit Blog Ajax Posts', 'redux-framework-demo'),
						'desc'=> __('Limit how many posts should be displayed when users click on "Load More" button .', 'redux-framework-demo'),
						'default' => '3' ,
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500"
						),
						array(
						'id'=>'enable_related_posts',
						'type' => 'switch', 
						'title' => __('Enable Related Posts', 'redux-framework-demo'),
						'desc'=> __('You can enable / disable similar posts section .', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),
						array(
						'id'=>'related_posts_limit',
						'type' => 'spinner', 
						'title' => __('Limit Related Posts', 'redux-framework-demo'),
						'desc'=> __('Limit similar posts number , click and hold mouse button to increase / decrease value .. ', 'redux-framework-demo'),
						'default' => '3' ,
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500"
						),
						array(
							'id'=>'related_posts_option',
							'type' => 'select',
							'title' => __('Related Posts Type', 'redux-framework-demo'), 
							'desc' => __('you can select if similar posts are in the same category or have the same post tags .', 'redux-framework-demo'),
							'options' => array(
									'1' => 'category' ,
									'2' => 'tags'
							),
							'default' => '1'
							
						),
						array(
						'id'=>'enable_comments',
						'type' => 'switch', 
						'title' => __('Enable Comments Section', 'redux-framework-demo'),
						'desc'=> __('You can enable / disable comments section entirely , including approved comments and comments form .', 'redux-framework-demo'),
						'default' => 1,
						'on' => 'Enabled',
						'off' => 'Disabled'
						),

						array(
						'id'=>'commentformmessage',
						'type' => 'textarea', 
						'title' => __('Comment Form Message', 'redux-framework-demo'),
						'desc'=> __('You can add comment form message here , this will appear above the comment form', 'redux-framework-demo')
						
						),

						array(
						'id'=>'readmore_text',
						'type' => 'text', 
						'title' => __('Read More Text', 'redux-framework-demo'),
						'desc'=> __('Replace Read More Text', 'redux-framework-demo'),
						'default' => 'Read More'
						
						)

						

						


					
				)
			);



	


			// messages
			$this->sections[] = array(
				'title' => __('Alerts And Messages', 'redux-framework-demo'),
				'desc' => __('Edit search messages , archive titles .. etc', 'redux-framework-demo'),
				'icon' => 'el-icon-exclamation-sign',
				'fields' => array(

						

						array(
						'id'=>'search_title',
						'type' => 'textarea', 
						'title' => __('Search Page Title', 'redux-framework-demo'),
						'desc'=> __('You can add your own search page title here .. , <br /><b>Important :</b> you need to add $ to the title , it will present the search query .. i.e Search Results For $', 'redux-framework-demo')
						
						),
						array(
						'id'=>'search_error',
						'type' => 'textarea', 
						'title' => __('No Search Results Message', 'redux-framework-demo'),
						'desc'=> __('If there is no search results found , this message will appear .. ', 'redux-framework-demo')
						
						),
						array(
						'id'=>'archive_title',
						'type' => 'textarea', 
						'title' => __('Archive Page Title', 'redux-framework-demo'),
						'desc'=> __('You can add your own archive page title here ..  , <br /><b>Important :</b>you need to add $ to the title , it will present the search query .. i.e Search Results For $', 'redux-framework-demo')
						
						),
						array(
						'id'=>'error404',
						'type' => 'textarea', 
						'title' => __('Error 404 Message', 'redux-framework-demo'),
						'desc'=> __('You can add your own 404 page message here .. ', 'redux-framework-demo')
						
						),
						array(
						'id'=>'searchform_message',
						'type' => 'textarea', 
						'title' => __('Search Form Placeholder', 'redux-framework-demo'),
						'desc'=> __('Placeholder for search form widget , i.e Type and hit enter ..  ', 'redux-framework-demo')
						
						)


					
				)
			);


			


			// theme style settings
			$this->sections[] = array(
				'title' => __('Theme Style Settings', 'redux-framework-demo'),
				'desc' => __('Edit theme style settings .. ', 'redux-framework-demo'),
				'icon' => 'el-icon-brush',
				'fields' => array(

						
						array(
						'id'=>'background_image',
						'type' => 'media', 
						'title' => __('Background Image', 'redux-framework-demo'),
						'compiler' => 'true',
						'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
						'desc' => __('Upload your own background image', 'redux-framework-demo'),
						) ,
						
						array(
						'id'=>'background_color',
						'type' => 'color',
						'title' => __('Background Solid Color', 'redux-framework-demo'), 
						'desc' => __('Pick a background color', 'redux-framework-demo'),
						'default' => '#f2f2f2',
						'validate' => 'color',
						),
						array(
						'id'=>'background_pattern',
						'type' => 'image_select', 
						'tiles' => true,
						'title' => __('Select Patterns', 'redux-framework-demo'),
						'subtitle'=> __('Select a background pattern.', 'redux-framework-demo'),
						'default' 		=> 0,
						'options' => $sample_patterns
						
						),			
						array(
						'id'=>'google_api',
						'type' => 'text', 
						'title' => __('Google API Key', 'redux-framework-demo'),
						'desc'=> __('If you wish to use google fonts you need to paste your google api key here , <br /><br /><b>Get Your API Key :</b> <a href="https://code.google.com/apis/console/">Here</a> <br /> 1- Click on create project <br /> 2- From the left menu click on <b>Credential</b> <br />3- Under <b>Public API access </b> click on <b>CREATE NEW KEY</b> <br />4- From the popup window click on <b>Browser Key</b> and enter your website and hit create . <br />5- Copy and paste the API key here and save .', 'redux-framework-demo'),
						'default' => ''
						
						),
						array(
						'id'=>'nav_margin',
						'type' => 'spinner', 
						'title' => __('Navigation Margin Top', 'redux-framework-demo'),
						'desc'=> __('You can add more margin top top navigation menu', 'redux-framework-demo'),
						'default' => '0' ,
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "1000"
						),

						array(
						'id'=>'body_font',
						'type' => 'typography', 
						'title' => __('Post Typography', 'redux-framework-demo'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>true,
						'word-spacing'=>false, // Defaults to false
						'letter-spacing'=>true, // Defaults to false
						'color'=>true,
						'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'desc'=> __('Customize posts and pages typography .', 'redux-framework-demo'),
						'default'=> array(
							'color'=>"#636467", 
							'font-style'=>'400', 
							'font-family'=>'Lato', 
							'google' => true,
							'font-size'=>'16px', 
							'line-height'=>'26px'),
						),	
						array(
						'id'=>'body_font_two',
						'type' => 'color',
						'title' => __('Post Alternative Font Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for post meta , author section typography .. etc ', 'redux-framework-demo'),
						'default' => '#c1c0c0',
						'validate' => 'color',
						),
						array(
						'id'=>'body_placeholder',
						'type' => 'color',
						'title' => __('Placeholder Color ', 'redux-framework-demo'), 
						'desc' => __('Pick a color for form input color , textarea color . ', 'redux-framework-demo'),
						'default' => '#A5A3A3',
						'validate' => 'color',
						),
						array(
						'id'=>'body_headers',
						'type' => 'typography', 
						'title' => __('Post Headers', 'redux-framework-demo'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>false,
						'line-height'=>false,
						'word-spacing'=>false, // Defaults to false
						'letter-spacing'=>true, // Defaults to false
						'color'=>true,
						'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'desc'=> __('Customize posts and pages headers .. i.e h2 , h3.', 'redux-framework-demo'),
						'default'=> array(
							'color'=>"#3c3c3c", 
							'font-style'=>'700', 
							'font-family'=>'Roboto Slab', 
							'google' => true),
						),	
						
						array(
						'id'=>'meta_font_color',
						'type' => 'color',
						'title' => __('Post Meta Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for post meta', 'redux-framework-demo'),
						'default' => '#c1c0c0',
						'validate' => 'color',
						),
						array(
						'id'=>'meta_hover_color',
						'type' => 'color',
						'title' => __('Post Meta Hover Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for post meta hover', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						array(
						'id'=>'menu_color',
						'type' => 'color',
						'title' => __('Navigation Menu Color', 'redux-framework-demo'), 
						'desc' => __('Pick a nav menu color', 'redux-framework-demo'),
						'default' => '#fff',
						'validate' => 'color',
						),
						array(
						'id'=>'menu_hover_color',
						'type' => 'color',
						'title' => __('Navigation Menu Hover Color', 'redux-framework-demo'), 
						'desc' => __('Pick a nav menu hover color', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						
						array(
						'id'=>'sidebar_headers',
						'type' => 'typography', 
						'title' => __('Sidebar Headers', 'redux-framework-demo'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>false,
						'line-height'=>false,
						'word-spacing'=>false, // Defaults to false
						'letter-spacing'=>true, // Defaults to false
						'color'=>true,
						'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'desc'=> __('Customize widgets headers .. i.e h2 , h3.', 'redux-framework-demo'),
						'default'=> array(
							'color'=>"#636467", 
							'font-style'=>'700', 
							'font-family'=>'Roboto Slab', 
							'google' => true),
						),	
						array(
						'id'=>'sidebar_font',
						'type' => 'typography', 
						'title' => __('Sidebar Typography', 'redux-framework-demo'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>false, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>true,
						'line-height'=>true,
						'word-spacing'=>false, // Defaults to false
						'letter-spacing'=>true, // Defaults to false
						'color'=>true,
						'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'desc'=> __('Customize sidebar typography .', 'redux-framework-demo'),
						'default'=> array(
							'color'=>"#c1c0c0", 
							'font-style'=>'400', 
							'font-family'=>'Lato', 
							'google' => true,
							'font-size'=>'14px', 
							'line-height'=>'18px'),
						),	

						array(
						'id'=>'twitter_link_color',
						'type' => 'color',
						'title' => __('Twitter Widget Link Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for twitter widget links . ', 'redux-framework-demo'),
						'default' => '#636467',
						'validate' => 'color',
						),

						array(
						'id'=>'body_link_color',
						'type' => 'color',
						'title' => __('Link Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for content links . ', 'redux-framework-demo'),
						'default' => '#636467',
						'validate' => 'color',
						),
						array(
						'id'=>'body_link_hover_color',
						'type' => 'color',
						'title' => __('Link Hover Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for content links hover . ', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						array(
						'id'=>'sidebar_link_color',
						'type' => 'color',
						'title' => __('Sidebar Link Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for sidebar links links . ', 'redux-framework-demo'),
						'default' => '#c1c0c0',
						'validate' => 'color',
						),
						array(
						'id'=>'sidebar_link_hover_color',
						'type' => 'color',
						'title' => __('Sidebar Link Hover Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for sidebar links hover links . ', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						array(
						'id'=>'sidebar_twitter_link_color',
						'type' => 'color',
						'title' => __('Sidebar Twitter Link Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for sidebar twitter links . ', 'redux-framework-demo'),
						'default' => '#636467',
						'validate' => 'color',
						),
						array(
						'id'=>'comments_headers',
						'type' => 'typography', 
						'title' => __('Comments / Author Section Headers', 'redux-framework-demo'),
						//'compiler'=>true, // Use if you want to hook in your own CSS compiler
						'google'=>true, // Disable google fonts. Won't work if you haven't defined your google api key
						'font-backup'=>false, // Select a backup non-google font in addition to a google font
						'font-style'=>true, // Includes font-style and weight. Can use font-style or font-weight to declare
						'subsets'=>false, // Only appears if google is true and subsets not set to false
						'font-size'=>false,
						'line-height'=>false,
						'word-spacing'=>false, // Defaults to false
						'letter-spacing'=>true, // Defaults to false
						'color'=>true,
						'preview'=>false, // Disable the previewer
						'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
						'output' => array('h2.site-description'), // An array of CSS selectors to apply this font style to dynamically
						'compiler' => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'px', // Defaults to px
						'desc'=> __('Customize comments and author section / related posts headers.', 'redux-framework-demo'),
						'default'=> array(
							'color'=>"#636467", 
							'font-style'=>'500', 
							'font-family'=>'Roboto Slab', 
							'google' => true),
						),	
						array(
						'id'=>'comments_color',
						'type' => 'color',
						'title' => __('Comments  Content Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for comments content color . ', 'redux-framework-demo'),
						'default' => '#c1c0c0',
						'validate' => 'color',
						),
						array(
						'id'=>'buttons_color',
						'type' => 'color',
						'title' => __('Button Background Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for read more button / comments form submit and contact form send buttons background color . ', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						array(
						'id'=>'pagination_hover_color',
						'type' => 'color',
						'title' => __('Pagination Background Hover Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for post / page pagination background color', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						array(
						'id'=>'buttons_hover_color',
						'type' => 'color',
						'title' => __('Buttons Hover Background Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for read more button / comments form submit and contact form send buttons hover color. ', 'redux-framework-demo'),
						'default' => '#303030',
						'validate' => 'color',
						),


						array(
						'id'=>'header_background_color',
						'type' => 'color',
						'title' => __('Header Background Color', 'redux-framework-demo'), 
						'desc' => __('Header Background Color', 'redux-framework-demo'),
						'default' => '#363636',
						'validate' => 'color',
						),


						array(
						'id'=>'quote_bg',
						'type' => 'color',
						'title' => __('Quote Backgound Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for quote background . ', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),

						array(
						'id'=>'loadmorebg',
						'type' => 'color',
						'title' => __('Load More Button Backgound Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for load more button . ', 'redux-framework-demo'),
						'default' => '#fff',
						'validate' => 'color',
						),

						array(
						'id'=>'loadmorecolor',
						'type' => 'color',
						'title' => __('Load More Button Text Color', 'redux-framework-demo'), 
						'desc' => __('Pick a color for load more button . ', 'redux-framework-demo'),
						'default' => '#858585',
						'validate' => 'color',
						),
						array(
						'id'=>'loadmorehover',
						'type' => 'color',
						'title' => __('Load More Button Hover Backgound Color', 'redux-framework-demo'), 
						'desc' => __('Pick a background hover color for load more button . ', 'redux-framework-demo'),
						'default' => '#f4793d',
						'validate' => 'color',
						),
						
						array(
						'id'=>'custom_css',
						'type' => 'textarea',
						'title' => __('Custom CSS', 'redux-framework-demo'), 
						'desc' => __('Paste yout custom css here ..  ', 'redux-framework-demo'),
						'validate' => 'css'
						)


					
				)
			);
			

			// Javascript Settings
			$this->sections[] = array(
				'title' => __('JavaScript Settings', 'redux-framework-demo'),
				'desc' => __('Edit animation speed , add custom javascript code .. etc. ', 'redux-framework-demo'),
				'icon' => 'el-icon-website-alt',
				'fields' => array(

						array(
						'id'=>'animation_speed',
						'type' => 'spinner', 
						'title' => __('Javascript Animation Speed', 'redux-framework-demo'),
						'desc'=> __('Edit javascript animation speed , default is 700 ', 'redux-framework-demo'),
						'default' => '700' ,
						"min" 		=> "50",
						"step"		=> "50",
						"max" 		=> "10000"
						),

						array(
							'id'=> 'animation_ease',
							'type' => 'select',
							'title' => __('Javascript Animation Method', 'redux-framework-demo'), 
							'desc' => __('Select JavaScript animation method from the list , default is swing.', 'redux-framework-demo'),
							'options' => array(	'easeInQuad' => 'easeInQuad'
												,'easeOutQuad' => 'easeOutQuad'
												,'easeInOutQuad' => 'easeInOutQuad'
												,'easeInCubic' => 'easeInCubic'
												,'easeOutCubic' => 'easeOutCubic'
												,'easeInOutCubic' => 'easeInOutCubic'
												,'easeInQuart' => 'easeInQuart'
												,'easeOutQuart' => 'easeOutQuart'
												,'easeInOutQuart' => 'easeInOutQuart'
												,'easeInSine' => 'easeInSine'
												,'easeOutSine' => 'easeOutSine'
												,'easeInOutSine' => 'easeInOutSine'
												,'easeInExpo' => 'easeInExpo'
												,'easeOutExpo' => 'easeOutExpo'
												,'easeInOutExpo' => 'easeInOutExpo'
												,'easeInQuint' => 'easeInQuint'
												,'easeOutQuint' => 'easeOutQuint'
												,'easeInOutQuint' => 'easeInOutQuint'
												,'easeInCirc' => 'easeInCirc'
												,'easeOutCirc' => 'easeOutCirc'
												,'easeInOutCirc' => 'easeInOutCirc'
												,'easeInElastic' => 'easeInElastic'
												,'easeOutElastic' => 'easeOutElastic'
												,'easeInOutElastic' => 'easeInOutElastic'
												,'easeInBack' => 'easeInBack'
												,'easeOutBack' => 'easeOutBack'
												,'easeInOutBack' => 'easeInOutBack'
												,'easeInBounce' => 'easeInBounce'
												,'easeOutBounce' => 'easeOutBounce'
												,'easeInOutBounce' => 'easeInOutBounce'),
							'default' => 'easeInQuad'
							
						),
						array(
							'id'=> 'flexslider_animation',
							'type' => 'select',
							'title' => __('Gallery Animation', 'redux-framework-demo'), 
							'desc' => __('Select Gallery post animation type.', 'redux-framework-demo'),
							'options' => array(	
										'fade' => 'fade' ,
										'slide' => 'slide'
												),
							'default' => 'fade'
							
						),


					
				)
			);

			$theme_info = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'redux-framework-demo').'<a href="'.$this->theme->get('ThemeURI').'" target="_blank">'.$this->theme->get('ThemeURI').'</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'redux-framework-demo').$this->theme->get('Author').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'redux-framework-demo').$this->theme->get('Version').'</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">'.$this->theme->get('Description').'</p>';
			$tabs = $this->theme->get('Tags');
			if ( !empty( $tabs ) ) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'redux-framework-demo').implode(', ', $tabs ).'</p>';	
			}
			$theme_info .= '</div>';

			if(file_exists(dirname(__FILE__).'/README.md')){
			$this->sections['theme_docs'] = array(
						'icon' => ReduxFramework::$_url.'assets/img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'redux-framework-demo'),
						'fields' => array(
							array(
								'id'=>'17',
								'type' => 'raw',
								'content' => file_get_contents(dirname(__FILE__).'/README.md')
								),				
						),
						
						);
			}//if




			

			if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
			    $tabs['docs'] = array(
					'icon' => 'el-icon-book',
					    'title' => __('Documentation', 'redux-framework-demo'),
			        'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
			    );
			}

		}	

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-1',
			    'title' => __('Theme Information 1', 'redux-framework-demo'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			$this->args['help_tabs'][] = array(
			    'id' => 'redux-opts-2',
			    'title' => __('Theme Information 2', 'redux-framework-demo'),
			    'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');

		}


		/**
			
			All the possible arguments for Redux.
			For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 **/
		public function setArguments() {
			
			$theme = wp_get_theme(); // For use with some settings. Not necessary.
			$get_google_api_key = '';
			$get_gp_options = get_option('feather');
			if($get_gp_options && isset($get_gp_options['google_api'])) $get_google_api_key = $get_gp_options['google_api'];

			$this->args = array(
	            
	            // TYPICAL -> Change these values as you need/desire
				'opt_name'          	=> 'feather', // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'			=> $theme->get('Name'), // Name that appears at the top of your panel
				'display_version'		=> $theme->get('Version'), // Version that appears at the top of your panel
				'menu_type'          	=> 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'     	=> true, // Show the sections below the admin menu item or not
				'menu_title'			=> __( 'Theme Settings', 'redux-framework-demo' ),
	            'page'		 	 		=> __( 'Theme Settings', 'redux-framework-demo' ),
	            'google_api_key'   	 	=> $get_google_api_key, // Must be defined to add google fonts to the typography module
	            'global_variable'    	=> '', // Set a different name for your global variable other than the opt_name
	            'dev_mode'           	=> false, // Show the time the page took to load, etc
	            'customizer'         	=> false, // Enable basic customizer support

	            // OPTIONAL -> Give you extra features
	            'page_priority'      	=> null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	            'page_parent'        	=> 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	            'page_permissions'   	=> 'manage_options', // Permissions needed to access the options panel.
	            'menu_icon'          	=> '', // Specify a custom URL to an icon
	            'last_tab'           	=> '', // Force your panel to always open to a specific tab (by id)
	            'page_icon'          	=> 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	            'page_slug'          	=> '_options', // Page slug used to denote the panel
	            'save_defaults'      	=> true, // On load save the defaults to DB before user clicks save or not
	            'default_show'       	=> false, // If true, shows the default value next to each field that is not the default value.
	            'default_mark'       	=> '', // What to print by the field's title if the value shown is default. Suggested: *


	            // CAREFUL -> These options are for advanced use only
	            'transient_time' 	 	=> 60 * MINUTE_IN_SECONDS,
	            'output'            	=> true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	            'output_tab'            => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	            //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
	            //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
	            

	            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	            'database'           	=> '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	            
	        
	            'show_import_export' 	=> true, // REMOVE
	            'system_info'        	=> false, // REMOVE
	            
	            'help_tabs'          	=> array(),
	            'help_sidebar'       	=> '', // __( '', $this->args['domain'] );            
				);


			
			
	 
			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false ) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace("-", "_", $this->args['opt_name']);
				}
			$this->args['intro_text'] = sprintf( __('<p>Feel free to contact us via our <a class="button button-secondary" href="http://support.suitstheme.com/">Support Forum</a></p>', 'redux-framework-demo' ), $v );
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
			}


		}
	}
	new Redux_Framework_sample_config();

}


/** 

	Custom function for the callback referenced above

 */
if ( !function_exists( 'redux_my_custom_field' ) ):
	function redux_my_custom_field($field, $value) {
	    print_r($field);
	    print_r($value);
	}
endif;

/**
 
	Custom function for the callback validation referenced above

**/
if ( !function_exists( 'redux_validate_callback_function' ) ):
	function redux_validate_callback_function($field, $value, $existing_value) {
	    $error = false;
	    $value =  'just testing';
	    /*
	    do your validation
	    
	    if(something) {
	        $value = $value;
	    } elseif(something else) {
	        $error = true;
	        $value = $existing_value;
	        $field['msg'] = 'your custom error message';
	    }
	    */
	    
	    $return['value'] = $value;
	    if($error == true) {
	        $return['error'] = $field;
	    }
	    return $return;
	}
endif;
?>