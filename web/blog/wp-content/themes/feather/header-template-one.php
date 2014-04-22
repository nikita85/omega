<!-- header -->
<header id="header" class="header">
        

        <!-- container -->
        <div class="container">

                    <div class="row">


                            <!-- col-xs-12 col-md-12 -->
                            <div class="col-md-12">

                                
                                <?php if(isset($feather_theme_options['logo']['url']) && $feather_theme_options['logo']['url'] != '') : ?>
                                <!-- logo -->
                                <div class="logo">
                                        
                                        <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $feather_theme_options['logo']['url']; ?>" alt="<?php echo get_bloginfo('description', 'display'); ?>"></a>
        
                                </div>
                                <!-- end logo -->
                                <?php else : ?>
                                <!-- logo -->
                                <div class="logo">
                                        
                                        <a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php echo get_bloginfo('description', 'display'); ?>"></a>
        
                                </div>
                                <!-- end logo -->
                                <?php endif; ?>
                            
                                

                                <!-- top content -->
                                <div class="top-content">
                                    


                                               
                                             
                                                <nav class="menu">
                                                    <?php wp_nav_menu(array(
                                                      'theme_location' => 'primary',
                                                      'items_wrap' => '<ul class="sf-menu"><li class="toggle"><a href="#">'.__('Menu' , 'dsf').'</a></li>%3$s</ul>',
                                                      'container' => false
                                                    )); ?>
                                                </nav>

                                                <?php if($feather_theme_options['sidebar_status'] != 3 && !is_page_template('page-fullwidth.php')) : ?>
                                                <!--  toggle  -->
                                                <div class="search">
                                                        
                                                         <a href="#" class="toggleSidebar"></a>
                                                       
                                                </div>
                                                <!-- end search -->
                                                 <?php endif; ?>



                                </div>
                                <!-- end top content -->




                            </div>
                            <!-- end col-mx-12 col-md-12 -->

                    </div>
                    <!-- end row -->

        </div>
        <!-- end container -->

</header><!-- /header -->