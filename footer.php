</div>
<?php
    $coffee_tea_footer_bg_color = get_theme_mod('coffee_tea_footer_bg_color');
    $coffee_tea_footer_bg_image = get_theme_mod('coffee_tea_footer_bg_image');
    $coffee_tea_footer_opacity = get_theme_mod('coffee_tea_footer_bg_image_opacity', 50);
    $coffee_tea_opacity_decimal = $coffee_tea_footer_opacity / 100;

    // Compose inline styles for footer background
    $coffee_tea_footer_styles = 'background-color: ' . esc_attr($coffee_tea_footer_bg_color) . ';';
    if ($coffee_tea_footer_bg_image) {
        $coffee_tea_footer_styles .= ' background-image: linear-gradient(rgba(0,0,0,' . (1 - $coffee_tea_opacity_decimal) . '), rgba(0,0,0,' . (1 - $coffee_tea_opacity_decimal) . ')), url(' . esc_url($coffee_tea_footer_bg_image) . ');';
    }
?>
<footer class="footer-area" style="<?php echo esc_attr($coffee_tea_footer_styles); ?>">  	<div class="container"> 
		<?php 
		$coffee_tea_footer_widgets_setting = get_theme_mod('coffee_tea_footer_widgets_setting', '1');

		do_action('coffee_tea_footer_above'); 
		
		if ($coffee_tea_footer_widgets_setting != '') { 
			if (is_active_sidebar('coffee-tea-footer-widget-area')) { ?>
				<div class="row footer-row"> 
					<?php dynamic_sidebar('coffee-tea-footer-widget-area'); ?>
				</div>  
			<?php 
			} else { ?>
				<div class="row footer-row">
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.3s">
						<aside id="search-3" class="widget widget_search default_footer_search">
							<h2 class="widget-title w-title"><?php esc_html_e('Search', 'cafe-coffee-charm'); ?></h2>
							<form method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
								<label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search..." value="" name="s">
								</label>
								<button type="submit" class="search-submit" value="Search">
									<i class="fa fa-search"></i>
								</button>
							</form>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.5s">
						<aside id="archives-2" class="widget widget_archive">
							<h2 class="widget-title w-title"><?php esc_html_e('Recent Posts', 'cafe-coffee-charm'); ?></h2>
							<ul>
								<?php
								wp_get_archives(array(
									'type' => 'postbypost',
									'format' => 'html',
									'limit' => 5,
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.7s">
						<aside id="pages-2" class="widget widget_pages">
							<h2 class="widget-title w-title"><?php esc_html_e('Pages', 'cafe-coffee-charm'); ?></h2>
							<ul>
								<?php
								wp_list_pages(array(
									'title_li' => '',
									'number'  => 5,
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.9s">
						<aside id="categories-2" class="widget widget_categories">
							<h2 class="widget-title w-title"><?php esc_html_e('Categories', 'cafe-coffee-charm'); ?></h2>
							<ul>
								<?php
								wp_list_categories(array(
									'title_li' => '',
									'number'  => 5,
								));
								?>
							</ul>
						</aside>
					</div>
				</div>
			<?php } 
		} ?>
	</div>
	
	<?php 
		$coffee_tea_footer_copyright = get_theme_mod('coffee_tea_footer_copyright','');
	?>
	<?php $coffee_tea_footer_copyright_setting = get_theme_mod('coffee_tea_footer_copyright_setting','1');
	 if( $coffee_tea_footer_copyright_setting != ''){?> 
	<div class="copy-right wow flipInX" data-wow-delay="0.5s"> 
		<div class="container">
			<p class="copyright-text">
				<?php
					echo esc_html( apply_filters('coffee_tea_footer_copyright',($coffee_tea_footer_copyright)));
			    ?>
				<?php if (empty($coffee_tea_footer_copyright)) { ?>
				    <?php echo esc_html__('Copyright &copy; 2025,', 'cafe-coffee-charm'); ?>
				    <a href="<?php echo esc_url('https://www.seothemesexpert.com/products/cafe-coffee-charm-theme'); ?>" target="_blank">
				        <?php echo esc_html__('Cafe Coffee Charm', 'cafe-coffee-charm'); ?>
				    </a>
				    <span> | </span>
				    <a href="<?php echo esc_url('https://wordpress.org/'); ?>" target="_blank">
				        <?php echo esc_html__('WordPress Theme', 'cafe-coffee-charm'); ?>
				    </a>
				<?php } ?>
			</p>
		</div>
	</div>
	<?php }?>
	<?php $coffee_tea_scroll_top = get_theme_mod('coffee_tea_scroll_top_setting','1');
      if($coffee_tea_scroll_top == '1') { ?>
		<a id="scrolltop"><span><?php esc_html_e('TOP','cafe-coffee-charm'); ?><span></a>
	<?php } ?>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>