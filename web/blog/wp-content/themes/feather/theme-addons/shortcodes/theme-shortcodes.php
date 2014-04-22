<?php 
/*
	Theme Shortcodes
 */

$feather_theme_options = get_option('feather');

 /* -------------------------------------------------------------- 
 	Dividers
  -------------------------------------------------------------- */
add_shortcode('sh_margin' , 'add_margin');
function add_margin($attrs)
{
		extract(shortcode_atts(array('margin' => '40')  , $attrs));
		$margin = $margin / 2;

		return '<div style="margin-top:'.$margin.'px; margin-bottom:'.$margin.'px; float: left; clear: both; width: 100%;" class="margin"></div>';
}


add_shortcode('sh_clear' , 'clear_shortcode');
function clear_shortcode()
{
    return '<!-- clear --><div class="clearfix"></div>';
}


 /* -------------------------------------------------------------- 
   Highlight
  -------------------------------------------------------------- */
  add_shortcode('sh_highlight' , 'add_highlight_sc');
  function add_highlight_sc($attrs , $content)
  {
      return '<span class="highlight">'.do_shortcode($content).'</span>';
  }


 /* -------------------------------------------------------------- 
 	Image
  -------------------------------------------------------------- */
add_shortcode('sh_image' , 'add_image');
function add_image($attrs , $content)
{
		extract(shortcode_atts(array(
				'float' => 'left' ,
				'width' => 'fullwidth'
			) , $attrs));
		if($float == 'left') $margin = 'right'; elseif($float == 'right') $margni = 'left';

		if($width == 'fullwidth')
		{
				return '<div  class="shortcode-img fullwidth">'.$content.'</div>';
		}
		else{
				return '<div style="float: '.$float.'; margin-top: 3px; margin-bottom: 10px; margin-'.$margin.':20px;" class="shortcode-img auto">'.$content.'</div>';
		}
}



 /* -------------------------------------------------------------- 
 	datalist
  -------------------------------------------------------------- */
add_shortcode('sh_datalist' , 'add_datalist');
function add_datalist($attrs , $content)
{
		extract(shortcode_atts(array(
 				'title' => '',
 				'description' => ''
 			) , $attrs));

		return '<div class="contact-info"><dl><dt>'.$title.'</dt><dd>'.$description.'</dd></dl></div>';
}


 /* -------------------------------------------------------------- 
 	Social icons
  -------------------------------------------------------------- */
  add_shortcode('sh_social_icons' , 'social_icons');
  function social_icons($attrs , $content)
  {
        global $feather_theme_options;
				$icons = '<!-- social icons -->
                    <div class="social-icons">';
        ?>
                                

                            <?php if(isset($feather_theme_options['facebook']) && $feather_theme_options['facebook'] != '') : ?>
                            <?php $icons .= '<a href="http://facebook.com/'. $feather_theme_options['facebook'] .'" class="facebook"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['twitter']) && $feather_theme_options['twitter'] != '') : ?>
                            <?php $icons .= '<a href="http://twitter.com/'. $feather_theme_options['twitter'] .'" class="twitter"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['linkedin']) && $feather_theme_options['linkedin'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['linkedin'] .'" class="linkedin"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['dribbble']) && $feather_theme_options['dribbble'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['dribbble'] .'" class="dribbble"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['flickr']) && $feather_theme_options['flickr'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['flickr'] .'" class="flickr"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['skype']) && $feather_theme_options['skype'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['skype'] .'" class="skype"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['pinterest']) && $feather_theme_options['pinterest'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['pinterest'] .'" class="pinterest"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['vimeo']) && $feather_theme_options['vimeo'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['vimeo'] .'" class="vimeo"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['tumblr']) && $feather_theme_options['tumblr'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['tumblr'] .'" class="tumblr"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['youtube']) && $feather_theme_options['youtube'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['youtube'] .'" class="youtube"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['soundcloud']) && $feather_theme_options['soundcloud'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['soundcloud'] .'" class="soundcloud"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['googleplus']) && $feather_theme_options['googleplus'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['googleplus'] .'" class="google"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['instagram']) && $feather_theme_options['instagram'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['instagram'] .'" class="instagram"></a>' ?>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['github']) && $feather_theme_options['github'] != '') : ?>
                            <?php $icons .= '<a href="'. $feather_theme_options['github'] .'" class="github"></a>' ?>
                            <?php endif; ?>


        <?php
        $icons .= '
                    </div>
                    <!-- end social icons -->';

				return $icons;

  }


 /* -------------------------------------------------------------- 
 	Blockquote
  -------------------------------------------------------------- */
  add_shortcode('sh_blockquote' , 'blogify_blockquote');
  function blogify_blockquote($attrs , $content)
  {
  				return '<blockquote class="blockquote">'.do_shortcode($content).'</blockquote>';
  }	


 /* -------------------------------------------------------------- 
 	Accordion
  -------------------------------------------------------------- */

/**
 * Accordion
 */
add_shortcode('sh_accordion','accordion_function');
function accordion_function($attrs, $content){
     
     $attrs = shortcode_atts(array() , $attrs);
     $out_content = '';
     if($content != '') {
            $out_content .= ' <!-- Accordion Container --><div class="accordion">'.$content.'</div><!-- end accordion container -->';
     }
     
     return do_shortcode($out_content);
}


add_shortcode('sh_accordion_item','accordion_item_function');
function accordion_item_function($attrs, $acc_content = null){
   
   
   $attrs = shortcode_atts(array(
                                 'title' => ''
                                 ), $attrs);
   
   
   $out = '';
   
   if($acc_content != '' ) {
            
            
            $out .= ' <!-- item -->    
                        <div class="item">
                        
                        <a href="#" class="head">'.$attrs['title'].'</a>
                        
                        <!-- item content -->
                        <div class="item-content">
                            
                                <p>'.do_shortcode($acc_content).'</p>
                            
                        </div><!-- end -->
                        
                        </div><!-- end item content -->';
   }
   
   return $out;
   
}


 /* -------------------------------------------------------------- 
 	Light Text
  -------------------------------------------------------------- */
  add_shortcode('sh_light_text' , 'light_text');
  function light_text($attrs , $content)
  {
        return '<p class="light-font">'.do_shortcode($content).'</p>';
  }
?>