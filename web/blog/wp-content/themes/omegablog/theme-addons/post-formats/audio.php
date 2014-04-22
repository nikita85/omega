<!-- post image -->
<div class="post-image audio post-format-audio <?php if(!has_post_thumbnail(get_the_ID())) echo 'no-image'; ?> ">
    

        <?php 

        if(has_post_thumbnail(get_the_ID())) {
            $imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'feather-post');
            $imagesrc = $imagesrc[0];
            ?>
            <img src="<?php echo $imagesrc; ?>" alt="<?php echo get_the_title(); ?>">
            <?php
        }



                   
                                    $audio = get_post_meta(get_the_ID() , 'audio' , true);
                                    $mp3 = get_post_meta(get_the_ID() , 'mp3' , true);
                                    $ogg = get_post_meta(get_the_ID() , 'ogg' , true);


                                    // check if this is embeded audio 
                                    if($audio != '')
                                    {
                                                echo '<div class="embed-audio-code">' . $audio .'</div><!-- end audio code -->';
                                    }
                                    elseif($mp3 != '' || $ogg != '')
                                    {
                                                ?>
                                            
                                            

                                    <div class="audio-wrapper">
                    

                                            <!-- wrap -->
                                            <div class="me-wrap">
                                                    
                                                    <audio controls>
                                                      <?php if($ogg != '') { ?><source src="<?php echo $ogg; ?>" type="audio/ogg"> <?php } ?>
                                                      <?php if($mp3 != '' ) { ?><source src="<?php echo $mp3; ?>" type="audio/mpeg"> <?php } ?>
                                                    <p><?php echo __('Your browser does not support the audio element.' , 'dsf'); ?></p>
                                                    </audio> 
                                             </div>
                                            <!-- end wrap -->


                                    </div>
                                    <!-- end audio wrapper -->

                                                <?php
                                    }


                            ?>
                   



                                    
</div>
<!-- end post image -->