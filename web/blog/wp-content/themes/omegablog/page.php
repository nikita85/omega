<?php get_header();
$feather_theme_options = get_option('feather');
?>
<!-- blog  -->
<section class="blog single-blog-page">
    
            <div class="container">
                <div class="row">

                    <!-- left side -->
                   <div id="blog" class="blog-wrapper col-md-8 col-xs-12">


                    <div class="single-post">

                        <div class="post-content">
                    

                            <div class="post-content-inner-wrapper">
                                
                                
                                 <!-- post inner content -->
                                <div class="post-inner-content">
                                        
                                        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                                                    
                                                    <?php the_content(); ?>

                                        <?php endwhile; endif; wp_reset_query(); ?>
                                         
                                </div>
                                <!-- end inner content -->

                            </div><!-- end inner content wrapper -->

                        </div><!-- end post content -->
                    

                    </div><!-- end single post -->


                   </div>
                   <!-- end left side -->


                    
                    <?php get_sidebar(); ?>


                  
                    
                   <div class="clearfix"></div>


                    


                </div><!-- end row -->
            </div><!-- end container -->
</section><!-- end blog -->
<?php get_footer(); ?>