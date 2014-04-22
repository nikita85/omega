<?php 
header('Content-Type: text/css');
/**
 * This will fetch custom theme style from the backend
 */
define('WP_USE_THEMES', false);
require_once('../../../../../wp-load.php');

// prepare options 
$options                  = get_option('feather');
$background_image =   $options['background_image'];
$background_color         = $options['background_color']; // solid value
$content_font             = $options['body_font']; // [font-family] ['line-height'] .. 
$content_font_two         = $options['body_font_two'];
$placeholders             = $options['body_placeholder'];
$headers_font             = $options['body_headers']; // only font-family and color
$sidebar_headers          = $options['sidebar_headers'];
$sidebar_font             = $options['sidebar_font']; // ['font-family'] ['font-size'] .. 
$content_link_color = $options['body_link_color'];
$content_link_hover       = $options['body_link_hover_color']; // solid value
$sidebar_link_color = $options['sidebar_link_color'];
$sidebar_link_hover_color = $options['sidebar_link_hover_color']; // solid value
$sidebar_twitter_link_color           = $options['sidebar_twitter_link_color']; // solid value
$comments_headers         = $options['comments_headers']; // solid value
$comments_color           = $options['comments_color']; // solid value
$custom_css               = $options['custom_css']; // solid value
$pattern                  = isset($options['background_pattern']) ? $options['background_pattern'] : ''; // background patterns 
$buttons_color = $options['buttons_color'];
$buttons_hover_color = $options['buttons_hover_color'];
$menu_color = $options['menu_color'];
$menu_hover_color = $options['menu_hover_color'];
$pagination_hover_color = $options['pagination_hover_color'];
$meta_color = $options['meta_font_color'];
$meta_hover_color = $options['meta_hover_color'];
$nav_margin = $options['nav_margin'];
$header_background_color = $options['header_background_color'];
$quote_bg = $options['quote_bg'];
$loadmorebg = $options['loadmorebg'];
$loadmorecolor = $options['loadmorecolor'];
$loadmorehover = $options['loadmorehover'];

?>

