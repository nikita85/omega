<?php 

/**
 * Post Meta
 */

/**
 * Theme Name : Business
 * Author URL : http://themeforest.com/
 */

/**
 * This class will create additional post meta fields for this theme
 */

if(!class_exists('DSF_SIDEBAR_META'))
{
	class DSF_SIDEBAR_META {

		/**
		 * [$prefix used prefix for post meta]
		 * @var [var]
		 */
		public $prefix;
		public $fields;
		public $scripts;
		public $styles;
		public $nonce;

		/**
		 * Constructor
		 */
		function __construct($prefix = 'dsf' , $fields , $scripts = '' , $styles = '' , $nonce) {

			/**
			 * [$this->prefix assing prefix for meta fields]
			 * [$this->fields meta fields]
			 * @var [type]
			 */
			$this->prefix = $prefix;
			$this->fields = $fields;
			$this->scripts = $scripts;
			$this->styles = $styles;
			$this->nonce = $nonce;

			
			/**
			 * Adding actions , this will check if $this->fields is array
			 */
			if(is_array($this->fields))
			{

					// register the fields
					add_action('admin_menu', array(&$this , 'register_meta_settings'));
					// save settings action
					add_action('save_post',array(&$this , 'save_meta_fields'));
					// Register Post Meta Scripts and Styles
					add_action('admin_enqueue_scripts', array(&$this , 'register_meta_scripts'));
					// enqueue scripts
					add_action('admin_enqueue_scripts' , array(&$this , 'print_fe_scripts'));
					
					

					
					
			}
			
		}


		public function print_fe_scripts()
		{
				// enqueue media gallery script
				wp_enqueue_script('media-upload');
				// register custom script
				wp_register_script('dsf_theme_media_gallery' , get_template_directory_uri() . '/theme-addons/post-meta/post-meta-script.js' , 'jquery');
				wp_enqueue_script('dsf_theme_media_gallery');
		}


		/**
		 * Register Settings
		 */
		public function register_meta_settings() {

					if(is_array($this->fields['page']))
					{
								foreach ($this->fields['page'] as $page) {
									// print the fields
									add_meta_box($this->fields['id'], $this->fields['title'], array(&$this , 'print_meta_fields'), $page, $this->fields['context'], $this->fields['priority']);
									}
								
					}

					else {
					// print the fields
					add_meta_box($this->fields['id'], $this->fields['title'], array(&$this , 'print_meta_fields'), $this->fields['page'], $this->fields['context'], $this->fields['priority']);
					}
		}


		/**
		 * Print Fields
		 */
		public function print_meta_fields(){

			global $post;

			echo '<input type="hidden" name="'.$this->nonce.'" value="', wp_create_nonce(basename(__FILE__)), '" />';
     
		     
		     echo '<div class="drop_meta_container">';


		     
		     foreach($this->fields['fields'] as $field){
		          
		          $meta = get_post_meta($post->ID, $field['id'], true);


		          
		          switch($field['type']){
		               
		               case 'text' :
		                    $out = '<div class="drop_meta_item">
		                            <label for="'.$field['id'].'">'.$field['name'].'</label>
		                            <div class="inner_meta">
		                            <input type="text" class="meta_field" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />
		                            
		                            <div class="meta_description"><p>'.$field['desc'].'</p></div>
		                            </div><!-- end inner -->
		                            </div><!-- end single meta -->';
		                            
		                    echo $out;
		                    
		                    break;
		               
		               case 'textarea' :
		                    $out = '<div class="drop_meta_item">
		                            <label for="'.$field['id'].'">'.$field['name'].'</label>
		                            <div class="inner_meta">
		                            <textarea class="meta_field" id="'.$field['id'].'" name="'.$field['id'].'">'.$meta.'</textarea>
		                            <div class="meta_description"><p>'.$field['desc'].'</p></div>
		                            </div><!-- end inner -->
		                            </div><!-- end single meta -->';
		                            
		                    echo $out;
		                    break;

		               case 'select' :
		                    $out = '<div class="drop_meta_item fullwidth">
		                           
		                            <div class="inner_meta">
		                            <select id="'.$field['id'].'" name='.$field['id'].'>';
		                            	foreach ($field['fields'] as $value) {
		                            		if($meta == $value) $out .= '<option selected=selected>'.$value.'</option>';
		                            		else $out .= '<option >'.$value.'</option>';
		                            	}
		                            $out .= '</select>
		                            <div class="meta_description"><p>'.$field['desc'].'</p></div>
		                            </div><!-- end inner -->
		                            </div><!-- end single meta -->';
		                            
		                    echo $out;
		                    break;


		                case 'media_gallery' :

		                		// Media Gallery Code
	                		 $out = '<div class="drop_meta_item gallery">
	                            <label for="'.$field['id'].'">'.$field['name'].'</label>
	                            <div class="inner_meta">
	                            <!-- images container -->
	                            <div class="images-container"></div>
	                            <!-- end images container -->

	                            <input type="text" class="meta_field media_field_content" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />
	                            <input type="button" name="uploader" class="dsf_media_uploader_button button button-primary" value="'.__('Add Images' , 'dsf').'">
	                            <div class="meta_description"><p>'.$field['desc'].'</p></div>
	                            </div><!-- end inner -->
	                            </div><!-- end single meta -->';
		                            
		                    echo $out;
		                break;
		               
		          }// end switch 
		     }// end foreach
		     
		     echo '</div><!-- end meta container --><br />';
		} 


		/**
		 * Save Meta Fields
		 */
		public function save_meta_fields($post_id) {

			global $post_id;

			 // verify nonce
			if(isset($_POST[$this->nonce])) {


		    if (!wp_verify_nonce($_POST[$this->nonce], basename(__FILE__))) {
		        return $post_id;
		    	}

			}

		    // check autosave
		    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		        	return $post_id;
		    }

		    // check permissions
		    if(!current_user_can('edit_post', $post_id))
		    {
		    		return $post_id;
		    }
		    foreach ($this->fields['fields'] as $single_field) {
		    	$id = $single_field['id'];
		        $old = get_post_meta($post_id, $id, true);


		        if(isset($_POST[$id]))
		        {   

		        
			        $new = $_POST[$id];
			        
			        if ($new && $new != $old) {
			            update_post_meta($post_id,  $id, $new);
			        } elseif ('' == $new && $old) {
			            delete_post_meta($post_id, $id, $old);
			        }

		    	}

		    }
		}



		/**
		 * Register Meta Scripts And Styles
		 */
		public function register_meta_scripts() {

				/**
				 * this will extract styles array and register styles
				 */


				// check if this is post editing page
				if(strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php') || strstr($_SERVER['REQUEST_URI'], 'wp-admin/post.php')) :

				if(is_array($this->styles) && !empty($this->styles))
				{
					foreach ($this->styles as $key => $value) {
						wp_register_style($key , $value);
						wp_enqueue_style($key);
					}
				}

				endif;

		}


	}
}


