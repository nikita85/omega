 /*global jQuery:false , global feather:false*/
jQuery(document).ready(function()
{

			/* Availabe Easing Methods 
				1. linear
				2. swing
				3. easeInQuad
				4. easeOutQuad
				5. easeInOutQuad
				6. easeInCubic
				7. easeOutCubic
				8. easeInOutCubic
				9. easeInQuart
				10. easeOutQuart
				11. easeInOutQuart
				12. easeInQuint
				13. easeOutQuint
				14. easeInOutQuint
				15. easeInExpo
				16. easeOutExpo
				17. easeInOutExpo
				18. easeInSine
				19. easeOutSine
				20. easeInOutSine
				21. easeInCirc
				22. easeOutCirc
				23. easeInOutCirc
				24. easeInElastic
				25. easeOutElastic
				26. easeInOutElastic
				27. easeInBack
				28. easeOutBack
				29. easeInOutBack
				30. easeInBounce
				31. easeOutBounce
				32. easeInOutBounce
			  */
			if(typeof feather !== 'undefined')
			    {
		        var Speed = feather.speed;
		        var Animation = feather.ease;
		        var template_url = feather.template_url;
		        var admin_ajax = feather.admin_ajax;
		        var mainThemeColor = feather.mainColor;
		        if(typeof feather.flexslider_animation !== 'undefined') var flexAnimation = feather.flexslider_animation; else var flexAnimation = 'fade';
		    }
		    else
		    {
		        var Speed = 400;
		        var Animation = 'easeOutCirc';
		        var mainThemeColor = '38b49d';
		        var flexAnimation = 'fade';
		    }

		    if(jQuery.browser.msie)
		    {
		    		if(jQuery.browser.version >= 10 ) jQuery('html').addClass('ie10');
		    }

		  

		  
		   /* -------------------------------------------------------------- 
		   	Meida Element
		    -------------------------------------------------------------- */
		    jQuery('.audio-wrapper audio').mediaelementplayer({

			    loop: false,
			    enableAutosize: false,
			    // force iPad's native controls
			    iPadUseNativeControls: false,
			    // force iPhone's native controls
			    iPhoneUseNativeControls: false, 
			    features: ['playpause','progress', 'current'] ,
			    audioHeight: 40,
			    alwaysShowHours: false
			  
		    });

 		 


		     /* -------------------------------------------------------------- 
		     	Toggle Menu
		      -------------------------------------------------------------- */
		      jQuery(' nav.menu li.toggle a').on('click' , function()
		      	{
		      				var t = jQuery(this);
		      				var items = jQuery(this).parent().parent().find('li:not(.toggle)');
		      				var prnt = jQuery(this).parent().parent();
		      				if(!prnt.hasClass('active-menu'))
		      				{				


		      								t.parent().addClass('active');
		      								items.slideDown(100);
		      								prnt.addClass('active-menu');
		      				}
		      				else{
		      								t.parent().removeClass('active');
		      								items.slideUp(100);
		      								prnt.removeClass('active-menu');
		      				}

		      				return false;
		      	});


		      jQuery(window).resize(function()
		      {
		      			if(jQuery(window).width() > 965)
		      			{
		      					jQuery('nav.menu li:not(.toggle)').css('display' , 'block');
		      					jQuery('nav.menu ul li.toggle').css('display' , 'none').removeClass('active');
		      					
		      			}
		      			else{
		      					jQuery('nav.menu li:not(.toggle)').css('display' , 'none');
		      					jQuery('nav.menu ul li.toggle').css('display' , 'block');
		      			}
		      });

		  	 /* -------------------------------------------------------------- 
			   Gallery
			  -------------------------------------------------------------- */
			    function fireFS()
			    {
			    			jQuery(window).load(function(){

					    		jQuery('#blog .flexslider').each(function()
					    		{
					    				if(flexAnimation == 'slide') jQuery(this).find('ul.slides > li').addClass('slideEffect');
					    				var __this = jQuery(this);
					    				if(jQuery(this).parent('.flickr-container').length < 1)
					    				{
					    						jQuery(__this).flexslider({
												         animation: flexAnimation,
												         touch : true ,
												         easing : Animation ,
												         animationSpeed : 1000,
												         keyboard : true,
												         nextText : '' ,
												         prevText : '',
												         slideshow: true,                
												         slideshowSpeed: 5000,
												         controlNav: false,
												         directionNav: true,
												         direction: "horizontal"
												});
					    				}
					    		});

			    		});
			    }	fireFS();

			    jQuery(window).load(function(){
				    jQuery('.flickr-wrapper .flexslider').flexslider({
					     animation: "fade",
					     touch : true ,
					     easing : 'swing' ,
					     animationSpeed : 1000,
					     keyboard : true,
					     nextText : '' ,
					     prevText : '',
					     slideshow: true,                
					     slideshowSpeed: 5000,
					     controlNav: false,
					     directionNav: true,
					     direction: "horizontal"
					});


					jQuery('.ins-container .flexslider').flexslider({
					     animation: "fade",
					     touch : true ,
					     easing : 'swing' ,
					     animationSpeed : 1000,
					     keyboard : true,
					     nextText : '' ,
					     prevText : '',
					     slideshow: true,                
					     slideshowSpeed: 5000,
					     controlNav: false,
					     directionNav: true,
					     direction: "horizontal"
					});
				});
			    



			  /* -------------------------------------------------------------- 
			  	Menu
			   -------------------------------------------------------------- */
			  

		  		 jQuery('nav.menu  ul li').hover(function(){

		  		 		// submenu
			   			var sub = jQuery(this).find(' > ul');

			   			// check if has submenu
			   			if(sub.length > 0 && jQuery(window).width() > 979)
			   			{
			   					sub.stop().slideDown(200  , Animation);
			   			}

		  		 } , function(){
		  		 		// submenu
			   			var sub = jQuery(this).find(' > ul');

			   			// check if has submenu
			   			if(sub.length > 0 && jQuery(window).width() > 979)
			   			{
			   					sub.stop().slideUp(100  , Animation);
			   			}
		  		 });


			 /* -------------------------------------------------------------- 
			 	Toggle Sidebar
			  -------------------------------------------------------------- */
			  // check sidebar status
			  var sidebarStatus = jQuery('#sidebar').attr('data-status') , sidebar = jQuery('#sidebar') , blogWrapper = jQuery('#blog');

			  // prepare the sidebar
			  switch(sidebarStatus){

			  		// hidden sidebar
			  		case '1' :
			  			// hide sidebar
			  			sidebar.fadeOut(0);
			  			// move blog to center
			  			blogWrapper.addClass('col-md-offset-2 active');
			  		break;


			  		// visible sidebar
			  		case '2' :

			  		break;


			  		// always visible
			  		case '3' :

			  		break;

			  }


			  // toggle button
			  jQuery('a.toggleSidebar').on('click' , function()
			  {
			  		// if sidebar hidden , show it
			  		if(blogWrapper.hasClass('col-md-offset-2 active'))
			  		{
			  				blogWrapper.removeClass('col-md-offset-2 active');
			  				sidebar.fadeIn(Speed);
			  		}else{
			  				blogWrapper.addClass('col-md-offset-2 active');
			  				sidebar.fadeOut(Speed);
			  		}

			  		return false;
			  });
			  

			 /* -------------------------------------------------------------- 
			 	Toggle Share Buttons
			  -------------------------------------------------------------- */
			  jQuery('.share-post .share-text').on('click' , function()
			  {
			  		jQuery(this).parent().find('.social-icons').fadeToggle(Speed , Animation);
			  		jQuery(this).toggleClass('active');
			  		return false;
			  }
			  );



			  /* -------------------------------------------------------------- 
			   	Center Navigaton
			  -------------------------------------------------------------- */
			  // var navBarHeight = jQuery('#header').height();
			  // if(jQuery(window).width() > 965) {
				 //  jQuery('#header nav.menu , .top-content .search').css({
				 //  	marginTop: (navBarHeight - jQuery('#header nav.menu').height()) / 2 + 'px'
				 //  });
			  // }
			  // jQuery(window).resize(function(){
			  // 		if(jQuery(window).width() > 965) {
			  // 			jQuery('#header nav.menu , .top-content .search').css({
					// 	  	marginTop: (navBarHeight - jQuery('#header nav.menu').height()) / 2 + 'px'
					// 	  });
			  // 			jQuery('nav.menu ul ul').css({
			  // 				top: (navBarHeight - jQuery('#header nav.menu').height()) * 10 + 'px !important'
			  // 			});
			  // 		}else{
			  // 			jQuery('#header nav.menu , .top-content .search').css({
			  // 				marginTop: '0px'
			  // 			});
			  // 		}
			  // });


		  	/* -------------------------------------------------------------- 
			  Accordion
			  -------------------------------------------------------------- */
			  /* Quick Accoridon */
			    jQuery('.accordion').each(function() {

			    var acc = jQuery(this);
			    acc.addClass('opened').find('.item:first .head').addClass('head-active');
			    // show first item content
			    if(acc.hasClass('opened')) {
			     jQuery(this).find('.item:first').find('.item-content').slideDown();
			    }
			    
			    // when click
			    jQuery(this).find('.head').click(function() {
			        if(!jQuery(this).hasClass('head-active')){
			      jQuery(acc).find('.head').removeClass('head-active').parent().find('.item-content').slideUp(Speed , Animation);
			      jQuery(this).parent().find('.item-content').slideDown(Speed , Animation);
			      jQuery(this).addClass('head-active');
			        }
			        return false; 
			    });
			  }); // End Accrodion




			 // wordpress default gallery 
			 jQuery(".attachment-thumbnail").each(function(){

			 		if(jQuery(this).parent('a').length > 0)
			 		{
			 				jQuery(this).parent('a').addClass("thickbox");
			 		}
			 });

			 

		  	 /* -------------------------------------------------------------- 
		  	 	Fix taglcloud font size
		  	  -------------------------------------------------------------- */
		  	  jQuery('.tagcloud a ').css('font-size' , '12px');

 			 /* -------------------------------------------------------------- 
 			 	Twitter Section
 			  -------------------------------------------------------------- */
 				var K = function () {
			    var a = navigator.userAgent;
			    return {
			        ie: a.match(/MSIE\s([^;]*)/)
			    }
				}();
	 			function parseTwitterDate(tdate) {
				    var system_date = new Date(Date.parse(tdate));
				    var user_date = new Date();
				    if (K.ie) {
				        system_date = Date.parse(tdate.replace(/( \+)/, ' UTC$1'))
				    }
				    var diff = Math.floor((user_date - system_date) / 1000);
				    if (diff <= 1) {return "just now";}
				    if (diff < 20) {return diff + " seconds ago";}
				    if (diff < 40) {return "half a minute ago";}
				    if (diff < 60) {return "less than a minute ago";}
				    if (diff <= 90) {return "one minute ago";}
				    if (diff <= 3540) {return Math.round(diff / 60) + " minutes ago";}
				    if (diff <= 5400) {return "about 1 hour ago";}
				    if (diff <= 86400) {return Math.round(diff / 3600) + " hours ago";}
				    if (diff <= 129600) {return "about 1 day ago";}
				    if (diff < 604800) {return Math.round(diff / 86400) + " days ago";}
				    if (diff <= 777600) {return "about 1 week ago";}
				    return "on " + system_date;
				}
				jQuery('.twitter-section ').each(function(){
					jQuery(this).find('p small').text(parseTwitterDate(jQuery(this).find('p small').text()));
				});





			/* -------------------------------------------------------------- 
			 	fitVids
			-------------------------------------------------------------- */
 			jQuery('.wrapper.post-format-video , .wp-video').fitVids();



 			/* -------------------------------------------------------------- 
 			 	Sticky Menu
 			-------------------------------------------------------------- */
 			var checkScroll = false;
 			jQuery(window).scroll(function()
 			{
 				var header = jQuery('header.stick') ,
 					height = header.height() + 40,
 					offset = jQuery(window).scrollTop(),
 					blog = jQuery('section.blog');

 				if(offset > height) {

 					if(checkScroll == false) {

 						checkScroll = true;

	 					header.animate({
	 						opacity : 0
	 					} , {duration: 0});
	 					header.addClass('sticky-header');
	 					header.stop().animate({
	 						opacity : 1
	 					} , {duration: 500});

 					}


 					blog.stop().animate({
 						paddingTop : header  + 50
 					} , {duration: 500});
 				}
 				else{


 					header.removeClass('sticky-header');
 					header.animate({
 						opacity : 0
 					} , {duration: 0});
 					header.removeClass('sticky-header');
 					header.stop().animate({
 						opacity : 1
 					} , {duration: 500});
 					blog.stop().animate({
 						paddingTop : header  + 50
 					} , {duration: 500});

 					checkScroll = false;
 				}
 			});




 			/* -------------------------------------------------------------- 
 			 	Ajax Blog
 			-------------------------------------------------------------- */
 			var loadMore = jQuery('.load-more-button a');
 			loadMore.on('click' , function(){

 						var wrapper = jQuery('.blog-ajax-wrapper'), 
 							pageNum = 1,
 							offset = wrapper.find('> .single-post').length;

 						jQuery.ajax({
 							type: 'GET' ,
 							data: {
 								page_number: pageNum,
 								action: 'feather_load_posts',
 								offset: offset
 							},
 							datatype: 'html',
 							url: admin_ajax,
 							beforeSend: function(){
 								loadMore.text('').addClass('active');
 							},
 							success: function(data){

 									// check posts length
 									if(jQuery(data).length)
 									{
 											// add posts
 											
 											wrapper.find('> .single-post').last().after(jQuery(data));
 											jQuery('.audio-wrapper audio').mediaelementplayer({

												    loop: false,
												    enableAutosize: false,
												    // force iPad's native controls
												    iPadUseNativeControls: false,
												    // force iPhone's native controls
												    iPhoneUseNativeControls: false, 
												    features: ['playpause','progress', 'current'] ,
												    audioHeight: 40,
												    alwaysShowHours: false
												  
											    });
 											fireFS();
 											jQuery('.share-post .share-text').on('click' , function()
											  {
											  		jQuery(this).parent().find('.social-icons').fadeToggle(Speed , Animation);
											  		jQuery(this).toggleClass('active');
											  		return false;
											  }
											  );
 											jQuery('.wrapper.post-format-video , .wp-video').fitVids();
 											pageNum = pageNum+1;
 											loadMore.removeClass('active').text(loadMore.attr('data-text'));
 									}else{
 										loadMore.removeClass('active').text(loadMore.attr('data-text'));
 										console.log(data);
 										if(jQuery(data).length < 1 || data == '')
 										{
 												loadMore.fadeOut(500);
 										}
 									}
 							},
 							error: function(e){
 								console.log(e);
 							}
 						});

 					return false;



 			});
 			

 			/* -------------------------------------------------------------- 
 			 	Instagram
 			-------------------------------------------------------------- */
 			// if(typeof instagram != undefined)
 			// {
 			// 		jQuery('.widget .ins-container').each(function()
 			// 		{
 			// 				var userID = jQuery(this).attr('data-id') , 
 			// 					limit = jQuery(this).attr('data-limit');

 			// 				jQuery(this).instagram({
 			// 					limit: limit , 
 			// 					userId: userID,
 			// 					accessToken: '34476010c09f448cb3b69e55a488e133'
 			// 					 							});

 			// 				jQuery(this).on('didLoadInstagram', function(event, response) {
				// 			    console.log(response);
				// 			 });
 			// 		});
 			// }
});