<?php 
/*
	Template Name: Blog Page With AJAX 
*/
get_header(); 
$feather_theme_options = get_option('feather');
// Next And Prev Posts For Pagination
$blog_next_post_link = '';
$blog_prev_post_link = '';
$num_pagination = '';
?>
<!-- blog  -->
<section class="blog">
    
            
            <div class="container">
                <div class="row">
                    

                   <!-- left side -->
                   <div id="blog" class="blog-wrapper blog-ajax-wrapper col-md-8 col-xs-12">
                   	
							
							<?php 

                            $blog_limit = isset($feather_theme_options['limit_posts']) ? $feather_theme_options['limit_posts'] : 5;
                            $blog_order = isset($feather_theme_options['blog_order']) ? $feather_theme_options['blog_order'] : 'date';

                            $blog_args = array(
                                'posts_per_page' => $blog_limit ,
                                'post_type' => 'post',
                                'orderby' => $blog_order,
                                'paged' => $paged
                            );

							$blog_query = new WP_Query($blog_args);

		  					if($blog_query->have_posts()) : while($blog_query->have_posts()) : $blog_query->the_post(); ?>
							
							<!-- single post [post with image] -->
							<?php if(is_sticky()) : ?>
							<div <?php post_class('single-post sticky'); ?>>
							<?php else : ?>
							<div <?php post_class('single-post'); ?>>
							<?php endif; ?>





									<!-- post format -->
									<?php 
							        if(function_exists('post_formats_preparation') && get_post_format() != 'quote')
									{
											post_formats_preparation(get_post_format());
									} ?>

									
									<!-- 
										check if post is quote or normal post content 
										handle quote post type individually 
									 -->
									<?php if(get_post_format() != 'quote') : ?>
									<!-- post content  / normal post content -->
		                            <div class="post-content">
		                                

		                                <div class="post-content-inner-wrapper">
													
													
													    <!-- post inner content -->
		                                                <div class="post-inner-content">
		                                                        
		                                                        <h2 class="post-header"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>


		                                                        
		                                                         <!-- meta -->
		                                                        <div class="post-meta">
		                                                                
		                                                            <span class="date-span"><i class="fa fa-lg fa-clock-o"></i><a href="<?php echo get_permalink(); ?>"><?php echo __(get_the_date('d M , Y') , 'dsf'); ?></a></span>
		                                                            <span class="comments-span"><i class="fa fa-lg fa-comments"></i><a href="<?php echo get_permalink(); ?>#comments"><?php echo comments_number(); ?></a></span>
		                                                            <span class="share-post-span share-post"><i class="fa fa-lg fa-share"></i><?php if(function_exists('feather_share_post')) feather_share_post(); ?></span>
		                                                           
		                                                        </div>
		                                                        <!-- end post meta -->
																
																<div class="clearfix"></div>


		                                                        <!-- post main content -->
		                                                        <div class="main-content">
		                                                                

		                                                               <?php
		                                                               	 global $more;
		                                                               	 $more = 0;
		                                                               	 the_content(); ?>                                            


		                                                        </div>
		                                                        <!-- end main content -->
		                                                            
		                                                        


		                                                </div>
		                                                <!-- end inner content -->



		                                </div>
		                                <!-- end post-content-inner-wrapper -->

		                           	</div><!-- end post content -->
		                           	<?php elseif(get_post_format() == 'quote') : ?>
									
									<!-- quote post content -->
		                            <div class="post-image post-format-quote">
		                                
		                                <?php if(get_post_meta(get_the_ID() , 'quote-link' , true) == 'on') echo '<a href="'.get_permalink().'">'; ?>
		                                <div class="wrapper">

		                                    <?php if(has_post_thumbnail(get_the_ID())) {

														$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'feather-post');
													    $imagesrc = $imagesrc[0];
														?>
													    <img src="<?php echo $imagesrc; ?>" alt="<?php echo get_the_title(); ?>">

		                                   <?php } ?>

		                                    <?php if(get_post_meta(get_the_ID() , 'quote' , true) != '') : ?>
		                                    	<div class="quote">
		                                        
		                                        <p><?php echo get_post_meta(get_the_ID() , 'quote' , true); ?></p>
		                                        <span class="author"><?php echo get_post_meta(get_the_ID() , 'quote-author' , true); ?></span>                                       


		                                    	</div>
		                                    <!-- end quote -->
		                                    <?php endif; ?>
		                                
		                                </div>
		                                <!-- end wrapper -->
		                                <?php if(get_post_meta(get_the_ID() , 'quote-link' , true) == 'on') echo '</a>'; ?>

		                            </div>
		                            <!-- end post image -->

		                           	<?php endif; // end if post format not == quote ?>
		                           

		                    


		                    </div><!-- end single post -->

		  					<?php endwhile; endif;  ?>
		                      
		                   
		                                    
		                                        
                            <?php 

                            // prepare next and prev pagination links
                            if(!$paged) $paged = 1;
                            // max pages
                            $max = $blog_query->max_num_pages;
                            
                            ?>

							<div class="load-more-button">
																
								<a href="#" class="button" data-text="<?php _e('Load More' , 'dsf'); ?>"><?php _e('Load More' , 'dsf'); ?></a>

							</div>
							<!-- end  -->		                              
							

		                    <?php wp_reset_query(); ?>


                   </div>
                   <!-- end left side -->


					
					<?php get_sidebar(); ?>


                  
					
				   <div class="clearfix"></div>


				  



                </div>
                <!-- end row -->
            </div>
            <!-- end container -->

</section>
<!-- end blog -->
<?php get_footer(); ?>