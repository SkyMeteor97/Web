<?php



if ( ! class_exists( 'FLBuilderModel' ) ) {

	return;

}



function tesseract_enqueue_beaver_builder_scripts() {

	if ( FLBuilderModel::is_builder_active() ) {

		wp_enqueue_script( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/js/beaver-builder.js', array( 'jquery' ) );

		wp_enqueue_style( 'tesseract-bb-extensions', get_template_directory_uri() . '/importer/css/beaver-builder.css' );

		

		wp_enqueue_style( 'tesseract-bb-extensions1', get_template_directory_uri() . '/importer/css/animate.min.css' );

	}

}

add_action( 'wp_enqueue_scripts', 'tesseract_enqueue_beaver_builder_scripts' );



//add_action( 'wp_footer', 'tesseract_add_button_to_page_builder' );

add_action( 'wp_ajax_tesseract_add_button_to_page_builder', 'tesseract_add_button_to_page_builder' );



/**

 * Adds HTML to the bottom of the Beaver Builder Page Builder interface, which is used in a

 * modal to allow content blocks to be added to the page.

 */

function tesseract_add_button_to_page_builder() {

	if ( ! defined( 'DOING_AJAX' ) ) {

		if ( ! FLBuilderModel::is_builder_active() ) {

			return;

		}

	}



	

	?>
    
    
 

	
		<div id="tesseract-content-blocks-wrapper">

			<div class="cancel-wrapper">

				<!--<span class="fl-builder-blocks-update fl-builder-button fl-builder-button-primary fl-builder-button-large pull-left"><i class="fa fa-refresh"></i></span> -->

				<span class="fl-builder-blocks-update-message pull-left"></span>

				<span class="fl-builder-cancel-button fl-builder-button fl-builder-button-primary fl-builder-button-large">Cancel</span>

			</div>

			
			<style type="text/css">
		      
		      .tabs input[type=radio] {
		          position: absolute;
		          top: -9999px;
		          left: -9999px;
		      }
		      .tabs {
		        width: 650px;
		        float: none;
		        list-style: none;
		        position: relative;
		        padding: 0;
		        margin: 0px auto;
		      }
		      .tabs li{
		        float: left;
		      }
		      .tabs label {
		          display: block;
		          padding: 10px 20px;
		          border-radius: 2px 2px 0 0;
		          color: #CC6200;
		          font-size: 15px;
		          font-weight: normal;
		          font-family: Helvetica,Verdana,sans-serif;
		          background: rgba(255,255,255,0.2);
		          cursor: pointer;
		          position: relative;
		          top: 3px;
		          -webkit-transition: all 0.2s ease-in-out;
		          -moz-transition: all 0.2s ease-in-out;
		          -o-transition: all 0.2s ease-in-out;
		          transition: all 0.2s ease-in-out;
		      }
		      .tabs label:hover {
		        background: rgba(255,255,255,0.5);
		        top: 0;
		      }
		      
		      [id^=tab]:checked + label {
		        
		        top: 0;
		        border: 1px solid #ccc;
		        border-bottom: 1px solid #fff!important;
		        z-index: 100;
		      }
		      
		      [id^=tab]:checked ~ [id^=tab-content], [id^=tab]:checked ~ [id^=tab-content] > div {
		          display: block;
		      }
		      .tab-content{
		        z-index: 2;
		        display: none;
		        text-align: left;
		        overflow: hidden;
		        width: 100%;
		        font-size: 20px;
		        line-height: 140%;
		        padding-top: 10px;		        
		        padding: 15px;
		        color: white;
		        position: absolute;
		        top: 37px;
		        left: 0;
		        box-sizing: border-box;
		        border: 1px solid #ccc;
		      }
		      .tab-content > div{
		        display: none;
		        -webkit-animation-duration: 0.5s;
		        -o-animation-duration: 0.5s;
		        -moz-animation-duration: 0.5s;
		        animation-duration: 0.5s;
		      }

		      .cancelbottom { position: absolute; bottom: 0px; width: 100%; }
		      .fl-lightbox-content { position: relative; padding-bottom: 50px; /*min-height: 1200px;*/}
			  
			  .clearfix:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
              .clearfix { display: inline-block; }
			  
			  .tabs{ position:relative; z-index:999;}
			  .tabs li ul{ position:absolute; right:0; top:37px; margin:0; padding:0; background:#FFF; z-index:99; width:100%; display:none;}
			  .tabs li ul li{ list-style-type:none;}
			  .tabs li.dropdown{ width:50px; height:37px; float:right; background:#F4171A; cursor:pointer;}
			  /*.dropdown:hover ul{ display:block !important;}*/

			  .tab-contentx {display:none;}
			  #tab-1 {display: block;}
			  .tab{  text-align: left; width: 100%; font-size: 20px; line-height: 140%; color: white; box-sizing: border-box; margin-top:-5px;}
			  
			  .tab-contentx{ border:1px solid #cccccc; padding-top: 10px; padding: 15px;}
			  
			  ul.tabs-menu{ margin:0; padding:0; position:relative; width:100%;}
			  .tabs-menu li{ margin:0; padding:0; float:left; list-style-type:none;}
			  .tabs-menu li a{ display:block; padding: 10px 20px;color: #000;font-size: 15px;font-weight: normal;font-family: 'Roboto', helveti;
		          background: rgba(255,255,255,0.2);
		          }
				  .tabs-menu li a span{ display:block; color: #CC6200; font-size: 15px;}
				  .tabs-menu li a{ cursor:pointer;}
				  
			  .tabs-menu li a:hover {background: rgba(255,255,255,0.5);}
		      .tabs-menu li.current a {border: 1px solid #ccc; border-bottom: 1px solid #fff !important; border-top-left-radius:2px; border-top-right-radius:2px;}
			  /*.tabs-menu li.dropdown{ width:50px; height:37px; float:right; background:#2ea2cc; cursor:pointer; text-align:center;}
			  .tabs-menu li.dropdown i{ color:#FFF; font-size:25px; margin:7px 0 0 0;}*/
			  .tabs-menu li.dropdown{ position:relative;}
			  .tabs-menu li ul{ position:absolute; left:0; top:37px; margin:0; padding:0; background:#FFF; z-index:99; display:none; width:200px;}
			  .tabs-menu li ul li{ float:none; border:none;}
			  .tabs-menu li ul li a{ background:rgba(200,200,200,0.2); color:#000; border:none;}
			  .tabs-menu li ul li a:hover{ background:rgba(200,200,200,0.3); color:#000;}
			  .tabs-menu li ul li.current a{ border:none;}
			  .tabs-menu li.current ul li a{ border:none;}
			  
			  .fl-builder-tesseract-blocks-lightbox .fl-lightbox .content-block{ margin-left: 3.3%; margin-right:0 !important;}
			  .animated.fadeInRight{ margin-left:-3% !important;}
			  
			  .content-block{ position:relative;}
			  .content-block-lock{ position:absolute; width:100%; height:100%; left:0; bottom:0; padding:56px 0 0 0; text-align:center; color:#FFF !important; background:rgba(244,244,244,0.65); font-size:15px !important; display:none; font-weight:normal !important; box-sizing: border-box;}
			  .content-block-lock a{ color:#FFF; font-weight:normal !important;}
			  .content-block:hover .content-block-lock{ display:block;}
			  
			  .content-block-lock h5{ background:#fc7070 !important; color:#FFF !important; font-size:16px !important; font-weight:normal; padding:10px 0; margin:0 !important; position:absolute; width:100%; left:0; bottom:10px;}
			  
			  
		    </style>
	    

		    <div class="container">
             	<ul class="tabs-menu clearfix">
	                <li class="current"><a href="#tab-1">Free</a></li>
	                <li><a href="#tab-2">Design</a></li>
	                <li><a href="#tab-4">Video In Background</a></li>
	               <!-- <li><a href="#tab-5">Thank you</a></li>-->
	             </ul>
            	<div class="tab clearfix">
	               	<div id="tab-1" class="tab-contentx clearfix">
	               		<div class="animated  fadeInRight">
			               	<?php
				              	$templates_query = new WP_Query( array(
									'post_type' => 'fl-builder-template',
									'meta_key' => Tesseract_Importer_Constants::$CONTENT_BLOCK_META_KEY,
									'meta_value' => 1,
									'posts_per_page' => -1
								) );
				              	if($templates_query->have_posts()){
					              	while ( $templates_query->have_posts() ) : $templates_query->the_post(); 
											$template_id = get_the_ID(); 
											global $post;
											$slug = $post->post_name;
									?>
										<div class="content-block slug-<?php echo esc_attr( $slug ); ?>"						style="background-image: url('https://s3.amazonaws.com/tesseracttheme/screenshots-free/<?php echo(esc_attr($slug))?>.jpg')">
											<a href="#" class="append-content-button" data-template-id="<?php echo esc_attr( $template_id ); ?>">
												<?php the_title(); ?>
											</a>
										</div>
									<?php endwhile; 
								}else{
									echo 'It looks like your content blocks are not loading due to some data config error. Simply to go into your Wordpress <b>Admin Dashboard</b> then go to <b>"General Settings"</b> and at the bottom you will see the option to reset your content block.';
								}

								?>
	               		</div>
	               	</div>
	               	<div id="tab-2" class="tab-contentx clearfix">
	               		<div class="animated  fadeInRight">
	               			<?php for($i=1;$i<=12;$i++){ ?>
		               			<div class="content-block Sample #<?php echo $i; ?>" style="background-image: url('https://s3.amazonaws.com/tesseracttheme/Free-Theme-Designer-Screenshots/design/img-<?php echo $i; ?>.jpg')">
									<a href="#" class="append-content-button">
										Design #<?php echo $i; ?>
									</a>
									<a href="https://tesseracttheme.com/designer/" target="_blank"><div class="content-block-lock animated fadeIn"><h5><i class="fa fa-lock" aria-hidden="true"></i> Activate This</h5></div></a>
								</div>
							<?php } ?>
	               		</div>
	               	</div>
	               	<div id="tab-4" class="tab-contentx clearfix">
	               		<div class="animated  fadeInRight">
	               			<?php for($i=1;$i<=12;$i++){ ?>
		               			<div class="content-block Sample #<?php echo $i; ?>" style="background-image: url('https://s3.amazonaws.com/tesseracttheme/Free-Theme-Designer-Screenshots/video-in-background/img-<?php echo $i; ?>.jpg')">
									<a href="#" class="append-content-button">
										Video BG #<?php echo $i; ?>
									</a>
									<a href="https://tesseracttheme.com/designer/" target="_blank"><div class="content-block-lock animated fadeIn"><h5><i class="fa fa-lock" aria-hidden="true"></i> Activate This</h5></div></a>
								</div>
							<?php } ?>
	               		</div>
	               	</div>
	               	<div id="tab-5" class="tab-contentx clearfix">
	               		<div class="animated  fadeInRight">
	               			<?php for($i=1;$i<=12;$i++){ ?>
		               			<div class="content-block Sample #<?php echo $i; ?>" style="background-image: url('https://s3.amazonaws.com/tesseracttheme/Free-Theme-Designer-Screenshots/thank-you/img-<?php echo $i; ?>.jpg')">
									<a href="#" class="append-content-button">
										Thank you #<?php echo $i; ?>
									</a>
									<a href="https://tesseracttheme.com/designer/" target="_blank"><div class="content-block-lock animated fadeIn"><h5><i class="fa fa-lock" aria-hidden="true"></i> Activate This</h5></div></a>
								</div>
							<?php } ?>
	               		</div>
	               	</div>
	               	
             </div>
		</div>




		<div class="cancel-wrapper cancelbottom" style="margin-bottom:0;">

				<!--<span class="fl-builder-blocks-update fl-builder-button fl-builder-button-primary fl-builder-button-large pull-left"><i class="fa fa-refresh"></i></span> -->

				<span class="fl-builder-blocks-update-message pull-left"></span>

				<span class="fl-builder-cancel-button fl-builder-button fl-builder-button-primary fl-builder-button-large">Cancel</span>

			</div>
		</div>
        
        
			

	<?php

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {

			die();

		}

}