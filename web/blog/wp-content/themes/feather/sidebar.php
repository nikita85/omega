<?php 
$feather_theme_options = get_option('feather');
// 1= Hidden Sidebar 2= Visible Sidebar 3= Always Visible Sidebar
?>
<!-- right side [sidebar] -->
<div data-status="<?php if(isset($feather_theme_options['sidebar_status']) && $feather_theme_options['sidebar_status'] != '') echo $feather_theme_options['sidebar_status']; ?>" id="sidebar" class="sidebar col-md-4 col-xs-12">
	<div id="sidebar-content">
		
			
			<div class="sidebar-inner-content">
				
					
					<?php 

					if(is_search() || is_archive()) :

							dynamic_sidebar('Sidebar 1');

					else :
							if(get_post_meta(get_the_ID() , 'sidebars' , true) != '') {
							    dynamic_sidebar(get_post_meta(get_the_ID() , 'sidebars' , true));
							}else{
							    dynamic_sidebar('Sidebar 1');
							}
					endif;
					?>



			</div>
			<!-- end sidebar inner -->


	</div>
	<!-- end sidebar content -->
</div><!-- end sidebar -->