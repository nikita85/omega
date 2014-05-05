<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 10 ]><html class="ie ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<?php $feather_theme_options = get_option('feather'); ?>
<head>
    <meta charset="utf-8">
    <?php if(isset($feather_theme_options['enable_basic_seo']) && $feather_theme_options['enable_basic_seo'] != 0) : ?>
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); 
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description"; ?>
    </title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="description" content="<?php 
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo $site_description; ?>">
    <?php else : ?>
    <title><?php wp_title(); ?></title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <?php endif; // end if basic seo is not disabled ?>


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!-- Favicons -->
    <?php if(isset($feather_theme_options['favicon']['url']) && $feather_theme_options['favicon']['url'] != '' ) : ?>
    <link rel="shortcut icon" href="<?php echo $feather_theme_options['favicon']['url']; ?>">
    <?php endif; ?>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('body-container'); ?>>

<?php 

    // If sticky menu enabled
    if(isset($feather_theme_options['sticky_menu']) && $feather_theme_options['sticky_menu'] == 1 ) {
            require_once(get_template_directory() . '/header-template-two.php');
    }  
    else{
            require_once(get_template_directory() . '/header-template-one.php');
    }
?>


