<?php $shortcodes = array(

							array(

									'id' => 'Margin' ,
									'description' => __('Add margin divider .. ' , 'dsf'),
									'fields' => array(

								 					array(
								 							'id' => 'Margin',
								 							'type' => 'slider' ,
								 							'description' => __('Select margin width' , 'dsf'),
								 							'max' => 1000
								 					)
										)
							),
							array(
									'id' => 'Clear',
									'description' => __('Add a clear div' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Social Icons',
									'description' => __('Add social icons' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Divider',
									'description' => __('Add a divider' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Highlight',
									'description' => __('Add a highlighted content' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Blockquote',
									'description' => __('Add a blockquote content' , 'dsf'),
									'fields' => false
							),
							
							array(
									'id' => 'Light Text',
									'description' => __('Wrap text with shortcode to make it 300 font-wight' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Accordion',
									'description' => __('Add accordion wrapper' , 'dsf'),
									'fields' => false
							),
							array(
									'id' => 'Accordion Item',
									'description' => __('Add accordion item' , 'dsf'),
									'fields' => array(

								 					array(
								 							'id' => 'Title',
								 							'type' => 'text' ,
								 							'description' => __('Select margin width' , 'dsf')
								 					)
										)
							),
							array(
								'id' => 'Image',
								'description' => __('Wrap and image with shit shortcode to make to float to right or left' , 'dsf'),
								'fields' => 
										array(
												array(
					 							'id' => 'Float',
					 							'type' => 'select' ,
					 							'options' => 'left , right',
					 							'description' => __('Float Direction' , 'dsf')
					 							) ,
					 							array(
					 							'id' => 'Width',
					 							'type' => 'select' ,
					 							'options' => 'fullwidth , half-width',
					 							'description' => __('Float Direction' , 'dsf')
					 							)
										
			 							 )
							)


				); ?>