<?php 

/**
 * Instagram
 * Feather Theme
 */
class Feather_Instagram extends WP_Widget
{
	 function Feather_Instagram(){

        $widget_ops = array('classname' => 'Feather-Instagram','description' => __( "Feather Instagram Widget" ,'dsf') );
		    $this->WP_Widget('Feather-Instagram', __('Feather Instagram Widget','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Instagram' , 'dsf');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;
        $user_id = ($instance['user_id']) ? $instance['user_id'] : '';
        $client_id = ($instance['client_id']) ? $instance['client_id'] : '';
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


    <?php 

    ?>

  
    <div class="ins-container">
      <div class="flexslider">
      <ul class="slides">
                                                    

       <?php  

       $return = '';
       $content = 'https://api.instagram.com/v1/users/'.$user_id.'/media/recent?client_id='.$client_id.'&count='.$limit; 

       $get_content = wp_remote_get($content);


      // check for errors
       if(is_wp_error($get_content))
       {
          $error = $get_content->get_error_message;
          $return .= $error;
       }else{

          $output = json_decode( $get_content['body']);
          if(!empty($output) && is_array($output->data))
          {
               foreach ($output->data as $key => $value) {
                echo '<li><a target="_blank" href="'.$value->link.'"><img src="'.$value->images->standard_resolution->url.'" alt="'.$value->caption->text.'" /></a></li>';
                }

          }
         
       }


       ?>
       </ul>
     </div><!-- end flexslider -->


    </div>
    <!-- end Instagram container -->
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Instagram' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 3;
      if(!isset($instance['client_id'])) $instance['client_id'] = '';
      if(!isset($instance['user_id'])) $instance['user_id'] = '';


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br /><br><br>

     <b><label style="width:100px;" for="<?php echo $this->get_field_id('user_id'); ?>">
      <?php _e('User ID','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['user_id']); ?>"
                                   name="<?php echo $this->get_field_name('user_id'); ?>"
                 id="<?php $this->get_field_id('user_id'); ?>" />

                 <br><br>
                 <p style="opacity: 0.7;">You can get any user id <a href="http://jelled.com/instagram/lookup-user-id">here</a></p>


   

    <b><label style="width:100px;" for="<?php echo $this->get_field_id('client_id'); ?>">
      <?php _e('Client ID','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['client_id']); ?>"
                                   name="<?php echo $this->get_field_name('client_id'); ?>"
                 id="<?php $this->get_field_id('client_id'); ?>" />

      
               

      <br /><br>
  
      <p style="opacity: 0.7;"><b>Note : </b> Check documenations for more information about how to setup your API key .</p>


      <b><label style="width:100px;" for="<?php echo $this->get_field_id('limit'); ?>">
      <?php _e('Limit Query','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['limit']); ?>"
                                   name="<?php echo $this->get_field_name('limit'); ?>"
                 id="<?php $this->get_field_id('limit'); ?>" />


                 <br />

    	<?php
    }
}


function reg_Instagram_widget()
{
	register_widget('Feather_Instagram');
}
add_action('widgets_init' , 'reg_Instagram_widget');

?>