/* background image */
<?php if(isset($background_image) && $background_image['url'] != '') : ?>
body {
  background-image: url(<?php echo $background_image['url']; ?>);
  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
<?php endif; ?>

/* Background Color  */
<?php if($background_color != '') : ?>
body {

  background-color: <?php echo $background_color; ?>;
}
<?php endif; ?>


/* backgorund patterns */
<?php if($pattern != '' && $background_image['url'] == '') : ?>
body {
background-image: url(<?php echo $pattern; ?>);
background-attachment: fixed !important;
background-repeat: repeat;
 -webkit-background-size: none;
  -moz-background-size: none;
  -o-background-size: none;
  background-size: none;
}
<?php endif; ?>


<?php if($content_font != '') : ?>
/* content font */
.post-inner-content .main-content ul , .post-inner-content .main-content .gallery-caption , .post-inner-content .main-content footer p , .post-inner-content .main-content li a , .post-inner-content .main-content  p , .post-inner-content .main-content span , .post-inner-content .main-content article 
, .post-inner-content .main-content nav , .post-inner-content .main-content blockquote , .post-inner-content .main-content dl , .post-inner-content .main-content  dt , .post-inner-content .main-content dd , .post-inner-content .main-content td ,  .post-inner-content .main-content tr , .post-inner-content .main-content th , .post-inner-content .main-content code , .post-inner-content .main-content caption , .post-inner-content .main-content figcaption , .post-inner-content .main-content input , .post-inner-content .main-content label , .post-inner-content .main-content textarea , #blog .post-inner-content .main-content a ,
.wpcf7-form input[type=text] , .post-inner-content .main-content .wpcf7-form input[type=email] , .post-inner-content .main-content .wpcf7-form textarea , .author-bio p ,
.single-blog-page .post-inner-content ul , .single-blog-page .post-inner-content .gallery-caption , .single-blog-page .post-inner-content footer p , .single-blog-page .post-inner-content li a , .single-blog-page .post-inner-content  p , .single-blog-page .post-inner-content span , .single-blog-page .post-inner-content article 
, .single-blog-page .post-inner-content nav , .single-blog-page .post-inner-content blockquote , .single-blog-page .post-inner-content dl , .single-blog-page .post-inner-content  dt , .single-blog-page .post-inner-content dd , .single-blog-page .post-inner-content td ,  .single-blog-page .post-inner-content tr , .single-blog-page .post-inner-content th , .single-blog-page .post-inner-content code , .single-blog-page .post-inner-content caption , .single-blog-page .post-inner-content figcaption , .single-blog-page .post-inner-content input , .single-blog-page .post-inner-content label 
{

    <?php 

    if($content_font['font-family'] != '') echo 'font-family: "'.$content_font['font-family'].'" , sans-serif;'; 
    if($content_font['font-weight'] != '') echo 'font-style: '.$content_font['font-weight'].';';
    if($content_font['font-size'] != '') echo 'font-size: '.$content_font['font-size'].';';
    if($content_font['line-height'] != '') echo 'line-height: '.$content_font['line-height'].';';
    if($content_font['font-style'] != '') echo 'font-style: '.$content_font['font-style'].';';
    if($content_font['letter-spacing'] != '' && $content_font['letter-spacing'] !== 'px') echo 'letter-spacing: '.$content_font['letter-spacing'].';';
    if($content_font['color'] != '') echo 'color:'.$content_font['color'].' ;';

    ?>

}
<?php endif; ?>


/* light text color */
<?php if($content_font_two != '') : ?>
#blog .light-font , blockquote , .post-share .tags a ,  
.accordion a , .accordion p , .accordion ul li:before ,  .related-posts-wrapper ul li a , .related-posts-wrapper ul li:before
{
    color: <?php echo $content_font_two; ?> !important;
}
<?php endif; ?>


<?php if($meta_color != '') : ?>
.single-post .post-meta span a , .single-post .post-meta span i {
  color: <?php echo $meta_color; ?> !important;
}
<?php endif; ?>


<?php if($meta_hover_color != '') : ?>
  .single-post .post-meta span:hover a, .single-post .post-meta span:hover i {
  color: <?php echo $meta_hover_color; ?> !important;
}

<?php endif; ?>


/* placeholders color */
<?php if($placeholders != '') : ?>
input::-webkit-input-placeholder , input:-moz-placeholder , .wpc7-form textarea , .wpc7-form input[type=text] , .wpc7-form input[type=email]  , input[type=text] , input[type=email] , textarea {
  color: <?php echo $placeholders; ?> !important;
}
<?php endif; ?>


/* post headers color and font*/
  h1 , h1 a , h1 span ,
  h2 , h2 a , h2 span , 
  h3 , h3 a , h3 span , 
  h4 , h4 a , h4 span , 
  h5 , h5 a , h5 span , 
  h6 , h6 a , h6 span 
  {
    <?php 
    if($headers_font['font-family'] != '') echo 'font-family: "'.$headers_font['font-family'].'" , sans-serif;'; 
    if($headers_font['font-weight'] != '') echo 'font-weight: '.$headers_font['font-weight'].';';
    if($headers_font['font-style'] != '') echo 'font-style: '.$headers_font['font-style'].';';
    if($headers_font['letter-spacing'] != '' && $headers_font['letter-spacing'] !== 'px') echo 'letter-spacing: '.$headers_font['letter-spacing'].';';
    if($headers_font['color'] != '') echo 'color:'.$headers_font['color'].' ;';
    ?>
  }


/* comments typo related posts typo */
.single-comment .comment-content p , .comments span.comment-date  {
  color: <?php echo $comments_color; ?> !important;
}

/* comments and author headers color and font */
  author-bio h1 , .author-bio h1 a , .author-bio h1 span , 
  .author-bio h2 , .author-bio h2 a , .author-bio h2 span , 
  .author-bio h3 , .author-bio h3 a , .author-bio h3 span ,
  .author-bio h4 , .author-bio h4 a , .author-bio h4 span ,
  .author-bio h5 , .author-bio h5 a , .author-bio h5 span , 
  .author-bio h6 , .author-bio h6 a , .author-bio h6 span ,
  .comments h1 , .comments h1 a , .comments h1 span ,
  .comments h2 , .comments h2 a , .comments h2 span , 
  .comments h3 , .comments h3 a , .comments h3 span , 
  .comments h4 , .comments h4 a , .comments h4 span , 
  .comments h5 , .comments h5 a , .comments h5 span , 
  .comments h6 , .comments h6 a , .comments h6 span , .comments-form h2,
  .related-posts h4 , #respond h4
  {
        <?php 
        if($comments_headers['font-family'] != '') echo 'font-family: "'.$comments_headers['font-family'].'" , sans-serif;'; 
        if($comments_headers['font-weight'] != '') echo 'font-weight: '.$comments_headers['font-weight'].';';
        if($comments_headers['font-style'] != '') echo 'font-style: '.$comments_headers['font-style'].';';
        if($comments_headers['letter-spacing'] != '' && $comments_headers['letter-spacing'] !== 'px') echo 'letter-spacing: '.$comments_headers['letter-spacing'].';';
        if($comments_headers['color'] != '') echo 'color:'.$comments_headers['color'].' !important;';
        ?>
  }

/* button color */

/* button hover color */

/* link color */
#blog .post-inner-content .main-content a , #blog .post-inner-content .main-content a:focus , #blog .post-inner-content .main-content ul li a {
  color: <?php echo $content_link_color; ?> !important;
} 

