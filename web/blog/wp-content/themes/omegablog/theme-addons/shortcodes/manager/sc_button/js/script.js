jQuery(document).ready(function()
{

	jQuery('.menu').height(jQuery('.content').height());

	// menu
	jQuery('.menu ul li a:first').addClass('active');
	jQuery('.content > .field').fadeOut(0);
	jQuery('.content > .field').first().fadeIn().addClass('active-shortcode');
	jQuery('.menu ul li a').on('click' , function()
		{
				jQuery(this).parent().parent().find('a').removeClass('active');
				jQuery(this).addClass('active');
				
				var id = jQuery(this).attr('href');
				jQuery('.content .field').fadeOut(0).removeClass('active-shortcode');
				jQuery(id).fadeIn(500).addClass('active-shortcode');

				return false;


				

		});
	

	// adding the shortcode
	jQuery('.add').on('click' , function() {
	
		// prepare the shortcode
		var shortcode = '[sh_' + jQuery('.field.active-shortcode').attr('id') + ' ';
		var field = jQuery('.field.active-shortcode').find('.active-field');
		if(field.length > 0)
		{
				field.each(function()
				{
					shortcode += jQuery(this).attr('name') + '="' + jQuery(this).val() + '" ';
				});
				shortcode += '][/sh_' + jQuery('.field.active-shortcode').attr('id') + ']';
		}
		else{
				shortcode += '][/sh_' + jQuery('.field.active-shortcode').attr('id') + ']';
		}
		
		 
		tinyMCE.activeEditor.selection.setContent(shortcode);
		
		tinyMCEPopup.close();
		
	});

	/**
	 * Select
	 */
	 jQuery('.dsf-container select').each(function() {
	 	if(jQuery(this).parent().find('.arrow').length > 0) 
	 	{
	 		jQuery(this).before('<div class="arrow2"></div>');
	 	}
	 	else
	 	{
	 		jQuery(this).before('<div class="arrow"></div>');
	 	}
	 });


	// slider
	jQuery('.slidercontrol').each(function()
		{
				var maxnum = jQuery(this).parent().find('input').attr('data-max');
				jQuery(' .slidercontrol').slider({
				max: maxnum ,
				value: jQuery(this).prev('input.slider').val(),
				change: function(event , ui) {
					jQuery(this).prev('input.slider').attr('value' , ui.value);
				}
			});
		});
	jQuery('input.slider').change(function() {
		var j = jQuery(this);
		jQuery(this).next('.slidercontrol').slider({
			value: j.val()
		});
	});




	
});