/**
 * [$meta_styles the required styles for meta fields]
 * @var $new [instantiate post meta class [prefix , meta fields array , js , css , nonce id] ]
 * @var array
 */
$meta_styles = array(
	'blogget-meta-css' =>  get_template_directory_uri() . '/theme-addons/post-meta/post-meta-styles.css'
	);


// post meta fields



/**
 * [$new call the class , blogget is the theme main prefix]
 * [$post_fields , post meta fields]
 * @class DSF_SIDEBAR_META
 */
$post_fields = array(
                    'id' => 'dsf-meta-items',
                    'title' => __('Select Sidebar','dsf'),
                    'page' => array('page'),
                    'context' => 'side',
                    'priority' => 'default',
                    'fields' => array(
                    					array(
                                             'id' => 'sidebars',
                                             'desc' => __('select which sidebar you want to use with this page','dsf'),
                                             'name' => __('Select Sidebar','dsf'),
                                             'type' => 'select', 
                                             'fields' => array(	'Sidebar 1',
                                             					'Sidebar 2',
                                             					'Sidebar 3',
                                             					'Sidebar 4',
                                             					'Sidebar 5',
                                             					'Sidebar 6',
                                             					'Sidebar 7',
                                             					'Sidebar 8',
                                             					'Sidebar 9',
                                             					'Sidebar 10'
                                             					)
                                        )
                                        
                         
                                        )
                    );



$new = new DSF_SIDEBAR_META('journal-sidebars' , $post_fields , false , $meta_styles , 'journal_sidebar_nonce');




?>