/* link color hover */
#blog .post-inner-content .main-content a:hover , #blog .link-post-wrapper a.light-font:hover , .accordion a:hover  {
  color: <?php echo $content_link_hover; ?> !important;
}


/* menu color */
  nav.menu ul li a {
    color: <?php echo $menu_color; ?> !important;
  }
/* menu hover color */
nav.menu ul li a:hover  {
  color: <?php echo $menu_hover_color; ?> !important;
}
 nav.menu > ul > li >  ul {
    border-top-color: <?php echo $menu_hover_color; ?> !important;
 }
nav.menu > ul > li >  ul:before {
  border-bottom-color: <?php echo $menu_hover_color; ?> !important;
}

/* sidebar headers color and font */
#sidebar h1 , #sidebar h1 a , #sidebar h1 span ,
#sidebar h2 , #sidebar h2 a , #sidebar h2 span , 
#sidebar h3 , #sidebar h3 a , #sidebar h3 span , 
#sidebar h4 , #sidebar h4 a , #sidebar h4 span , 
#sidebar h5 , #sidebar h5 a , #sidebar h5 span , 
#sidebar h6 , #sidebar h6 a , #sidebar h6 span 
  {
       <?php 
        if($sidebar_headers['font-family'] != '') echo 'font-family: "'.$sidebar_headers['font-family'].'" , sans-serif !important;'; 
        if($sidebar_headers['font-weight'] != '') echo 'font-weight: '.$sidebar_headers['font-weight'].';';
        if($sidebar_headers['font-style'] != '') echo 'font-style: '.$sidebar_headers['font-style'].';';
        if($sidebar_headers['letter-spacing'] != '' && $sidebar_headers['letter-spacing'] !== 'px') echo 'letter-spacing: '.$sidebar_headers['letter-spacing'].';';
        if($sidebar_headers['color'] != '') echo 'color:'.$sidebar_headers['color'].' ;';
        ?>
  }

/* sidebar typo */
#sidebar ul , #sidebar .gallery-caption , #sidebar footer p , #sidebar li a , #sidebar  p , #sidebar span , #sidebar article , #sidebar a 
, #sidebar nav , #sidebar blockquote , #sidebar dl , #sidebar  dt , #sidebar dd , #sidebar td , #sidebar tr , #sidebar th , #sidebar code , #sidebar caption , #sidebar figcaption , #sidebar input , #sidebar label , #sidebar textarea a
{
    <?php 

        if($sidebar_font['font-family'] != '') echo 'font-family: "'.$sidebar_font['font-family'].'" , sans-serif;'; 
        if($sidebar_font['font-weight'] != '') echo 'font-style: '.$sidebar_font['font-weight'].';';
        if($sidebar_font['font-size'] != '') echo 'font-size: '.$sidebar_font['font-size'].';';
        if($sidebar_font['line-height'] != '') echo 'line-height: '.$sidebar_font['line-height'].';';
        if($sidebar_font['font-style'] != '') echo 'font-style: '.$sidebar_font['font-style'].';';
        if($sidebar_font['letter-spacing'] != '' && $sidebar_font['letter-spacing'] !== 'px') echo 'letter-spacing: '.$sidebar_font['letter-spacing'].';';
        if($sidebar_font['color'] != '') echo 'color:'.$sidebar_font['color'].' ;';

    ?>
}




