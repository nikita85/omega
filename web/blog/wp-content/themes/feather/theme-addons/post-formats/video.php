<?php if(get_post_meta(get_the_ID() , 'video' , true) != '') : ?>
<!-- post video -->
<div <?php post_class('post-image post-format-image span12'); ?>>

<div class="wrapper post-format-video">
            
            <?php echo get_post_meta(get_the_ID() , 'video' , true); ?>        

</div>
<!-- end wrapper -->

</div>
<!-- end post video -->
<?php endif; ?>