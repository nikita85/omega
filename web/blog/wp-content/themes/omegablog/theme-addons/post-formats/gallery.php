<!-- post image -->
<div class="post-image post-format-image">
    
    <div class="wrapper">

        <div class="gallery flexslider">

            <ul class="slides">

            <?php 
                
                // get the images , fix any double comma errors , convert it to array
                $images = explode(',' , str_replace(',,' , ',' , get_post_meta(get_the_ID()  , 'buzz_media_gallery' , true)));

                foreach ($images as $image) {
                    
                    if($image != ''){
                        // get the cropped version of the image
                        if(   (strpos($image , '.jpg') !== false)   ||  (strpos($image , '.png') !== false)  )
                        {
                                $fixedImage = str_replace('.jpg' , '-940x500.jpg' , $image);
                                $fixedImage = str_replace('.png' , '-940x500.png' , $image);
                                if(file_exists($fixedImage)) $image = $fixedImage;
                        }
                    ?>
                        <li><a href="<?php echo get_permalink(); ?>" class="image-link"><img src="<?php echo $image; ?>" alt="" /></a></li>
                    <?php
                    }
                }
            ?>

                </ul>

        </div>
        <!-- end gallery -->
    
    </div>
    <!-- end wrapper -->

</div>
<!-- end post image -->