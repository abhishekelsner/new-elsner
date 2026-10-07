<div class="site-wrapper" id="fooddash-page">
	<section class="banner-section">
		<div class="banner pink-bg">
			<div class="container-large">
				<div class="row">
					<div class="banner-left">
						<div class="published-date aos-item">
							<date><?php echo date('Y'); ?></date>
						</div>
						<div class="banner-content aos-item">
							<img  src="<?php echo get_field('banner_app_logo'); ?>" alt="logo" width="180" height="40" loading="lazy"> />
							<h2 class="section-title"><?php echo get_field('main_banner_title'); ?></h2>
						</div>
						<div class="published-category aos-item">
							<p><?php echo get_field('solution_category'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="banner-image aos-item">
			<img  src="<?php echo get_field('main_banner_images'); ?>" alt="banner-image" loading="lazy"> />
		</div>
		<div class="circle"></div>
		<div class="circle circle-1"></div>
	</section>
	<section class="intro-section">
		<div class="container-large">
			<div class="row">
				<div class="intro-block w-60 aos-item">
					<h2 class="section-title"><?php echo get_field('intro_title'); ?></h2>
					<?php the_field('intro_content'); ?>
				</div>
				<div class="intor-image w-40 aos-item">
					<img  src="<?php echo get_field('intro_image'); ?>" alt="intor-image" />
				</div>
				<div class="intro-logo aos-item">
					<img  src="<?php echo get_field('intro_logo'); ?>" alt="intro-logo" />
				</div>
			</div>
		</div>
	</section>
	<section class="typography-sectoion yellow-bg">
		<div class="container-large">
			<div class="typo-block">
				<h2 class="section-title aos-item"><?php echo get_field('typography_heading'); ?></h2>
				<div class="typo-list">
					<?php the_field('typography_text'); ?>
					<div class="typo-right-image aos-item">
						<img  src="<?php echo get_field('typo_image'); ?>" alt="half-circle" />
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="exploremore_btn">
		<div class="exp-btn"><a class="btn button black" href="<?php echo get_field('make_button_url_link'); ?>"><?php echo get_field('make_button_title'); ?></a></div>
	</section>
	<section class="wire-frame-section">
		<div class="container-large">
			<div class="wire-frame-top aos-item">
				<h2 class="section-title"><?php echo get_field('wireframe_heading'); ?></h2>
				<p><?php echo get_field('wireframe_text'); ?></p>
			</div>
			<div class="wire-frame-list">
				<?php
				$rows = get_field('wireframe_gallery');
				if ($rows) {
					$firstarray = array_chunk($rows, 4);
					$firstArr = $firstarray[0];
					$secondArr = $firstarray[1];
				?>
					<div class="row aos-item">
						<?php foreach ($firstArr as $row) { ?>
							<div class="w-25">
								<img  src="<?php echo $row['wireframe_images']; ?>" alt="wireframe" />
							</div>

						<?php } ?>
					</div>
					<div class="row aos-item">
						<?php foreach ($secondArr as $row1) { ?>
							<div class="w-25">
								<img  src="<?php echo $row1['wireframe_images']; ?>" alt="wireframe" />
							</div>

						<?php } ?>
					</div>
				<?php }
				?>

				<!-- <div class="wire-frame-list">
				<div class="row aos-item" >
					<div class="w-25">
						<img  src="images/wireframe-1.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-2.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-3.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-4.png" alt="wireframe" />
					</div>
				</div>
				<div class="row aos-item">
					<div class="w-25">
						<img  src="images/wireframe-5.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-6.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-7.png" alt="wireframe" />
					</div>
					<div class="w-25">
						<img  src="images/wireframe-8.png" alt="wireframe" />
					</div>
				</div> 
			</div> -->
			</div>
	</section>
	<section class="visual-design-section pink-bg">
		<div class="container-large">
			<div class="row">
				<div class="w-60">
					<div class="visual-design-intro aos-item">
						<h2 class="section-title"><?php echo get_field('visual_title'); ?></h2>
						<p><?php the_field('visual_text'); ?> </p>
					</div>
				</div>
				<div class="w-40">
					<div class="visual-design-image aos-item">
						<figure>
							<img  src="<?php echo get_field('launch_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('launch_title'); ?></figcaption>
						</figure>
					</div>
				</div>
			</div>
			<div class="visual-design-screen aos-item">
				<h4><?php echo get_field('screen_title'); ?></h4>
				<div class="visual-login-images row">
					<div class="visual-login-image">
						<img  src="<?php echo get_field('screen_image_1'); ?>" alt="vs-login" />
					</div>
					<div class="visual-login-image">
						<img  src="<?php echo get_field('screen_image_2'); ?>" alt="vs-login" />
					</div>
					<div class="visual-login-image">
						<img  src="<?php echo get_field('screen_image_3'); ?>" alt="vs-login" />
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="user-app-section light-gray-bg">
		<div class="container-large">
			<div class="user-app-block aos-item">
				<h2 class="section-title"><?php echo get_field('user_title_main'); ?></h2>
				<?php the_field('user_content'); ?>
			</div>
		</div>
	</section>
	<section class="user-guide-section">
		<div class="container-large">
			<h3 class="section-title aos-item"><?php echo get_field('user_visual_heading'); ?></h3>
		</div>
		<div class="home-screen full">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('screen_images_user'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('screen_title_1'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('screen_text_1'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('location-image-user'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('screen_title_2'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('screen_text_2'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="popular-screen yellow-bg">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('popular_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('popular_title_1'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('popular_text'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('restaurant_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('restaurant_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('restaurant_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="profile-screen full">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('profile_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('profile_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('profile_text'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('checkout_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('checkout_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('checkout_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="profile-screen full pink-bg">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('order-images'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('orders_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('order_text'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('live_order_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('live_order_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('live_order_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="vendor-guide-section">
		<div class="container-large">
			<h3 class="section-title aos-item"><?php echo get_field('vendor_main_heading'); ?></h3>
		</div>
		<div class="home-screen full">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('dashboard_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('dashboard_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('dashboard_text'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('cancel_order_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('cancel_order_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('cancel_order_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="delevery-guide-section yellow-bg">
		<div class="container-large">
			<h3 class="section-title aos-item"><?php echo get_field('delivery_title'); ?></h3>
		</div>
		<div class="home-screen full">
			<div class="container-large">
				<div class="user-block-list">
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('delivery_db_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('delivery_dashboard_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('delivery_db_text'); ?></p>
						</div>
					</div>
					<div class="user-block">
						<figure class="aos-item">
							<img  src="<?php echo get_field('delivery_live_image'); ?>" alt="visual-design">
							<figcaption><?php echo get_field('delivery_live_title'); ?></figcaption>
						</figure>
						<div class="user-block-text aos-item">
							<p><?php the_field('delivery_live_text'); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="other-screen-section">
		<div class="container-large">
			<h2 class="section-title aos-item"><?php echo get_field('other_screens_title'); ?></h2>
			<div class="other-screens aos-item">
				<img  src="<?php echo get_field('other_screen_image'); ?>" alt="other-screen" />
			</div>
		</div>
	</section>
</div>
<footer class="site-footer pink-bg">
	<div class="footer-content">
		<div class="footer-logo aos-item">
			<img  src="<?php echo get_field('footer_image'); ?>" alt="logo food dash" />
		</div>
		<h2 class="section-title aos-item"><?php echo get_field('footer_text'); ?></h2>
	</div>
</footer>
<script>
	// jQuery(window).load(function(){
	// 	AOS.init({
	// 		easing: 'ease-in-out-sine',
	// 		once: true
	// 	});
	// });
</script>