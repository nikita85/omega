<?php 
/*
    Template Name: Archives
*/
get_header();
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
                                        
                                        <h2><?php echo get_the_title(); ?></h2>

                                                        <!-- margin -->
                                                        <div class="margin-half"></div>

                                                        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                                                                <?php the_content(); ?>
                                                        <?php endwhile; endif; ?>

                                                        <div class="margin"></div>

                                                        <!-- accordion -->
                                                        <div class="accordion">
                                                            
                                                                        

                                                                <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Latest Posts' , 'dsf'); ?></a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                        <ul>
                                                                           <?php 


                                                                                // setup query
                                                                                $args = array(
                                                                                                            'posts_per_page' => 10 ,
                                                                                                            'orderby' => 'date' ,
                                                                                                            'order' => 'DESC'
                                                                                            );
                                                                                $posts_query = new WP_Query($args);



                                                                                if($posts_query->have_posts()) : while($posts_query->have_posts()) : $posts_query->the_post();


                                                                                       if(get_the_title() != '')
                                                                                       {
                                                                                             echo '<li style="clear: both;"><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                                                                                       }


                                                                                endwhile; endif; wp_reset_query();
                                                                                



                                                                                ?>
                                                                        </ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Archive By Month' , 'dsf'); ?> </a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                      <ul>
                                                                            <?php wp_get_archives('type=monthly&show_post_count=0'); ?>
                                                                        </ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Archive By Year' , 'dsf'); ?> </a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                       <ul>
                                                                            <?php wp_get_archives('type=yearly&show_post_count=0'); ?>
                                                                        </ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->



                                                                 <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Categories' , 'dsf'); ?> </a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                       <ul>
                                                                           <?php
                                                                                            
                                                                                $cat = get_categories();
                                                                                $cat_array = array();
                                                                                
                                                                                foreach($cat as $c){
                                                                                    $cat_array[] = '<li><a href="'.get_category_link($c->term_id).'">'.$c->name.'</a></li>';
                                                                                }
                                                                                
                                                                                echo implode(' ',$cat_array);
                                                                                
                                                                                ?>
                                                                       </ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->





                                                                 
                                                                <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Tags' , 'dsf'); ?> </a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                       <ul><?php $tags = get_tags();
                                                                        $html = '';
                                                                        foreach ( $tags as $tag ) {
                                                                            $tag_link = get_tag_link( $tag->term_id );
                                                                                    
                                                                            $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                                                                            $html .= "{$tag->name}</a></li>";
                                                                        }
                                                                        $html .= '';
                                                                        echo $html; ?></ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->



                                                                 <!-- Item -->
                                                                <div class="item">
                                                                    
                                                                    
                                                                    <a href="#" class="head"><?php _e('Authors' , 'dsf'); ?> </a>
                                                                    
                                                                    <!-- Content -->
                                                                    <div class="item-content">
                                                                        
                                                                        <ul><?php 
                                                                        $args = array(
                                                                                    'exclude_admin' => false ,
                                                                                    'orderby' => 'post_count' , 
                                                                                    'order' => 'DESC'
                                                                        );
                                                                        wp_list_authors($args); ?></ul>
                                                                        
                                                                    </div><!-- End Content -->
                                                                    
                                                                </div><!-- End -->
                                                            



                                                        </div>
                                                        <!-- end accordion -->
                                         
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