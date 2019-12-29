<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

$show_navigation = get_post_meta( get_the_ID(), '_et_pb_project_nav', true );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<section class="portfolio-hero-area clearfix">
		
		<?php the_field('featured_video'); ?>

	</section>
	<!-- /.portfolio-hero-area clearfix -->
	<section class="singlepage-container clearfix">
		<div class="container">
			<div class="left-sidebar clearfix">
				<div class="left-sidebar-title clearfix">
					<h1><?php the_title(); ?></h1>
				</div>
				<div class="left-sidebar-content clearfix">
					<?php

	 				if(the_field('content')){
					?>
						<p><?php the_field('content'); ?></p>

						<?php
					}
					?>
				</div>
				<!-- /.left-sidebar-content -->
			</div>
			<!-- /.left-sidebar -->
			<div class="right-sidebar clearfix">
				<div class="single-right-sidebar clearfix">

					<?php 
						$contributers = get_field('contributers');
						if( $contributers ) {
						?>
							<h3>Contributers</h3>
							<p><?php echo $contributers ?></p>
						<?php
						}
					?>
				</div>
				<!-- /.single-right-sidebar -->

				<div class="single-right-sidebar clearfix">
					<?php 
						$vimeo_link = get_field('vimeo_link');
						if( $vimeo_link ) {
						?>
							<h3>See More On Our Vimeo</h3>
							<a href="<?php echo $vimeo_link; ?>">vimeo.com</a>
						<?php
						}
					?>
				</div>
				<!-- /.single-right-sidebar -->

				<div class="single-right-sidebar clearfix">
					<?php 
						$website_name = get_field('website_name');
						$website_link = get_field('website_link');
						if( $website_name ) {
						?>
							<h3>Website</h3>
							<a target="_blank" href="<?php echo $website_link; ?>"><?php echo $website_name; ?></a>
						<?php
						}
					?>
				</div>
				<!-- /.single-right-sidebar -->
			</div>
			<!-- /.right-sidebar -->
		</div> <!-- .container -->
	</section>
	<!-- /.singlepage-container -->

	<style>
		#top-menu li a{
			color:<?php the_field('menu_color'); ?>;
		}
		ul#top-menu li > a:before {
		    background:<?php the_field('menu_color'); ?>;
		}
	</style>
	

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
