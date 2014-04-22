<?php 

/**
 * Custom Categories Widget 
 * Feather Theme
 */
class Feather_Categories extends WP_Widget
{
	 function Feather_Categories(){

        $widget_ops = array('classname' => 'Feather-cats','description' => __( "Feather Categories" ,'dsf') );
		    $this->WP_Widget('Feather-cats', __('Feather Categories','dsf'), $widget_ops);
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Categories' , 'dsf');
        $enable_count = '';
        if(isset($instance['enable_count']))
        $enable_count = $instance['enable_count'] ? $instance['enable_count'] : 'checked';
      
        $limit = ($instance['limit']) ? $instance['limit'] : 4;
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
		
		?>


    <div class="cats-widget">
      


        <ul><?php 
        if($enable_count != '') {
              $args = array (
              'echo' => 0,
              'show_count' => 1,
              'title_li' => '',
              'depth' => 1 ,
              'orderby' => 'count' ,
              'order' => 'DESC' ,
              'number' => $limit
              );
        }
        else{
            $args = array (
              'echo' => 0,
              'show_count' => 0,
              'title_li' => '',
              'depth' => 1 ,
              'orderby' => 'count' ,
              'order' => 'DESC' ,
              'number' => $limit
              );
        } 
    $variable = wp_list_categories($args);
    $variable = str_replace ( "(" , "<span>", $variable );
    $variable = str_replace ( ")" , "</span>", $variable );
    echo $variable; ?></ul>



    </div>
    <!-- end widget content -->

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Categories' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 4;
      if(!isset($instance['enable_count'])) $instance['enable_count'] = '';



    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />



          <b><label style="width:100px;" for="<?php echo $this->get_field_id('limit'); ?>">
      <?php _e('Limit Categories ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['limit']); ?>"
                                   name="<?php echo $this->get_field_name('limit'); ?>"
                 id="<?php $this->get_field_id('limit'); ?>" />


                 <br />

      <b><label style="width:100px;">
      
      <input type="checkbox"  style="float: left; margin-right: 4px; margin-top: 4px; padding: 3px;"
               name="<?php echo $this->get_field_name('enable_count'); ?>"
         id="<?php $this->get_field_id('enable_count'); ?>" <?php if($instance['enable_count'] != '') echo 'checked=checked '; ?>
         />
         <?php _e('Enable Posts Count','dsf') ?></label></b>


      <br /><br />



    

     


    	<?php
    }
}


function reg_Feather_cats()
{
	register_widget('Feather_Categories');
}
add_action('widgets_init' , 'reg_Feather_cats');

?>