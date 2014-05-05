<?php 
// Similar Posts Loop

?>
<?php
$theme_option = get_option('journal');
$sim_posts_limit = $theme_option['limit_sim_posts'] ? $theme_option['limit_sim_posts'] : 3;
$sim_type = $theme_option['sim_posts_option'];
$sim_args = '';

// similar posts by category
if($sim_type == '' || $sim_type == 'category')
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

// query
$sim_posts = new WP_Query($sim_args);

if($sim_posts->have_posts()) {
    ?>
            <div class="divider"></div>


                <!-- similar-posts -->
                <div id="sim-posts">
    <?php
}


if(is_array($sim_args) && $sim_posts->have_posts()) : while($sim_posts->have_posts()) : $sim_posts->the_post();
?>

<!-- sim posts wrap -->
<div class="post-wrap">
<div class="post">
            
        <a href="<?php echo get_permalink(); ?>" class="zoom"></a>
        <a href="<?php echo get_permalink(); ?>" class="post-content"><?php echo get_the_post_thumbnail(get_the_ID() , 'similar-post'); ?></a>


</div>
<!-- end post -->
<h5><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
</div><!-- end post wrap -->
<?php
endwhile; endif; 

if($sim_posts->have_posts())
{
        ?>
        
        </div>
        <!-- end sim posts -->
        <?php
}
wp_reset_query();
?>