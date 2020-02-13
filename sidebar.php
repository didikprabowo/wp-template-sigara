<div class="widget_siber">
	<?php dynamic_sidebar('sidebar-1'); ?>
</div>
<div class="sticky-top ">
	<div class="widget_siber populer_show">
		<div class="title_sidebar_ok">
			<h3 class="title_heading_sidebar">Populer On Website</h3>
		</div>
		<div class="body_sidebar">
			<div class="content_populer">
				<?php
				$popularpost_lists = new WP_Query(array(
					'posts_per_page' => 6,
					'meta_key' => 'wpb_post_views_count',
					'orderby' => 'meta_value_num',
					'order' => 'DESC'
				));
				$i = 1;
				while ($popularpost_lists->have_posts()) : $popularpost_lists->the_post();
					if ($i == 8) {
						break;
					}
					$i += 1;
				?>
					<div class="list_populer">
						<a href="<?php the_permalink(); ?>" class="content_populer_title_link" title="<?php the_title(); ?> ">
							<h3 class="content_populer_title"><?php the_title(); ?> </h3>
							<div class="body_populer_list">
								<a class="author_sidebar" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php ucfirst(the_author()); ?>"><?php ucfirst(the_author()); ?></a> In <a class="category_sidebar" href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>" title="<?php echo get_the_category()[0]->cat_name; ?>"><?php echo get_the_category()[0]->cat_name; ?> </a>
							</div>
						</a>
					</div>
				<?php endwhile;
				?>
			</div>
		</div>
	</div>
	<div class="widget_siber ">
		<div class="about_fix">
			<div class="title_sidebar_ok">
				<h3 class="title_heading_sidebar ">Tentang Kami</h3>
			</div>
			<div class="body_sidebar">
				<?php
				$menuLocations = get_nav_menu_locations();
				$menuID = $menuLocations['footer_1'];
				$primaryNav = wp_get_nav_menu_items($menuID);
				?>
				<ul class="contact_list_heading">
					<?php
					foreach ($primaryNav as $navItem) {
						echo '<li class="contact_sidebar"><a href="' . $navItem->url . '" title="' . $navItem->title . '">' . $navItem->title . '</a></li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>

</div>
</div>