<?php 

/**
 * Featrher Top Posts Widget 
 * Featrher Theme
 */
class Featrher_TopPosts extends WP_Widget
{
	 function Featrher_TopPosts(){

        $widget_ops = array('classname' => 'Featrher-topposts','description' => __( "Featrher Popular Posts Widget" ,'dsf') );
		    $this->WP_Widget('Featrher-topposts', __('Featrher Popular Posts Widget','dsf'), $widget_ops);
       
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Popular Posts' , 'dsf');
        $limit = ($instance['limit']) ? $instance['limit'] : 5;
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
		
		/**
		 * Widget Content
		 */
    ?>
      
    
    <!-- recent posts -->
          <div class="recent-posts-wrapper">
              


                <?php 

                  $featured_args = array(
                      'posts_per_page' => $limit + 1 ,
                      'orderby' => 'comment_count',
                      'order' => 'DESC',
                      'ignore_sticky_posts' => 1
                    );


                  $featured_query = new WP_Query($featured_args);

                  /**
                   * Check if zilla likes plugin exists
                   */
                  if($featured_query->have_posts()) : while($featured_query->have_posts()) : $featured_query->the_post();

                    ?>


                        <?php if(get_the_content() != '') : ?>


                        <!-- post -->
                        <div class="post">

                          <!-- image -->
                          <div class="post-image <?php echo get_post_format(); ?>">
                               
                                <a href="<?php echo get_permalink(); ?>"><?php 
                                if(get_post_format() != 'quote') {
                                  echo get_the_post_thumbnail(get_the_ID() , 'feather-widget-post');
                                }
                                 ?></a>

                          </div>
                          <!-- end post image -->


                          <!-- content -->
                          <div class="post-content">
                            
                              <a href="<?php echo get_permalink(); ?>"><span class="date"><?php echo get_the_date('d M , Y'); ?></span><br /><p><?php echo get_the_title(); ?></p></a>


                          </div>
                          <!-- end content -->




                          

                        </div>
                        <!-- end post -->

                        <?php endif; ?>


                    <?php

                  endwhile; endif; wp_reset_query();

                 ?>



          </div>
          <!-- end posts wrapper -->
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Popular Posts' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 5;
      


    	?>


      <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />

      <b><label style="width:100px;" for="<?php echo $this->get_field_id('limit'); ?>">
      <?php _e('Limit Posts Number ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['limit']); ?>"
                                   name="<?php echo $this->get_field_name('limit'); ?>"
                 id="<?php $this->get_field_id('limit'); ?>" />


                 <br />


   

    	<?php
    }




}


function reg_top_posts()
{
	register_widget('Featrher_TopPosts');
}
add_action('widgets_init' , 'reg_top_posts');

?>