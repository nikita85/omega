<?php 

/**
 * Social  Widget 
 * Feather Theme
 */
class Feather_Social extends WP_Widget
{
	 function Feather_Social(){

        $widget_ops = array('classname' => 'Feather-social','description' => __( "Feather Social Widget" ,'dsf') );
		    $this->WP_Widget('Feather-social', __('Feather Social Widget','dsf'), $widget_ops);
       
    }


    function widget($args , $instance)
    {
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('Keep Social' , 'dsf');
        

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;

      $feather_theme_options = get_option('feather');
		
		/**
		 * Widget Content
		 */
    ?>
      
    <!-- social icons -->
    <div class="social-icons sticky-sidebar-social">
        

                            <?php if(isset($feather_theme_options['facebook']) && $feather_theme_options['facebook'] != '') : ?>
                            <a href="http://facebook.com/<?php echo $feather_theme_options['facebook']; ?>" class="facebook"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['twitter']) && $feather_theme_options['twitter'] != '') : ?>
                            <a href="http://twitter.com/<?php echo $feather_theme_options['twitter']; ?>" class="twitter"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['linkedin']) && $feather_theme_options['linkedin'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['linkedin']; ?>" class="linkedin"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['dribbble']) && $feather_theme_options['dribbble'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['dribbble']; ?>" class="dribbble"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['flickr']) && $feather_theme_options['flickr'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['flickr']; ?>" class="flickr"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['skype']) && $feather_theme_options['skype'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['skype']; ?>" class="skype"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['pinterest']) && $feather_theme_options['pinterest'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['pinterest']; ?>" class="pinterest"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['vimeo']) && $feather_theme_options['vimeo'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['vimeo']; ?>" class="vimeo"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['tumblr']) && $feather_theme_options['tumblr'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['tumblr']; ?>" class="tumblr"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['youtube']) && $feather_theme_options['youtube'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['youtube']; ?>" class="youtube"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['soundcloud']) && $feather_theme_options['soundcloud'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['soundcloud']; ?>" class="soundcloud"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['googleplus']) && $feather_theme_options['googleplus'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['googleplus']; ?>" class="google"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['instagram']) && $feather_theme_options['instagram'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['instagram']; ?>" class="instagram"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['github']) && $feather_theme_options['github'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['github']; ?>" class="github"></a>
                            <?php endif; ?>


    </div>
    <!-- end social icons -->

      
      <?php if(isset($url) && $url != '') {

                echo '<a href="'.$url.'"><img src="'.$href.'" alt="'.$title.'" /></a>';

      } ?>
      
    

		      

		<?php

		echo $after_widget;
    }


    function form($instance)
    {
      if(!isset($instance['title'])) $instance['title'] = __('Keep Social' , 'dsf');
      


    	?>


       <b><label style="width:100px;" for="<?php echo $this->get_field_id('title'); ?>">
      <?php _e('Title ','dsf') ?></label></b>
      <br />

      <input type="text" style="float:left; clear: both; width: 100%; padding: 3px;" value="<?php echo esc_attr($instance['title']); ?>"
                                   name="<?php echo $this->get_field_name('title'); ?>"
                 id="<?php $this->get_field_id('title'); ?>" />


                 <br />


   

    	<?php
    }




}


function reg_social_widget()
{
	register_widget('Feather_Social');
}
add_action('widgets_init' , 'reg_social_widget');

?>