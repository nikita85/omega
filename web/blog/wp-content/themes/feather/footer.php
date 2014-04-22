<?php $feather_theme_options = get_option('feather'); ?>
<!-- footer -->
<footer>
        
        <div class="container">
            <div class="row">
                    


                    <!-- social icons -->
                    <div class="social-icons">
                        

                            <?php if(isset($feather_theme_options['facebook']) && $feather_theme_options['facebook'] != '') : ?>
                            <a href="http://facebook.com/<?php echo $feather_theme_options['facebook']; ?>" class="facebook"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['twitter']) && $feather_theme_options['twitter'] != '') : ?>
                            <a href="http://twitter.com/<?php echo $feather_theme_options['twitter']; ?>" class="twitter"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['linkedin']) && $feather_theme_options['linkedin'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['linkedin']; ?>" class="linkedin"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['dribbble']) && $feather_theme_options['dribbble'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['dribbble']; ?>" class="dribbble"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['flickr']) && $feather_theme_options['flickr'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['flickr']; ?>" class="flickr"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['skype']) && $feather_theme_options['skype'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['skype']; ?>" class="skype"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['pinterest']) && $feather_theme_options['pinterest'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['pinterest']; ?>" class="pinterest"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['vimeo']) && $feather_theme_options['vimeo'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['vimeo']; ?>" class="vimeo"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['tumblr']) && $feather_theme_options['tumblr'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['tumblr']; ?>" class="tumblr"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['youtube']) && $feather_theme_options['youtube'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['youtube']; ?>" class="youtube"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['soundcloud']) && $feather_theme_options['soundcloud'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['soundcloud']; ?>" class="soundcloud"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['googleplus']) && $feather_theme_options['googleplus'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['googleplus']; ?>" class="google"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['instagram']) && $feather_theme_options['instagram'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['instagram']; ?>" class="instagram"></a>
                            <?php endif; ?>
                            <?php if(isset($feather_theme_options['github']) && $feather_theme_options['github'] != '') : ?>
                            <a href="<?php echo $feather_theme_options['github']; ?>" class="github"></a>
                            <?php endif; ?>

                            


                    </div>
                    <!-- end social icons -->



                    <?php if(isset($feather_theme_options['copyrights']) && $feather_theme_options['copyrights'] != '') : ?>

                    <!-- copyrights -->
                    <div class="copyrights">
                            
                            <p class="light-font"><?php echo $feather_theme_options['copyrights']; ?></p>

                    </div>
                    <!-- end copyrights -->

                    <?php endif; ?>



            </div>
            <!-- end row -->
        </div>
        <!-- end container -->

</footer>
<!-- end footer -->
<?php wp_footer();
if(isset($feather_theme_options['trackingcode']) && $feather_theme_options['trackingcode'] != '') echo $feather_theme_options['trackingcode'];
?>
</body>
</html>