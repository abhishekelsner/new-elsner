<div class="site-wrapper" id="page-taxi">
	<section class="banner-taxi">
		<div class="bannermain-taxi">
			<img  class="banner-imgtaxi" src="<?php echo get_field('app_banner_image');?>" alt="">
			<div class="container-small">
                <div class="bannertaxi_content">
                    <?php the_field('taxi_banner_text');?>
                </div>
			</div>
		</div>
    </section>
    
	<section class="intro-taxisection">
		<div class="container-small">
			<div class="row alinc">
				<div class="intro_left aos-item">
                    <h3 class="title_taxi"><?php echo get_field('about_title');?></h3>
                </div>
                <div class="intro--right aos-item">
                   <?php the_field('about_text_taxi');?>
                </div>
			</div>
		</div>
	</section>
    <section class="exploremore_btn">
        <div class="exp-btn"><a class="btn button black" href="<?php echo get_field('button_url_taxi');?>"><?php echo get_field('button_name_taxi');?></a></div>
    </section>


	<section class="taxi-wireframe bg-gray">
		<div class="container-small">
			<div class="wire--framedesign aos-item">
                <div class="wire-frame">
                    <?php the_field('wireframe_text');?>
                    <?php the_field('wireframe_images');?>
                </div>
            </div>
		</div>
    </section>
    
	<section class="visual-design">
		<div class="visual--txt aos-item">
            <div class="visualtext-width">
                <?php echo get_field('visual_text_taxi');?>
            </div>
        </div>
        <div class="slider-visual aos-item">
            <div class="slider--taxi slider_first">
                <div class="owl-slider">
                    <div id="carousel" class="owl-carousel">
                        <?php 
                            $rows = get_field('taxi_visual_slider');
                            if( $rows ) {
                                foreach( $rows as $row ) { ?>
                                <div class="item">
                                    <img  class="owl-lazy" data-src="<?php echo $row['taxislider_images'];?>"  />
                                </div>
                                <?php } 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
	</section>
    
    <section class="all-screens">
		<div class="container-small">
			<div class="row alinc">
				<div class="intro_left aos-item">
                    <img  src="<?php echo get_field('main_screen_images');?>" alt="">  
                </div>
                <div class="intro--right aos-item">
                    <?php the_field('main_text_screen');?>
                </div>
			</div>
		</div>
    </section>
    <section class="receipt_earn">
        <div class="container-small">
            <div class="row alinc">
				<div class="intro_left2 aos-item">
                    <?php the_field('receipt_earnings_text');?>
                </div>
                <div class="intro--right aos-item">
                    <img  src="<?php echo get_field('receipt_earning_image');?>" alt="">
                </div>
			</div>
        </div>
    </section>
    <section class="receipt_earn pt0">
        <div class="container-small">
            <div class="row alinc">
				<div class="intro_left2 aos-item">
                    <img  src="<?php echo get_field('trip_request_image');?>" alt="">
                </div>
                <div class="intro--right aos-item">
                    <?php the_field('trip_request_text');?>
                </div>
			</div>
        </div>
    </section>

    <section class="visual-design bg-gray">
		<div class="visual--txt aos-item">
            <div class="visualtext-width">
                <?php the_field('visual_designss_text');?>
            </div>
        </div>
        <div class="slider-visual aos-item">
            <div class="slider--taxi slider_second">
                <div class="owl-slider">
                    <div id="carousel" class="owl-carousel">
                        <?php 
                            $rows = get_field('visual_design_slider');
                            if( $rows ) {
                                foreach( $rows as $row ) { 
                                    ?>
                                <div class="item">
                                    <img  class="owl-lazy" data-src="<?php echo $row['visual_design_slider_gallery'];?>" alt="" />
                                </div>
                                <?php } 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="all-screens">
		<div class="container-small">
			<div class="row alinc">
				<div class="intro_left aos-item">
                    <img  src="<?php echo get_field('taxi_screen_driver_image');?>" alt="">  
                </div>
                <div class="intro--right aos-item">
                    <?php the_field('taxi_screen_driver_text');?>
                </div>
			</div>
		</div>
    </section>
    <section class="receipt_earn">
        <div class="container-small">
            <div class="row alinc">
				<div class="intro_left2 aos-item">
                    <?php the_field('trip_request_drivetext');?>
                </div>
                <div class="intro--right aos-item">
                    <img  src="<?php echo get_field('trip_request_driveimage');?>" alt="">
                </div>
			</div>
        </div>
    </section>
    <section class="receipt_earn pt0">
        <div class="container-small">
            <div class="row alinc">
				<div class="intro_left2 aos-item">
                    <img  src="<?php echo get_field('trip_comments_image');?>" alt="">
                </div>
                <div class="intro--right aos-item">
                    <?php the_field('trip_comments_text');?>
                </div>
			</div>
        </div>
    </section>
    
	<section class="more-screens bg-gray">
		<div class="container-small">
			<div class="header-center">
                <h3 class="herder-title"><?php echo get_field('more_screen_title');?></h3>
                <p><?php the_field('more_screen_text');?></p>
            </div>
			<div class="other_scrrnimg aos-item">
				<img  src="<?php the_field('more_screen_image');?>" alt="other-screen" />
			</div>
		</div>
	</section>	
</div>

<?php if( have_rows('faq_section') ): ?>
        <?php while( have_rows('faq_section') ): the_row(); 
           $enable = get_sub_field('enable_faq');
    if($enable == 1){?>
        <div class="services-page">
        <section class="faq upgrade">
            <div class="container">
                <h4><?php the_sub_field('faq_title');?></h4>
                <div class="accordion" id="accordionExample">
                    <?php if( have_rows('faq') ): ?>
                        <?php  $i = 1; ?>
                       
                        <?php while( have_rows('faq') ): the_row(); ?>
                    <?php $x==1;?>
                    <?php if($x==1){ $classes = "";?>

                    <div class="faqlist">
                        
                        
                        <div class="faq-header" id="heading<?php echo $i;?>">
                            <button class="btn btn-link collapsed show<?php echo esc_attr( $classes ); ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">
                                <p itemprop="name"><?php the_sub_field('faq_question');?></p>
                            </button>
                        </div>
                    
                        
                        <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordionExample" >
                            <div class="faq-body">
                                <div itemprop="text">
                                <?php the_sub_field('faq_answer');?> </div>                    
                            </div>
                        </div>
                    
                    </div>
                    <?php } else { $classes = "collapsed show"; ?>
                    <div class="faqlist">
                     
                        <div class="faq-header" id="heading<?php echo $i;?>">
                            <button class="btn btn-link <?php echo esc_attr( $classes ); ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">
                                <p itemprop="name"><?php the_sub_field('faq_question');?></p>
                            </button>
                        </div>
                    
                  
                        
                        <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordionExample">
                            <div class="faq-body">
                                <div itemprop="text">
                              <?php the_sub_field('faq_answer');?>   </div>                
                            </div>
                        </div>
                    
                    
                    </div>
                <?php }?>
               
                <?php $x++;?>
                
                <?php $i++; endwhile; endif; ?>

                    </div>
                </div>
           
       <!-- </div> -->
        </section>
            </div>
    <?php  } endwhile; endif;?>



<footer class="site-footer yellow-bg">
	<div class="footer-content">
        <div class="footer-titles aos-item">
            <?php the_field('footer_textTaxi');?>
        </div>
		<div class="footerlogo aos-item">
			<img  src="<?php echo get_field('taxi_footer_image');?>" alt="logo food dash" />
		</div>
	</div>
</footer>

<script>
	// jQuery(window).load(function(){
	// 	AOS.init({
	// 		easing: 'ease-in-out-sine',
	// 		once: true
	// 	});
    // });
    jQuery(document).ready(function(){
        jQuery(".slider-visual .owl-carousel").owlCarousel({
        autoplay: true,
        lazyLoad: true,
        loop: true,
        margin: 25,
        dots:false,
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 2000,
        nav: false,
        responsive: {
            0: {
                items: 1,
                margin: 0,
            },

            578: {
                items: 2,
                margin: 20,
            },

            1024: {
                items: 3,
                margin: 25,
            },

            1366: {
                items: 4
            }
        }
    });

    })
    
</script>