<?php 

/**
 * Dribbble Widget 
 * Feather Theme
 */
class Feather_Dribbble extends WP_Widget
{
	 function Feather_Dribbble(){

        $widget_ops = array('classname' => 'Feather-dribbble','description' => __( "Feather Dribbble Shot" ,'dsf') );
		    $this->WP_Widget('Feather-dribbble', __('Feather Dribbble Shot','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Dribbble' , 'dsf');
        $dribbble_id = ($instance['dribbble_id']) ? $instance['dribbble_id'] : '';
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


      
      <?php if(isset($dribbble_id) && $dribbble_id != '') {

            $link = wp_remote_get('http://api.dribbble.com/players/'.$dribbble_id.'/shots?per_page=1');
            $dribbble_json = json_decode($link['body'] , true);
            echo '<a class="dribbble-image" href="'.$dribbble_json['shots'][0]['short_url'].'"><img src="'.$dribbble_json['shots'][0]['image_400_url'].'" alt="'.__('Latest Dribbble Project' , 'dsf').'"></a>';

      } ?>
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Dribbble' , 'dsf');
      if(!isset($instance['dribbble_id'])) $instance['dribbble_id'] = '';


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />



      <b><label style="width:100px;" for="<?php echo $this->get_field_id('dribbble_id'); ?>">
      <?php _e('Dribbble ID ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['dribbble_id']); ?>"
                                   name="<?php echo $this->get_field_name('dribbble_id'); ?>"
                 id="<?php $this->get_field_id('dribbble_id'); ?>" />


                 <br />



        

    

     


    	<?php
    }
}


function reg_dribbble()
{
	register_widget('Feather_Dribbble');
}
add_action('widgets_init' , 'reg_dribbble');

?>