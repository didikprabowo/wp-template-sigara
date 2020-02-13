<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sigara
 */

get_header(); ?>
<div class="body ">
	<div class="container">
		<h1 class="body_title_tagline d-none"><?php echo get_bloginfo(); ?> </h1>
		<?php
		$i = 0;
		$popularpost = new WP_Query(array(
			'numberposts' => 1,
			'meta_key' => 'wpb_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		));
		while ($popularpost->have_posts()) : $popularpost->the_post();
			if ($i == 1) {
				break;
				return;
			}
		?>
	</div>
	<div class="container">
		<div class="featured mb-5">
			<div class="row">
				<div class="col-md-8 ">
					<a href="<?php the_permalink(); ?>" class="border">
						<?php if (has_post_thumbnail()) { ?>
							<img class="lozad image_featured img-fluid border" data-srcset="<?php the_post_thumbnail_url('medium_large'); ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php echo get_the_title() ?>" height="">
						<?php } else { ?>
							<img class="lozad image_featured img-fluid border" data-srcset="https://via.placeholder.com/750X400 2x, image-to-lazy-load-1x.jpg 1x" data-src="https://via.placeholder.com/750X400" alt="<?php echo get_the_title() ?>" height="">
						<?php } ?>
					</a>
				</div>
				<div class="col-md-4">
					<a href="<?php the_permalink(); ?>" class="link_featured">
						<h2 class="title_featured"><?php the_title(); ?></h2>
					</a>
					<span class="category_title mb-4"><b>In</b>
						<a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"> <?php echo get_the_category()[0]->cat_name; ?></a></span><br>
					<p class="desc_featured"><?php echo get_the_excerpt(); ?> </p>
					<div class="d-flex flex-row">
						<div class="p-2">
							<img class="rounded-circle lozad" data-src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?>" data-srcset="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?> 2x, image-to-lazy-load-1x.jpg 1x" alt="<?php echo get_the_author(); ?>" height="50" width="50">
						</div>
						<div class="p-2">
							<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
								<span class="author_featured"><?php echo get_the_author(); ?></span>
							</a><br>
							<span class="time_featured">
								<span><?php the_time('F j, Y') ?></span>
								</a>
						</div>
					</div>
				</div>
			<?php
			$i += 1;
		endwhile; ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 list_post_home">
				<?php
				if (have_posts()) {
					while (have_posts()) : the_post(); ?>
						<?php get_template_part('template-parts/content', get_post_format()); ?>
				<?php
					endwhile;
				}
				?>

			</div>
			<div class="col-md-4">
				<div class="widget_siber">
					<div class="body_sidebar">
						<div class="card">
							<div class="card-body">
								<div class="title_newsletter">Newsletter...</div>
								<p class="card-text">Some quick example text to build on the card title and make up
									<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('set_feedbanner'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
										<div class="form-group">
											<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email">
											<small id="emailHelp" class="form-text text-muted">We'll never share
												your email with anyone else.</small>
											<input type="hidden" value="<?php echo get_option('set_feedbanner'); ?>" name="uri" />
											<input type="hidden" name="loc" value="en_US" />
										</div>
										<input type="submit" class="btn btn-outline-primary col-md-12" value="Subscribe" />
									</form>
							</div>
						</div>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<?php
	get_sidebar();
	echo '</div>';
	get_footer();
	?>