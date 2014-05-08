<?php if(has_post_thumbnail(get_the_ID())) : ?>
<!-- post image -->
<div <?php post_class('post-image post-format-image '); ?>>

<div class="wrapper">
			
			<?php 
			$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'feather-post');
		    $imagesrc = $imagesrc[0];
			?>
		    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $imagesrc; ?>" alt="<?php echo get_the_title(); ?>"></a>

</div>
<!-- end wrapper -->

</div>
<!-- end post image -->
<?php endif; ?>