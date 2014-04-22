<?php $feather_theme_options = get_option('feather'); ?>
<!-- footer -->
<footer>
        
        <div class="container">
            <div class="row">
                    


                    <!-- social icons -->
                    <div class="social-icons">
                        

                            <div class="pages">
                                <h1>Pages:</h1>
                                <div class="left-top-border"></div>
                                <ul class="pages-list">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Tutors</a></li>
                                    <li><a href="#">Classes</a></li>
                                    <li><a href="#">Summer Seminars</a></li>
                                    <li><a href="#">Blog</a></li>
                                </ul>
                            </div>
                            <div class="classes">
                                <h1>Classes:</h1>
                                <div class="middle-top-border"></div>
                                <ul class="classes-list">
                                    <li><a href="#">Creative Writing at Oak Knoll</a></li>
                                    <li><a href="#">Writing Workouts at Hillview</a></li>
                                    <li><a href="#">Test prep boot camp</a></li>
                                    <li><a href="#">Crafting the personal essay statement</a></li>
                                    <li><a href="#">Of myths and monsters</a></li>
                                </ul>
                                <ul class="classes-list-isee">
                                    <li><a href="#">Going to the dogs</a></li>
                                    <li><a href="#">Make‘em laugh</a></li>
                                    <li><a href="#">The power of story</a></li>
                                    <li><a href="#">Intro to literary analysis</a></li>
                                </ul>
                            </div>
                            <div class="contact-us">
                                <h1>Contact us</h1>
                                <div class="right-top-border"></div>
                                <ul class="contact-list">
                                    <li>Omega Teaching</li>
                                    <li>1030 Curtis St. #201</li>
                                    <li>Menlo Park, CA 94025</li>
                                    <li>650-322-2671</li>
                                    <li><a href="mailto:info@omegateaching.com">info@omegateaching.com</a></li>
                                </ul>
                            </div>

                            


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