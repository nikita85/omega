<?php get_header(); ?>
<!-- blog  -->
<section class="blog single-page">
    
            <div class="container">
                <div class="row">
                    
                   

                    <!-- single post [post with image] -->
                    <div class="single-post">
                        



                        <!-- post content -->
                        <div class="post-content">
                        
                                        <div id="search-404" class="col-md-12">
                                            

                                                <!-- post inner content -->
                                                <div class="post-inner-content">
                                                        
                                                    <h2 style="margin-bottom: 0px;">
                                                    <?php 
                                                    $get_error_message = get_option('feather');
                                                    if(isset($get_error_message['error404']) && $get_error_message['error404'] != '') echo $$get_error_message['error404']; else echo __('404 , No Page Found .' , 'dsf');
                                                    ?>
                                                    </h2>
                                                         
                                                </div>
                                                <!-- end inner content -->.

                                            
                                            


                                        </div>
                                        <!-- end colmd -->

                        </div><!-- end post content -->


                    </div><!-- end single post -->

                </div><!-- end row -->
            </div><!-- end container -->
</section><!-- end blog -->
<?php get_footer(); ?>