<?php 

/**
 * Ads Widget 
 * Feather Theme
 */
class Feather_Ads extends WP_Widget
{
	 function Feather_Ads(){

        $widget_ops = array('classname' => 'Feather-ads','description' => __( "Feather Ads Widget" ,'dsf') );
		    $this->WP_Widget('Feather-ads', __('Feather Ads Widget','dsf'), $widget_ops);
        // add image js 
        add_action('admin_enqueue_scripts' , array(&$this , 'admin_js') , 99 , 1);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Advertisement' , 'dsf');
        $url = ($instance['url']) ? $instance['url'] : '#';
        $href = ($instance['href']) ? $instance['href'] : '';
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


      
      <?php if(isset($url) && $url != '') {

                echo '<a class="ads-widget-wrapper" href="'.$url.'"><img src="'.$href.'" alt="'.$title.'" /></a>';

      } ?>
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Advertisement' , 'dsf');
      if(!isset($instance['url'])) $instance['url'] = '#';
      if(!isset($instance['href'])) $instance['href'] = '';


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />


      <b><label style="width:100px;" for="<?php echo $this->get_field_id('url'); ?>">
      <?php _e('Link ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['url']); ?>"
                                   name="<?php echo $this->get_field_name('url'); ?>"
                 id="<?php $this->get_field_id('url'); ?>" />


                 <br />
     
      
      <label style="width:100px;" for="<?php echo $this->get_field_id('href'); ?>">
  
      <b><label style="width:100px;" for="<?php echo $this->get_field_id('href'); ?>">
        <?php _e('Ad Image Url','dsf') ?></label></b>
        <br />

        <input class="aboutus-image-field" type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['href']); ?>"
                                     name="<?php echo $this->get_field_name('href'); ?>"
                   id="<?php $this->get_field_id('href'); ?>" />

        
      <a style=" clear: both;" href="#" class="aboutus-upload-image">Add Image</a>
    

     


    	<?php
    }




    /**
     * [admin_js this function will print the rquire js for the media button]
     */
    function admin_js($hook)
    {
      if($hook == 'widgets.php')
      { 
          wp_enqueue_media();
          wp_enqueue_script('wp_enqueue_script' , get_template_directory_uri() . '/theme-addons/widgets/widgets-inc/upload.js');
      }
    }
}


function reg_ads_widget()
{
	register_widget('Feather_Ads');
}
add_action('widgets_init' , 'reg_ads_widget');

?>