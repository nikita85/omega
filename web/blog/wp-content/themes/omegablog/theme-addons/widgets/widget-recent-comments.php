<?php 

/**
 * Feather Top Posts Widget 
 * Feather Theme
 */
class Feather_RecentComments extends WP_Widget
{
	 function Feather_RecentComments(){

        $widget_ops = array('classname' => 'Feather-comments','description' => __( "Feather Recent Comments" ,'dsf') );
		    $this->WP_Widget('Feather-comments', __('Feather Recent Comments Widget','dsf'), $widget_ops);
       
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Recent Comments' , 'dsf');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;

        

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

                  $args = array(
                      'status' => 'approve' ,
                      'orderby' => 'comment_date_gmt',
                      'order' => 'DESC',
                      'count' => false ,
                      'number'=> $limit
                    );

                  $comments = get_comments($args);

                  
                  foreach($comments as $comment){
                    ?>


                    

                        <!-- post -->
                        <div class="post">

                          <!-- image -->
                          <div class="post-image comment-image">
                               
                                <a href="<?php echo get_permalink($comment->comment_post_ID); ?>">
                                    <?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
                                </a>

                          </div>
                          <!-- end post image -->


                          <!-- content -->
                          <div class="post-content">
                            
                              <a style="font-size: 14px; float: left;" href="<?php echo get_author_posts_url($comment->user_id); ?>"><span class="date">
                                <?php echo $comment->comment_author; ?></span></a><br /><a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><p><?php 

                                           $words = explode(" ",$comment->comment_content);
                                           echo implode(" ",array_splice($words,0,9));

                                ?></p></a>


                          </div>
                          <!-- end content -->




                          

                        </div>
                        <!-- end post -->



                    <?php

                  }

                 ?>



          </div>
          <!-- end posts wrapper -->
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Recent Comments' , 'dsf');
      if(!isset($instance['limit'])) $instance['limit'] = 3;
      


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


function reg_recent_comments()
{
	register_widget('Feather_RecentComments');
}
add_action('widgets_init' , 'reg_recent_comments');

?>