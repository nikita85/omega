<?php get_header(); 
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

                	<h2 class="main-page-title col-md-12" style="margin-bottom: 20px;"><?php 

                				  if(is_author()) :
                                  $author = get_userdata( get_query_var('author') );
                                  $query_name =  $author->display_name;
                                  elseif(is_day()) : ?>
                                  <?php $query_name =  get_the_date(); ?>
                                  <?php elseif(is_month()) : ?>
                                  <?php $query_name =  single_month_title(' '); ?>
                                  <?php elseif(is_year()) : ?>
                                  <?php $query_name =  get_the_date( _x( 'Y', '', 'dsf' ) ); ?>
                                  <?php elseif(is_category()) : ?>
                                  <?php $query_name =  single_cat_title();  ?>
                                  <?php elseif(is_tag()) : ?>
                                  <?php $query_name =  single_tag_title();  ?>
                                  <?php endif; 


	                              if(isset($feather_theme_options['archive_title']) && $feather_theme_options['archive_title'] != '') :
	                                    echo str_replace('$' , $query_name ,$feather_theme_options['archive_title']);
	                                else :
	                                    echo $query_name.' ' . __('Posts' , 'dsf');
	                                endif;

                	 ?></h2>
                    

                   <!-- left side -->
                   <div id="blog" class="blog-wrapper col-md-8 col-xs-12">



                   			
                   	
							
							<?php 

							  // prepare query array to be merged with the original array
					          $query_array = '';
					                  if($query_string != '' && !is_category())
					                  {
					                      
					                      $qs = explode('&' , $query_string);

					                      foreach ($qs as $q) {
					                         list($key , $value) = explode('=' , $q);
					                         $query_array[$key] = $value;
					                      }

					                  }
					                  elseif(is_category() && $query_string != '')
					                  {
					                      $qs = explode('&' , $query_string);

					                      foreach ($qs as $q) {
					                         list($key , $value) = explode('=' , $q);
					                         $query_array[$key] = $value;
					                      }

					                      // if sub category get the latest child category
					                      if(isset($query_array['category_name'])){
					                        $cats = explode('%2F' , $query_array['category_name']);
					                        if(count($cats) > 1) {
					                          $query_array['category_name'] = end($cats);

					                          // uncomment these 2 lines if you don't want to show sub category posts
					                          // 
					                          // $get_the_term = get_term_by('slug' , end($cats) , 'category');
					                          // $query_array['category__in'] = $get_the_term->term_id;
					                        }
					                    }



					                  }

                            $blog_limit = isset($feather_theme_options['limit_posts']) ? $feather_theme_options['limit_posts'] : 5;
                            $blog_order = isset($feather_theme_options['blog_order']) ? $feather_theme_options['blog_order'] : 'date';

                            $blog_args = array(
                                'posts_per_page' => $blog_limit ,
                                'post_type' => 'post',
                                'orderby' => $blog_order,
                                'paged' => $paged
                                );
                            if(is_array($query_array))
					        {
					              $blog_args = array_merge($blog_args , $query_array);
					        }

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
		                                                                

		                                                               <?php the_content(); ?>                                            


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

		  					<?php endwhile; 

		  					else :

		  					if(isset($feather_theme_options['search_error']) && $feather_theme_options['search_error'] != '') echo $feather_theme_options['search_error'];

		  					endif;  ?>
		                      
		                   
		                                    
		                                        
                            <?php 

                            // prepare next and prev pagination links
                            if(!$paged) $paged = 1;
                            // max pages
                            $max = $blog_query->max_num_pages;
                            
                            // prev posts link
                            if(get_previous_posts_link(false  ,$max) != '') $blog_prev_post_link = '<div class="prev-posts">'. get_previous_posts_link(false  ,$max).'</div>';
                            if(get_next_posts_link(false,$max)) $blog_next_post_link = '<div class="next-posts">'.get_next_posts_link(false,$max).'</div>';
                            if(isset($feather_theme_options['enable_numeric_pagination']) && $feather_theme_options['enable_numeric_pagination'] == '1') $num_pagination = dsf_pagination($paged , $max);

                            ?>
		                              


		                    <?php wp_reset_query(); ?>
<section class="blog-pagination" id="pagination">


    <div class="container">
        <div class="row">
            <div class="col-md-12"><?php

                if($blog_prev_post_link != '') echo $blog_prev_post_link;
                echo $num_pagination;
                if($blog_next_post_link != '') echo $blog_next_post_link;
                ?></div>
        </div><!-- end row -->
    </div>
    <!-- end container -->


</section>
<!-- end blog pagination  -->


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