<?php 

/**
 * AuthorInfo
 * Feather Theme
 */
class Feather_AuthorInfo extends WP_Widget
{
	 function Feather_AuthorInfo(){

        $widget_ops = array('classname' => 'Feather-AuthorInfo','description' => __( "Feather Author Widget" ,'dsf') );
		    $this->WP_Widget('Feather-AuthorInfo', __('Feather Author Widget','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : '';
        $author_name = ($instance['author_name']) ? $instance['author_name'] : __('Author Name' , 'dsf');
        $author_bio = ($instance['author_bio']) ? $instance['author_bio'] : __('About The Author' , 'dsf');
        $author_image = ($instance['author_image']) ? $instance['author_image'] : '';
        $image_auto_width = '';
        if(isset($instance['image_auto_width']))
        $image_auto_width = $instance['image_auto_width'] ? $instance['image_auto_width'] : 'checked';
        
        


                echo $before_widget;
                echo $before_title;
                echo $title;
                echo $after_title;
              
              /**
               * Widget Content
               */
              
              ?>


                
              <div class="author-info-container">
                                                              
                 
                 <?php if(isset($author_image) && $author_image != '') : ?>
                 <div class="image"><img <?php if(isset($image_auto_width) && $image_auto_width == 'on') echo 'style="width: 100%; height: 100%;"'; ?> src="<?php echo $author_image; ?>" alt="<?php echo $author_name; ?>"></div>
                 <?php endif; ?>
                  


                 <!-- content -->
                 <div class="content">
                    
                        <h5><?php echo $author_name; ?></h5>

                        <p>
                          <?php echo $author_bio; ?>
                        </p>


                 </div>
                 <!-- end content -->
                    


              </div>
              <!-- end AuthorInfo container -->
                
              

                    

              <?php

              echo $after_widget;


      
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = '';
      if(!isset($instance['author_name'])) $instance['author_name'] = __('Author Name' , 'dsf');
      if(!isset($instance['author_bio'])) $instance['author_bio'] = __('About The Author' , 'dsf');
      if(!isset($instance['author_image'])) $instance['author_image'] = '';
      if(!isset($instance['image_auto_width'])) $instance['image_auto_width'] = '';


    	?>


      <b><label style="width:100px; margin-top: 20px; float: left; clear: both; width: 100%; margin-bottom: 5px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />

      <br />
      <br />
      <br>

      <b><label style="width:100px; margin-top: 20px; float: left; clear: both; width: 100%; margin-bottom: 5px;" for="<?php echo $this->get_field_id('author_name'); ?>">
      <?php _e('Author Name ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['author_name']); ?>"
                                   name="<?php echo $this->get_field_name('author_name'); ?>"
                 id="<?php $this->get_field_id('author_name'); ?>" />

      <br />
      <br />
      <br>

      <b><label style="width:100px; margin-top: 20px; float: left; clear: both; width: 100%; margin-bottom: 5px;" for="<?php echo $this->get_field_id('author_bio'); ?>">
      <?php _e('Author Bio ','dsf') ?></label></b>
      <br />

      <textarea name="<?php echo $this->get_field_name('author_bio'); ?>" id="<?php echo $this->get_field_id('author_bio'); ?>" style="float:left; clear: both; height: 100px; width: 100%; padding: 3px;"><?php  echo esc_attr($instance['author_bio']); ?></textarea>
      

      <br />
      <br />
      <br />

      <b><label style="width:100px; margin-top: 20px; float: left; clear: both; width: 100%; margin-bottom: 5px;" for="<?php echo $this->get_field_id('author_image'); ?>">
      <?php _e('Author Preview Image ','dsf') ?></label></b>
      <br />

      <input class="upload-field-btn" type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['author_image']); ?>"
                                   name="<?php echo $this->get_field_name('author_image'); ?>"
                 id="<?php $this->get_field_id('author_image'); ?>" />
      
      <div class="wrap-btn" style="float: left; width: 100%; clear: both; margin-top: 10px; margin-bottom: 5px;">
      <a href="#"  class="upload button button-secondary"><?php _e('Select Image' , 'img'); ?></a>
      <p><b>Note:</b> Preferred Image Size Is : 150px / 150px</p>
      </div>


      <br><br><br>
      <b><label style="width:100px; margin-top: 20px; float: left; clear: both; width: 100%; margin-bottom: 25px;">
      

      <input type="checkbox"  style="float: left; margin-right: 4px; margin-top: 2px; padding: 3px;"
               name="<?php echo $this->get_field_name('image_auto_width'); ?>"
         id="<?php $this->get_field_id('image_auto_width'); ?>" <?php if($instance['image_auto_width'] != '') echo 'checked=checked '; ?> /><?php _e('Make the image fit the container div (100% width) ? ','dsf') ?></label></b>
      

      

      
     

    	<?php
    }
}


function reg_AuthorInfo_widget()
{
	register_widget('Feather_AuthorInfo');
}
add_action('widgets_init' , 'reg_AuthorInfo_widget');

?>