<?php 

/**
 * Twitter
 * Feather Theme
 */
class Feather_Twitter extends WP_Widget
{
	 function Feather_Twitter(){

        $widget_ops = array('classname' => 'Feather-twitter','description' => __( "Feather Twitter Widget" ,'dsf') );
		    $this->WP_Widget('Feather-twitter', __('Feather Twitter Widget','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Twitter' , 'dsf');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;
        $twitter_id = ($instance['twitter_id']) ? $instance['twitter_id'] : '';
        $enable_twitter_id_link = '';
        if(isset($instance['enable_twitter_id_link']))
        $enable_twitter_id_link = $instance['enable_twitter_id_link'] ? $instance['enable_twitter_id_link'] : 'checked';
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


      
      <div class="twitter-container">
                                                    


            <p><?php 
            if($enable_twitter_id_link != '') {
                dsf_twitter($limit , $twitter_id , 'true');
            }else{
                dsf_twitter($limit , $twitter_id , 'false');
            }
            ?></p>



    </div>
    <!-- end twitter container -->
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Twitter' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 3;
      if(!isset($instance['twitter_id'])) $instance['twitter_id'] = '';
      if(!isset($instance['enable_twitter_id_link'])) $instance['enable_twitter_id_link'] = '';


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />

    <b><label style="width:100px;" for="<?php echo $this->get_field_id('twitter_id'); ?>">
      <?php _e('Twitter ID','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['twitter_id']); ?>"
                                   name="<?php echo $this->get_field_name('twitter_id'); ?>"
                 id="<?php $this->get_field_id('twitter_id'); ?>" />


                 <br />

      <b><label style="width:100px;" for="<?php echo $this->get_field_id('limit'); ?>">
      <?php _e('Limit Tweets','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['limit']); ?>"
                                   name="<?php echo $this->get_field_name('limit'); ?>"
                 id="<?php $this->get_field_id('limit'); ?>" />


                 <br />

      <b><label style="width:100px;">
      
      <input type="checkbox"  style="float: left; margin-right: 4px; margin-top: 4px; padding: 3px;"
               name="<?php echo $this->get_field_name('enable_twitter_id_link'); ?>"
         id="<?php $this->get_field_id('enable_twitter_id_link'); ?>" <?php if($instance['enable_twitter_id_link'] != '') echo 'checked=checked '; ?>
         />
         <?php _e('Enable Twitter User Link','dsf') ?></label></b>


      <br /><br />



        

    

     


    	<?php
    }
}


function reg_twitter_widget()
{
	register_widget('Feather_Twitter');
}
add_action('widgets_init' , 'reg_twitter_widget');

?>