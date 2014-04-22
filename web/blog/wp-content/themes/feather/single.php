<?php get_header();
$feather_theme_options = get_option('feather');
// Next And Prev Posts For Pagination
$blog_next_post_link = '';
$blog_prev_post_link = '';
?>
<!-- blog  -->
<section class="blog single-blog-page">
    
            <div class="container">
                <div class="row">

                    <!-- left side -->
                   <div id="blog" class="blog-wrapper col-md-8 col-xs-12">
                    
                            
                            <?php 
                                if(have_posts()) : while(have_posts()) : the_post();
                            ?>
                            
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
                                                                        

                                                                       <?php the_content(); ?>

                                                                       <?php wp_link_pages(); ?>                                            


                                                                </div>
                                                                <!-- end main content -->


                                                                <?php if(has_tag()) : ?>
                                                                <!-- tags -->
                                                                <div class="tagcloud">
                                                                        
                                                                    <?php 
                                                                        $tags = get_the_tags(get_the_ID());
                                                                        foreach($tags as $tag){
                                                                            echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
                                                                        } ?>

                                                                </div>
                                                                <!-- end tags -->
                                                                <?php endif; ?>

                                                                    
                                                                <div class="clearfix"></div>
                                                                
                                                                


                                                        </div>
                                                        <!-- end inner content -->


                                                        <?php if(isset($feather_theme_options['enable_author_section']) && $feather_theme_options['enable_author_section'] != 0) : ?>
                                                        <!-- author -->
                                                        <div class="post-inner-content secondary-content-box">
                                                            
                                                                        
                                                                        <!-- author bio -->
                                                                        <div class="author-bio content-box-inner">
                                                                                    

                                                                                <!-- avatar -->
                                                                                <div class="avatar">
                                                                                    <?php echo get_avatar(get_the_author_meta('ID') , '54'); ?>
                                                                                </div>
                                                                                <!-- end avatar --> 




                                                                                <!-- user bio -->
                                                                                <div class="author-bio-content">
                                                                                                
                                                                                            <h4><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h4>
                                                                                            <p>
                                                                                                <?php echo get_the_author_meta('description'); ?>
                                                                                            </p>

                                                                                </div>
                                                                                <!-- end author bio -->                           
                                                

                                                                        </div>
                                                                        <!-- end author bio -->

                                                        </div>
                                                        <!-- end author -->
                                                        <?php endif; ?>


                                                <?php if(isset($feather_theme_options['enable_related_posts']) && $feather_theme_options['enable_related_posts'] != 0) : ?>
                                                <!-- related posts -->
                                                <div class="post-inner-content secondary-content-box related-posts-wrapper">
    

                                                        <div class="content-box-inner related-posts">
                                                            

                                                                
                                                                <h4><?php _e('Related Posts' , 'dsf'); ?></h4>

                                                        <!--  -->
                                                        <div class="clearfix"></div>
                                                            

                                                        <!-- switch related posts style -->


                                                                <?php 



                                                                    // post types
                                                                    $sim_type = isset($feather_theme_options['related_posts_option']) ? $feather_theme_options['related_posts_option'] : 'tags';
                                                                    $sim_posts_limit = isset($feather_theme_options['related_posts_limit']) ? $feather_theme_options['related_posts_limit'] : 4;
                                                                    $sim_args = '';


                                                                    // category
                                                                    if($sim_type == '' || $sim_type == 1)
                                                                    { 
                                                                            /**
                                                                             * [$getPostCat getting post categories]
                                                                             * @var string
                                                                             */
                                                                            $getPostCat = get_the_category();
                                                                            $postCat = '';
                                                                            if(!empty($getPostCat)) 
                                                                            {
                                                                                $postCats = '';
                                                                                foreach ($getPostCat as $cat) {
                                                                                    $postCats .= $cat->term_id . ',';
                                                                                }
                                                                                $postCat  = rtrim($postCats , ',');
                                                                            }

                                                                            if($postCats != ''){

                                                                                $sim_args = array(
                                                                                    'posts_per_page' => $sim_posts_limit,
                                                                                    'post_type' => 'post' ,
                                                                                    'cat' => $postCats,
                                                                                    'post__not_in' => array(get_the_ID())
                                                                                );
                                                                            }
                                                                    }else{
                                                                        // similar posts by tags
                                                                        $tags = get_the_tags();
                                                                        $post_tags = '';
                                                                        if(!empty($tags))
                                                                        {
                                                                                foreach ($tags as $tag) {
                                                                                    $post_tags .= $tag->name . ',';
                                                                                }
                                                                                $post_tags = rtrim($post_tags , ',');
                                                                        }

                                                                        if($post_tags != '')
                                                                        {
                                                                                $sim_args = array(
                                                                                    'posts_per_page' => $sim_posts_limit , 
                                                                                    'post_type' => 'post' ,
                                                                                    'tag' => $post_tags,
                                                                                    'post__not_in' => array(get_the_ID())
                                                                                );
                                                                        }
                                                                    }

                                                                    /**
                                                                     * [$getPostCat getting post categories]
                                                                     * @var string
                                                                     */
                                                                    $getPostCat = get_the_category();
                                                                    $postCat = '';
                                                                    if(!empty($getPostCat)) 
                                                                    {
                                                                        $postCats = '';
                                                                        foreach ($getPostCat as $cat) {
                                                                            $postCats .= $cat->term_id . ',';
                                                                        }
                                                                        $postCat  = rtrim($postCats , ',');
                                                                    }


            
                                                                    /**
                                                                     * [$related_args related posts query]
                                                                     * this will query the latest posts from the same category
                                                                     * @var [type]
                                                                     */
                                                                    $related_args = $sim_args;


                                                                    $related_query = new WP_Query($related_args);


                                                                   

                                                                    ?>

                                                                        <!-- recent posts -->
                                                                        <div class="recent-posts-wrapper  related">

                                                                        <?php

                                                                             if($related_query->have_posts() ) : while( $related_query->have_posts() ) : $related_query->the_post();
                                                                            ?>
                                                                            
                                                                            <!-- default  -->
                                                                           
    
                                                                                    <ul>
                                                                                        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                                                                                    </ul>
                                                                                    

                                                                            <?php

                                                                            endwhile; endif; wp_reset_query();
                                                                            ?>

                                                                            

                                                                            </div><!-- end latest posts wrapper -->

                                                                    <?php

                                                                  


                                                                ?>





                                                        </div>
                                                        <!-- end content box inner -->

                                                    

                                                </div><!-- end related posts -->
                                                <?php endif; // end related posts check ?>




                                                <?php comments_template(); ?>



                                        </div>
                                        <!-- end post-content-inner-wrapper -->

                                    </div><!-- end post content -->
                                    <?php elseif(get_post_format() == 'quote') : ?>
                                    
                                    <!-- quote post content -->
                                    <div class="post-image post-format-quote">
                                        <?php if(get_post_meta(get_the_ID() , 'quote-link' , true) == 'on') echo '<a href="'.get_permalink().'">'; ?>
                                        <div class="wrapper">

                                            <?php if(has_post_thumbnail(get_the_ID())) echo get_the_post_thumbnail(get_the_ID() , 'blogify-post'); ?>

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
                                                                        

                                                                       <?php the_content(); ?>

                                                                       <?php wp_link_pages(); ?>                                            


                                                                </div>
                                                                <!-- end main content -->


                                                                <?php if(has_tag()) : ?>
                                                                <!-- tags -->
                                                                <div class="tagcloud">
                                                                        
                                                                    <?php 
                                                                        $tags = get_the_tags(get_the_ID());
                                                                        foreach($tags as $tag){
                                                                            echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
                                                                        } ?>

                                                                </div>
                                                                <!-- end tags -->
                                                                <?php endif; ?>

                                                                    
                                                                <div class="clearfix"></div>
                                                                
                                                                


                                                        </div>
                                                        <!-- end inner content -->


                                                        <?php if(isset($feather_theme_options['enable_author_section']) && $feather_theme_options['enable_author_section'] != 0) : ?>
                                                        <!-- author -->
                                                        <div class="post-inner-content secondary-content-box">
                                                            
                                                                        
                                                                        <!-- author bio -->
                                                                        <div class="author-bio content-box-inner">
                                                                                    

                                                                                <!-- avatar -->
                                                                                <div class="avatar">
                                                                                    <?php echo get_avatar(get_the_author_meta('ID') , '54'); ?>
                                                                                </div>
                                                                                <!-- end avatar --> 




                                                                                <!-- user bio -->
                                                                                <div class="author-bio-content">
                                                                                                
                                                                                            <h4><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h4>
                                                                                            <p>
                                                                                                <?php echo get_the_author_meta('description'); ?>
                                                                                            </p>

                                                                                </div>
                                                                                <!-- end author bio -->                           
                                                

                                                                        </div>
                                                                        <!-- end author bio -->

                                                        </div>
                                                        <!-- end author -->
                                                        <?php endif; ?>


                                                <?php if(isset($feather_theme_options['enable_related_posts']) && $feather_theme_options['enable_related_posts'] != 0) : ?>
                                                <!-- related posts -->
                                                <div class="post-inner-content secondary-content-box related-posts-wrapper">
    

                                                        <div class="content-box-inner related-posts">
                                                            

                                                                
                                                                <h4><?php _e('Related Posts' , 'dsf'); ?></h4>

                                                        <!--  -->
                                                        <div class="clearfix"></div>
                                                            

                                                        <!-- switch related posts style -->


                                                                <?php 



                                                                    // post types
                                                                    $sim_type = isset($feather_theme_options['related_posts_option']) ? $feather_theme_options['related_posts_option'] : 'tags';
                                                                    $sim_posts_limit = isset($feather_theme_options['related_posts_limit']) ? $feather_theme_options['related_posts_limit'] : 4;
                                                                    $sim_args = '';


                                                                    // category
                                                                    if($sim_type == '' || $sim_type == 1)
                                                                    { 
                                                                            /**
                                                                             * [$getPostCat getting post categories]
                                                                             * @var string
                                                                             */
                                                                            $getPostCat = get_the_category();
                                                                            $postCat = '';
                                                                            if(!empty($getPostCat)) 
                                                                            {
                                                                                $postCats = '';
                                                                                foreach ($getPostCat as $cat) {
                                                                                    $postCats .= $cat->term_id . ',';
                                                                                }
                                                                                $postCat  = rtrim($postCats , ',');
                                                                            }

                                                                            if($postCats != ''){

                                                                                $sim_args = array(
                                                                                    'posts_per_page' => $sim_posts_limit,
                                                                                    'post_type' => 'post' ,
                                                                                    'cat' => $postCats,
                                                                                    'post__not_in' => array(get_the_ID())
                                                                                );
                                                                            }
                                                                    }else{
                                                                        // similar posts by tags
                                                                        $tags = get_the_tags();
                                                                        $post_tags = '';
                                                                        if(!empty($tags))
                                                                        {
                                                                                foreach ($tags as $tag) {
                                                                                    $post_tags .= $tag->name . ',';
                                                                                }
                                                                                $post_tags = rtrim($post_tags , ',');
                                                                        }

                                                                        if($post_tags != '')
                                                                        {
                                                                                $sim_args = array(
                                                                                    'posts_per_page' => $sim_posts_limit , 
                                                                                    'post_type' => 'post' ,
                                                                                    'tag' => $post_tags,
                                                                                    'post__not_in' => array(get_the_ID())
                                                                                );
                                                                        }
                                                                    }

                                                                    /**
                                                                     * [$getPostCat getting post categories]
                                                                     * @var string
                                                                     */
                                                                    $getPostCat = get_the_category();
                                                                    $postCat = '';
                                                                    if(!empty($getPostCat)) 
                                                                    {
                                                                        $postCats = '';
                                                                        foreach ($getPostCat as $cat) {
                                                                            $postCats .= $cat->term_id . ',';
                                                                        }
                                                                        $postCat  = rtrim($postCats , ',');
                                                                    }


            
                                                                    /**
                                                                     * [$related_args related posts query]
                                                                     * this will query the latest posts from the same category
                                                                     * @var [type]
                                                                     */
                                                                    $related_args = $sim_args;


                                                                    $related_query = new WP_Query($related_args);


                                                                   

                                                                    ?>

                                                                        <!-- recent posts -->
                                                                        <div class="recent-posts-wrapper  related">

                                                                        <?php

                                                                             if($related_query->have_posts() ) : while( $related_query->have_posts() ) : $related_query->the_post();
                                                                            ?>
                                                                            
                                                                            <!-- default  -->
                                                                           
    
                                                                                    <ul>
                                                                                        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                                                                                    </ul>
                                                                                    

                                                                            <?php

                                                                            endwhile; endif; wp_reset_query();
                                                                            ?>

                                                                            

                                                                            </div><!-- end latest posts wrapper -->

                                                                    <?php

                                                                  


                                                                ?>





                                                        </div>
                                                        <!-- end content box inner -->

                                                    

                                                </div><!-- end related posts -->
                                                <?php endif; // end related posts check ?>




                                                <?php comments_template(); ?>



                                        </div>
                                        <!-- end post-content-inner-wrapper -->

                                    </div><!-- end post content -->

                                    <?php endif; // end if post format not == quote ?>
                                   

                            


                            </div><!-- end single post -->

                            <?php endwhile; endif;  ?>
                              
                           
                                


                            <?php wp_reset_query(); ?>


                   </div>
                   <!-- end left side -->


                    
                    <?php get_sidebar(); ?>


                  
                    
                   <div class="clearfix"></div>


                    


                </div><!-- end row -->
            </div><!-- end container -->
</section><!-- end blog -->
<section class="blog-pagination" id="pagination">
            
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="prev-posts"><?php next_post_link('%link' , '' , false); ?></div>
                    <div class="next-posts"><?php previous_post_link('%link' , '' , false); ?></div>
                </div>
            </div><!-- end row -->
        </div>
        <!-- end container -->


</section>
<!-- end blog pagination  -->
<?php get_footer(); ?>