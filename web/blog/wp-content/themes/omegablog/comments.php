<?php 
$feather_theme_options = get_option('feather'); 
if($feather_theme_options['enable_comments'] != 0) :
$form_message = isset( $feather_theme_options['commentformmessage'] ) ? $feather_theme_options['commentformmessage'] : __('Please be polite. We appreciate that.<br /> Your email address will not be published and required fields are marked' , 'dsf');
if($form_message == '') $form_message = __('Please be polite. We appreciate that.<br /> Your email address will not be published and required fields are marked' , 'dsf');
?>
<!-- comments -->
<div class="comments post-inner-content secondary-content-box">
    
        <!-- content box inner -->
        <div class="content-box-inner">
          

        <?php if(post_password_required()) : ?>
              
        <h4><?php echo __('Post Protected' , 'dsf'); ?></h4>

        </div>
        <!-- end comments -->
        

        <?php else : ?>


        

        
        <?php 

       

        // list the comments
        if(have_comments()) {

          ?>
            <h4 id="comments"><?php 
              $comments_n = __('No Comments', 'dsf');
              $comments_o = __('1 Comment', 'dsf');
              $comments_r = __('% Comments', 'dsf');
              comments_number($comments_n, $comments_o, $comments_r ); ?></h4>

          <?php

            wp_list_comments(array('type' => 'comment' , 'style' => 'div' , 'callback' => 'ds_list_comments'));



            // get comments count and check if pagination required
            if(dsf_check_comments(get_the_ID()) === 'true' ) :
            ?>
              <div class="clearfix"></div>
              <span class="prev"> <?php previous_comments_link('Older Comments'); ?></span>
              <span style="float: right;" class="next"> <?php next_comments_link('Newer Comments'); ?></span>

            <?php endif; // end check comments pagination  

        }else{

           ?>
            
            <h4 id="comments" style="margin-bottom: 0px;"><?php 
              $comments_n = __('No Comments', 'dsf');
              $comments_o = __('1 Comment', 'dsf');
              $comments_r = __('% Comments', 'dsf');
              comments_number($comments_n, $comments_o, $comments_r ); ?></h4>

           <?php
        } 

        ?>





        </div>
        <!-- end content box inner -->
        


</div>
<!-- end comments -->


<!-- comments form -->
<div id="respond" class="post-inner-content comments-form secondary-content-box">
    
                
                <div class="content-box-inner">
                  

                <?php if(comments_open()) : ?>
                <h4><?php _e('Leave a Comment' , 'dsf'); ?></h4>

                <?php if(get_option('comment_registration') == 1 && !is_user_logged_in()) : ?>
              
                <p><?php echo __('Only registerd members can post a comment , ' , 'dsf'); ?><a href="<?php echo wp_login_url(get_permalink());  ?>"><?php echo __('Login / Register' , 'dsf'); ?></a></p>

                <?php else : ?>

                

                <?php 
                /**
                 * [$comment_form_args custom comment form fields]
                 * @var array
                 */
                $reqs = '';
                if($req) $reqs = '('.__('required').')'; else $reqs = '';
                $commenter = wp_get_current_commenter();
                $comment_form_args = array(
                    'id_form' => 'commentform',
                    'comment_notes_before' => '<p class="light-font">' . $form_message
                    . '</p>' ,
                    'comment_notes_after' => '',
                    'id_submit' => 'submit-comment',
                    'class_submit' => 'submit-comment',
                    'title_reply' => '' ,
                      'title_reply_to' => __( 'Leave a Reply to %s or' , 'dsf' ),
                      'cancel_reply_link' => __( 'Cancel Reply' , 'dsf' ),
                      'label_submit' => __( 'Post Comment' , 'dsf' ),
                      'comment_field' => '<textarea name="comment" id="comment-text" placeholder="'.__('Write Message' , 'dsf').'" class="comment-text"></textarea>' ,
                      'fields' => apply_filters( 'comment_form_default_fields', array(
                                    
                                    'author' => '<br /><input type="text" value="'.esc_attr( $commenter['comment_author'] ).'" name="author" class="comment-name textfield"  id="comment-name" placeholder="'.__('Your Name *' , 'dsf').'" />' ,


                                    'email' => '<input type="text" value="'. esc_attr(  $commenter['comment_author_email'] ).'" name="email" class="comment-email textfield"  id="comment-email" placeholder="'.__('Your Email *' , 'dsf').'" />' ,

                                    'website' => '<input type="text" value="'. esc_attr(  $commenter['comment_author_url'] ).'" name="url" class="comment-website textfield"  id="comment-website" placeholder="'.__('Your Website ' , 'dsf').'" />'

                                  ) )
                  );

                comment_form($comment_form_args);  ?>

                
                <?php endif; ?>

                
                <?php else : ?>
                <h2><?php echo __('Comments Closed' , 'dsf'); ?></h2>
                <?php endif; // end if comments closed ?>



                </div>
                <!-- end content box inner -->

</div>
<!-- end comments form -->


<?php endif; 

else :
  echo '<div class="comments post-inner-content secondary-content-box">
    
        <!-- content box inner -->
        <div class="content-box-inner"></div></div><!-- end comments -->';

endif; // end if comments not disabled
?>