<?php 
// Feather Wordpress Theme

/* -------------------------------------------------------------- 
 	Require the framework
-------------------------------------------------------------- */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/config/config.php' ) ) {
require_once( dirname( __FILE__ ) . '/ReduxFramework/config/config.php' );
}


$feather_theme_options = get_option('feather');
define('WP_VER_NUM' , str_replace('.' , '' , substr(get_bloginfo('version'), 0 , 3)));


/* -------------------------------------------------------------- 
Translation
-------------------------------------------------------------- */
function feather_translation() 
{
load_theme_textdomain('dsf' , get_template_directory() . '/lang');

}
add_action('after_setup_theme' , 'feather_translation');


/* -------------------------------------------------------------- 
  Theme Support
-------------------------------------------------------------- */
add_theme_support('automatic-feed-links');
add_theme_support( 'post-formats', array( 'video' , 'image'  , 'audio' , 'gallery' , 'link' , 'quote' , 'status'  ) );
add_theme_support( 'post-thumbnails' , array('post') );
register_nav_menu( 'primary', __('Main Menu' , 'dsf') );

/* Image Size */
if(function_exists('add_image_size'))
{
	add_image_size('feather-post' , 750 , 400 , true);
    add_image_size('feather-widget-post' , 60 , 60 , true);
}