/* twitter links  */
#sidebar .twitter-container .tweet a {
  color: <?php echo $sidebar_twitter_link_color; ?> !important;
}


/* sidebar link color */
<?php if($sidebar_link_color != '') : ?>
#sidebar a {
  color: <?php echo $sidebar_link_color; ?> !important;
}
<?php endif; ?>

#sidebar .widget-content a:hover ,   #sidebar a:hover , #sidebar a:active , #sidebar a:hover p , #sidebar a:hover span , #sidebar .recent-posts-wrapper .post-content:hover a p , #sidebar .recent-posts-wrapper .post-content:hover a span  {
  color: <?php echo $sidebar_link_hover_color; ?> !important;
}

 #sidebar .tagcloud a:hover {
    color: #fff !important;
   }

/* buttons color */
<?php if($buttons_color != '') : ?>
.readmore a , #submit-comment , .wpcf7-submit {
  background-color: <?php echo $buttons_color; ?> !important;
}
<?php endif; ?>

/* buttons hover color */
<?php if($buttons_hover_color != '') : ?>
.readmore a:hover , #submit-comment:hover , .wpcf7-submit:hover , .comment-content .reply:hover {
  background-color: <?php echo $buttons_hover_color; ?> !important;
}
<?php endif; ?>


/* pagination background color */
<?php if($pagination_hover_color != '') : ?>
.blog-pagination   .next-posts a:hover  , .blog-pagination   .prev-posts a:hover , .blog-pagination .wrap  .prev-posts a:hover , .blog-pagination ul li a:hover , 
.blog-pagination ul li a.active {
  background-color: <?php echo $pagination_hover_color; ?>;
}
<?php endif; ?>
.blog-pagination ul li a:hover {
  color: #fff !important;
}


<?php if(isset($nav_margin) && $nav_margin != '' && $nav_margin > 1) : ?>
header .top-content {
  margin-top: <?php echo $nav_margin; ?>px;
}
@media (max-width: 990px) {
  header .top-content {
    margin-top: 0px;
  }
}
<?php endif; ?>



/* header background color */
<?php if(isset($header_background_color) && $header_background_color != '' ) :  ?>
 header#header{
  background-color: <?php echo $header_background_color; ?>;
}
<?php endif; ?>

/* read more color and font size */
#blog .post-inner-content .main-content .readmore a
{
       color: #fff !important;
       font-size: 12px;
       line-height: 12px;
}


<?php if(isset($loadmorebg) && $loadmorebg != '') : ?>
.load-more-button a {
  background-color: <?php echo $loadmorebg; ?>;
}
<?php endif; ?>

<?php if(isset($loadmorecolor) && $loadmorecolor != '') : ?>
.load-more-button a  {
  color: <?php echo $loadmorecolor; ?> !important;
}
<?php endif; ?>


<?php if(isset($loadmorehover) && $loadmorehover != '') : ?>
.load-more-button a:hover  {
  background-color: <?php echo $loadmorehover; ?> !important;
}
<?php endif; ?>


<?php if(isset($quote_bg) && $quote_bg != '') : ?>
.single-post .post-format-quote .wrapper {
  background-color: <?php echo $quote_bg; ?>;
}
<?php endif; ?>

<?php if($custom_css != '') echo $custom_css; ?>

.post-inner-content .main-content img {
  max-width: 100% !important;
  height: auto !important;
}

<?php if(isset($options['enable_share']) && $options['enable_share'] == 0) : ?>
.post-meta span.share-post {
  display: none;
}
<?php endif; ?>