/* -------------------------------------------------------------- 
 	Load Theme Styles And Scripts
-------------------------------------------------------------- */
function feather_addons()
{
	global $feather_theme_options;
	$animation_speed = isset($feather_theme_options['animation_speed']) ? $feather_theme_options['animation_speed'] : '500';
	$animation_ease = isset($feather_theme_options['animation_ease']) ? $feather_theme_options['animation_ease'] : 'easeInQuad';
	$flexslider_animation = isset($feather_theme_options['flexslider_animation']) ? $feather_theme_options['flexslider_animation'] : 'fade';

		// Default Sripts
	wp_enqueue_script('jquery');
	// load comments reply
	if(is_singular()) wp_enqueue_script('comment-reply');


	// load media elements
    if(defined('WP_VER_NUM') && WP_VER_NUM >= '36')
    {
        wp_enqueue_script('wp-mediaelement');
    }
    else{
        wp_register_script('mediaelementjs' , get_template_directory_uri() . '/js/mediaelement.min.js' , '' , false , true);
        wp_enqueue_script('mediaelementjs');
    }


    wp_register_script('flexslider' , get_template_directory_uri() . '/js/jquery.flexslider-min.js' , '' , false , true);
    wp_register_script('jquery-ui-custom' , get_template_directory_uri() . '/js/jquery-ui-1.10.3.custom.min.js' , '' , false , true);
    wp_register_script('ie-placeholders' , get_template_directory_uri() . '/js/placeholder.js' , '' , false , true);
    wp_register_script('jflickrfeed' , get_template_directory_uri() . '/js/jflickrfeed.js' , '' , false , true);
    wp_register_script('jquery.browser' , get_template_directory_uri() . '/js/jquery.browser.js' , '' , false , true);
    wp_register_script('jquery.fitvids' , get_template_directory_uri() . '/js/jquery.fitvids.js' ,'',false,true);
    wp_register_script('jquery.instagram' , get_template_directory_uri() . '/js/jquery.instagram.js' , '' , false , true);
    wp_register_script('custom-js' , get_template_directory_uri() . '/js/custom.js' , '' , false , true);

    wp_enqueue_script('flexslider');
    wp_enqueue_script('jquery-ui-custom');
    wp_enqueue_script('jflickrfeed');
    wp_enqueue_script('ie-placeholders');
    wp_enqueue_script('jquery.browser');
    wp_enqueue_script('jquery.fitvids');
    wp_enqueue_script('jquery.instagram');
    wp_localize_script('custom-js' , 'feather' , array(
        'speed' => $animation_speed ,
        'ease' => $animation_ease,
        'template_url' => get_template_directory_uri(),
        'admin_ajax' => admin_url('admin-ajax.php'),
        'flexslider_animation' => $flexslider_animation
    ));
    wp_enqueue_script('custom-js');


    // default theme google fonts
	wp_register_style('feather-default-fonts' , 'http://fonts.googleapis.com/css?family=Lato:400,300,700,400italic,900|Roboto+Slab:400,300,700|Voltaire');

    wp_register_style('feather-bootstrap' , get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_register_style('feather-css' , get_template_directory_uri(). '/css/main.css');
    wp_register_style('feather-user-custom-styles' , get_template_directory_uri() . '/theme-addons/user-settings/user_settings.php');
    wp_register_style('feather-font-awesome' , get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('feather-default-fonts');
    wp_enqueue_style('feather-bootstrap');
    wp_enqueue_style('feather-font-awesome');
    wp_enqueue_style('feather-css');
    wp_enqueue_style('feather-user-custom-styles');

}


add_action('wp_enqueue_scripts' , 'feather_addons');




/* -------------------------------------------------------------- 
 	Sidebars
-------------------------------------------------------------- */
function feather_sidebars()
{

	register_sidebar(array(
	                           'name' => 'Sidebar 1',
	                           'id' => 'feather-sidebar-1',
	                           'description' => 'Sidebar 1 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 2',
	                           'id' => 'feather-sidebar-2',
	                           'description' => 'Sidebar 2 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 3',
	                           'id' => 'feather-sidebar-3',
	                           'description' => 'Sidebar 3 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 4',
	                           'id' => 'feather-sidebar-4',
	                           'description' => 'Sidebar 4 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 5',
	                           'id' => 'feather-sidebar-5',
	                           'description' => 'Sidebar 5 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 6',
	                           'id' => 'feather-sidebar-6',
	                           'description' => 'Sidebar 6 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 7',
	                           'id' => 'feather-sidebar-7',
	                           'description' => 'Sidebar 7 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 8',
	                           'id' => 'feather-sidebar-8',
	                           'description' => 'Sidebar 8 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 9',
	                           'id' => 'feather-sidebar-9',
	                           'description' => 'Sidebar 9 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));

	register_sidebar(array(
	                           'name' => 'Sidebar 10',
	                           'id' => 'feather-sidebar-10',
	                           'description' => 'Sidebar 10 Widgets',
	                           'before_widget' => '<!-- single widget  -->
	                            <div class="widget">',
	                           'after_widget' => '</div><!-- end widget content --></div><!-- end widget -->',
	                           'before_title' => '<h3>',
	                           'after_title' => '</h3><div class="widget-content">'
	                           ));
}
add_action('widgets_init' , 'feather_sidebars');



/* -------------------------------------------------------------- 
 Post Formats Preparation
-------------------------------------------------------------- */
    function post_formats_preparation($post_format = '')
    {

          // Addons Path
          $path = get_template_directory() . '/theme-addons/post-formats/';

          
          if($post_format != '')
          {

              switch($post_format)
              {

                      case 'video' :
                        require($path . '/video.php');
                        break;

                      case 'audio' :
                        require($path . '/audio.php');
                        break;

                     
                      case 'image' :
                        require($path . '/image.php');
                        break;

                      case 'gallery' :
                        require($path . '/gallery.php');
                        break;

                      case 'link' :
                        require($path . '/link.php');
                        break;

                        case 'status' :
                        require($path . '/status.php');
                        break;


                      
              }
            }// end if
    }


 /* -------------------------------------------------------------- 
   Loops
  -------------------------------------------------------------- */
  function dsf_get_loop($loop){
        if($loop && file_exists(get_template_directory() . '/theme-addons/loops/' . $loop))
        {
            require_once(get_template_directory() . '/theme-addons/loops/' . $loop);
        }
  }


/* -------------------------------------------------------------- 
 	Twitter Handler
-------------------------------------------------------------- */

function dsf_twitter($limit = 1  , $twitter_id = '' , $enable_id)
{     
	global $feather_theme_options;
    require_once(get_template_directory() . '/theme-addons/includes/twitter_oauth/twitteroauth/twitteroauth.php');
    $consumer_key = $feather_theme_options['twitter_consumer_key'];
    $consumer_secret = $feather_theme_options['twitter_consumer_secret'];
    $access_token = $feather_theme_options['twitter_access_token'];
    $access_token_secret = $feather_theme_options['twitter_access_token_secret'];
    $settings = array(
        'oauth_access_token' => $access_token,
        'oauth_access_token_secret' => $access_token_secret,
        'consumer_key' => $consumer_key,
        'consumer_secret' => $consumer_secret
    );
    
    $twitterconn = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
    $latesttweets = $twitterconn->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_id."&count=".$limit);
    if($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != '')
    {


            foreach($latesttweets as $tweet ){
                  echo '<div class="tweet"><p>';
                 
                  $output =  preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a class="custom" href="$1" target="_blank">$1</a>', $tweet->text);
                  echo preg_replace('/(^|\s)@([a-z0-9_]+)/i',
                                  '$1<a href="http://www.twitter.com/$2">@$2</a>',
                                   $output);
                  echo '</p></div>';
            }

            if($enable_id == 'true') {
            echo '<a target="_blank" href="http://twitter.com/'.$twitter_id.'" class="follow-us"><span class="bg"></span>'.__('Follow Us!' , 'dsf').'</a>';
        	}
          
    }
   
}   


/* -------------------------------------------------------------- 
       Theme Widgets
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/widgets/widget-categories.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-twitter.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-dribbble.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-flickr.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-recent-comments.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-social.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-top-posts.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-ads.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-instagram.php');
require_once(get_template_directory() . '/theme-addons/widgets/widget-author-info.php');


/* -------------------------------------------------------------- 
       Theme Shortcodes
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/shortcodes/theme-shortcodes.php');
require_once(get_template_directory() . '/theme-addons/shortcodes/manager/tinymce.php');

/* -------------------------------------------------------------- 
 	Post Meta
-------------------------------------------------------------- */
require_once(get_template_directory() . '/theme-addons/post-meta/post-meta-fields.php');
require_once(get_template_directory() . '/theme-addons/post-meta/sidebars-meta.php');
/* -------------------------------------------------------------- 
   Pinterest Share Button // Works for image and gallery 
  -------------------------------------------------------------- */
  function pinterest_share($id)
  {
          $url  = 'http://pinterest.com/pin/create/button/?source_url=' . get_permalink() . '&media=';
          if($id != '')
          { 
                  if(get_post_format() != '')
                  { 
                        switch(get_post_format($id))
                        { 
                                case 'image' :
                                  $post_thumbnail_id = get_post_thumbnail_id($id);
                                  $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                                  $url .= $post_thumbnail_url;
                                  break;


                              

                                case 'gallery' :
                                  $images = explode(',' , str_replace(',,' , ',' , get_post_meta($id  , 'buzz_media_gallery' , true)));
                                  if(is_array($images)) $url .= $images[0];
                                  break;


                                default:
                                    if(has_post_thumbnail($id))
                                    {
                                      $post_thumbnail_id = get_post_thumbnail_id($id);
                                      $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                                      $url .= $post_thumbnail_url;
                                    }

                        }
                  }
                 
                 
          }
          $url .= '&description=' . get_the_title();
          return '<a target="_blank" href="'.$url.'" class="pinterest"></a>';
  }
function feather_share_post()
{		
		global $feather_theme_options;
		if(isset($feather_theme_options['enable_share']) && $feather_theme_options['enable_share'] != 0) :
		?>
		<a href="#" class="share-text"><?php _e('Share' ,'dsf'); ?></a>


		<?php if(isset($feather_theme_options['share_buttons']) && $feather_theme_options['share_buttons'] == 'native') : ?>
			
		<div class="share-box">
			

					<div class="button">

					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=135560336519178";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-share-button" data-href="<?php echo get_permalink(); ?>" data-type="button_count"></div>
					</div>
					<!-- end button -->


					<div class="button">
								
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>">Tweet</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


					</div>



		</div>
		<!-- end share box -->
		

		<?php else : ?>

		<!-- share box -->
		<div class="share-box">
		        

		        <div class="social-icons">
		            
		                
		                <a target="_blank" name="fb_share" class="facebook" type="button" href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&amp;t=<?php echo get_the_title(); ?>"></a>
		                <a target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo get_permalink(); ?>&amp;shortened_url=<?php echo get_permalink(); ?>&amp;text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>" class="twitter"></a>

		                <?php 
		                
		                if(function_exists('pinterest_share')) 
		                    echo pinterest_share(get_the_ID()); 
		                ?>

		                <a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="google"></a>

		        </div>
		        <!-- end social icons -->                                            
		        
		        


		</div>
		<!-- end share box -->
		<?php endif; // end if share buttons == type ?>
		<?php
		endif;
}


/* -------------------------------------------------------------- 
 	Numeric Pagination
-------------------------------------------------------------- */
function dsf_pagination($paged , $max)
{
			$return = '<ul>';
            $pag_args = array(
                'before'           => '<li>',
                'after'            => '</li>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'nextpagelink'     => '',
                'previouspagelink' => '',
                'pagelink'         => '%',
                'echo'             => 1
            );
            
            wp_link_pages( $pag_args ); 


            if($paged > 2)
              {
                $return .= '<li><a href="'.get_pagenum_link(1).'">1</a></li>';
              } 
              if(($paged - 1) > 0)
              {
                        $return .= '<li><a href="'.get_pagenum_link($paged - 1).'">'.($paged - 1).'</a></li>';
              }
              elseif (($paged - 2) > 0) {
                        $return .= '<li><a href="'.get_pagenum_link(($paged - 2)).'">'.($paged - 2).'</a></li>';
              }
               

             // print pages links
              for($a = 1; $a <= $max; $a++)
              {
                
                if($a == $paged) $return .= '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                elseif($paged == 0 && $a == 1) $return .= '<li><a class="active" href="'.get_pagenum_link($a).'">'.$a.'</a></li>';
                
              }

               if(($paged + 1) < $max  )
               {
                    $return .=  '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li><li><a href="'.get_pagenum_link($paged + 2).'">'.($paged + 2).'</a></li>';
               }elseif(($paged + 1) == $max)
               {
                        $return .=  '<li><a href="'.get_pagenum_link($paged + 1).'">'.($paged + 1).'</a></li>';
               }
               if(($paged + 2) < $max)
               {
                    $return .=  '<li><a href="javascript:void(0)">...</a></li><li><a href="'.get_pagenum_link($max).'">'.$max.'</a></li>';
               }

        $return .= '</ul>';

        return $return;
}



/* -------------------------------------------------------------- 
      Comments
      -------------------------------------------------------------- */
      function ds_list_comments($comment , $args , $depth) 
      {

        $GLOBALS['comment'] = $comment;
        extract($args);



        ?>


            <!-- single comment --> 
            <div id="<?php echo get_comment_ID(); ?>" class="single-comment  <?php if($depth > 1) echo 'sub-comment'; ?>
            <?php echo implode(' ' , get_comment_class('Depth')); ?>" id="comment-id-<?php comment_ID(); ?>">

            <!-- avatar -->
            <div class="avatar"><?php echo get_avatar( $comment->comment_author_email, 54 ); ?></div>

            <!-- comment content -->
            <div class="comment-content">
              

              <h4><a href="<?php 
                  if($comment->user_id > 0)
                  {
                      echo get_author_posts_url($comment->user_id); 
                      
                  }elseif(get_comment_author_url() != '')
                  {
                      echo get_comment_author_url();
                  }
                  else{
                      echo '#';
                  }
                  

                  ?>"><?php echo $comment->comment_author; ?></a></h4>
                <span class="comment-date"><?php 
                      echo __('about ' , 'dsf') . human_time_diff( get_comment_date('U'), current_time('timestamp') ) . ' ago'; ?></span>
                
               

                <div class="comment-body"> 
                      <?php if($comment->comment_approved == 0) : ?>
                      <p><?php echo __('Your comment is awaiting moderation' , 'dsf'); ?></p>
                      <?php else : ?>
                      <p><?php echo $comment->comment_content; ?></p>
                      <?php endif; ?>

                      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                </div>
                <!-- end comment body -->

              



            </div>
            <!-- end comment content -->
             
           

          <?php
      }


// fix comments reply button
add_filter('comment_reply_link', 'replace_reply_link_class');


function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='reply button", $class);
    return $class;
}


function tb(){
    wp_enqueue_script('thickbox',null,array('jquery'));
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
}
add_action('init','tb');




/* -------------------------------------------------------------- 
 	Read More Links
-------------------------------------------------------------- */
function feather_content_more( $link ) {


	// check if read more button is enabled
	global $feather_theme_options;
	$readmore_text = isset($feather_theme_options['readmore_text']) ? $feather_theme_options['readmore_text'] : __('Read More' , 'dsf');
	if($readmore_text == '') $readmore_text = __('Read More' , 'dsf');
	if(isset($feather_theme_options) && $feather_theme_options['enable_readmore'] != 0) {

			// check if there's a read more button (if post have more tag)
			if($link != '')
			{
					$link = '<div class="clearfix"></div>';
					$link .= '<!-- read more button -->';
			        $link .= '<div class="readmore">';        
					$link .= '<a href="'.get_permalink().'" class="readmore-button button">'.$readmore_text.'</a>';
			        $link .= '</div><!-- ene read more -->';
			}
	}
	else{
			$link = '';
	}
			
			return $link;
}
add_filter( 'the_content_more_link', 'feather_content_more' );



 /* -------------------------------------------------------------- 
  Fix Empty Widget title
  -------------------------------------------------------------- */


 /**
 * Fix Widget Empty Title , this will fix empty title for all widgets 
 * and will add cutom 'before_widget' parameter for search widget
 */

function widget_empty_title($output='') {
	if ($output == '') {
		return '<span style="display: none;" class="empty">&nbsp;</span>';
	}
	return $output;
}
add_filter('widget_title', 'widget_empty_title');



/* -------------------------------------------------------------- 
     Check comments pagination
    -------------------------------------------------------------- */
    function dsf_check_comments($id)
    {

          $count = 0;
          $pagination = get_option('comments_per_page');
          if(is_numeric($id) && $pagination)
          {
                $get_comments = get_comments(array(
                        'post_id' => $id 
                        
                ));


                foreach ($get_comments as $comment) {
                        if($comment->comment_parent == 0) $count = $count + 1;
                }
          }
          if($count >= $pagination) return 'true';
    }




/* -------------------------------------------------------------- 
 	Blog Ajax
-------------------------------------------------------------- */
add_action('wp_ajax_feather_load_posts'  , 'feather_load_posts');
add_action('wp_ajax_nopriv_feather_load_posts', 'feather_load_posts');
function feather_load_posts()
{


	  /*
			$page_number current paged number
			$theme_option theme settings
			$ajax_limit how many posts to load in ajax
			$blog_order blog posts order
			$posts_limit main posts limit for blog pages	
	  */	
	  $page_number = (isset($_GET['page_number'])) ? $_GET['page_number'] : 1;  
      $theme_option = get_option('feather');
      $ajax_limit =  (isset($theme_option['ajax_limit']) && $theme_option['ajax_limit'] != '') ? $theme_option['ajax_limit'] : 1;
      $blog_order =  $theme_option['blog_order'] ? $theme_option['blog_order'] : 'date';
      $posts_limit = $theme_option['limit_posts'] ? $theme_option['limit_posts'] : 5;
      $offset = (isset($_GET['offset'])) ? $_GET['offset'] : 1;  

      // the query
      $loop_args = array(
            'posts_per_page' => $ajax_limit,
            'paged' =>  $page_number,
            'orderby' => $blog_order,
            'post_type' => 'post',
            'offset' => $offset,
            'post_status' => 'publish'
        );


      $loop_query = new WP_Query($loop_args);

      if($loop_query->have_posts()) : while($loop_query->have_posts()) : $loop_query->the_post(); ?>

							
		<!-- single post [post with image] -->
		<?php if(is_sticky()) : ?>
		<div <?php post_class('single-post sticky'); ?>>
		<?php else : ?>
		<div <?php post_class('single-post'); ?>>
		<?php endif; ?>





				<!-- post format -->
				<?php 
		        if(function_exists('post_formats_preparation') && get_post_format() != 'quote')
				{
						post_formats_preparation(get_post_format());
				} ?>

				
				<!-- 
					check if post is quote or normal post content 
					handle quote post type individually 
				 -->
				<?php if(get_post_format() != 'quote') : ?>
				<!-- post content  / normal post content -->
                <div class="post-content">
                    

                    <div class="post-content-inner-wrapper">
								
								
								    <!-- post inner content -->
                                    <div class="post-inner-content">
                                            
                                            <h2 class="post-header"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>


                                            
                                             <!-- meta -->
                                            <div class="post-meta">
                                                    
                                                <span class="date-span"><i class="fa fa-lg fa-clock-o"></i><a href="<?php echo get_permalink(); ?>"><?php echo __(get_the_date('d M , Y') , 'dsf'); ?></a></span>
                                                <span class="comments-span"><i class="fa fa-lg fa-comments"></i><a href="<?php echo get_permalink(); ?>#comments"><?php echo comments_number(); ?></a></span>
                                                <span class="share-post-span share-post"><i class="fa fa-lg fa-share"></i><?php if(function_exists('feather_share_post')) feather_share_post(); ?></span>
                                               
                                            </div>
                                            <!-- end post meta -->
											
											<div class="clearfix"></div>


                                            <!-- post main content -->
                                            <div class="main-content">
                                                    

                                                   <?php the_content(); ?>                                            


                                            </div>
                                            <!-- end main content -->
                                                
                                            


                                    </div>
                                    <!-- end inner content -->



                    </div>
                    <!-- end post-content-inner-wrapper -->

               	</div><!-- end post content -->
               	<?php elseif(get_post_format() == 'quote') : ?>
				
				<!-- quote post content -->
                <div class="post-image post-format-quote">
                    
                    <?php if(get_post_meta(get_the_ID() , 'quote-link' , true) == 'on') echo '<a href="'.get_permalink().'">'; ?>
                    <div class="wrapper">

                        <?php if(has_post_thumbnail(get_the_ID())) {

									$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'feather-post');
								    $imagesrc = $imagesrc[0];
									?>
								    <img src="<?php echo $imagesrc; ?>" alt="<?php echo get_the_title(); ?>">

                       <?php } ?>

                        <?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
                        	<div class="quote">
                            
                            <p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
                            <span class="author"><?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></span>                                       


                        	</div>
                        <!-- end quote -->
                        <?php endif; ?>
                    
                    </div>
                    <!-- end wrapper -->
                    <?php if(get_post_meta(get_the_ID() , 'quote-link' , true) == 'on') echo '</a>'; ?>

                </div>
                <!-- end post image -->

               	<?php endif; // end if post format not == quote ?>
               

        


        </div><!-- end single post -->

			<?php endwhile; endif;  ?>
          
       
                        
                            
       


        <?php wp_reset_query(); 

      die();
}



 /* -------------------------------------------------------------- 
   Fix Blog Pagination Links
  -------------------------------------------------------------- */
function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="next" href=', $format);
     return $format;
}
add_filter('next_posts_link', 'posts_link_prev_class');
    
if ( ! isset( $content_width ) ) $content_width = 940;

update_option('posts_per_page' , 1);

?>