<div class="card mb-3">
	<div class="row no-gutters">
		<div class="col-md-9">
			<div class="card-body">
				<a href="<?php the_permalink(); ?>" class="title_home_content_link" title="<?php the_title(); ?>">
					<h2 class="card-title title_home_content"><?php the_title(); ?></h2>
				</a>
				<p>In
					<mou class="category_content_list_link">
						<?php if (is_category()) {
							echo get_category_by_slug('category-slug');
						} ?>
						<a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"> <?php echo get_the_category()[0]->cat_name; ?></a></span><br>
					</mou>
				</p>
				<p class="card-text">
					<?php
					echo shorten_string(get_the_excerpt(), 18);
					?>
				</p>
				<p class="card-text author_content_list_link">
					<small class="text-muted">
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="text-muted" title="<?php the_author(); ?>">
							<?php ucfirst(the_author()); ?>
						</a> <b>At</b> <?php the_time('F j, Y') ?>
					</small>
				</p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="image_thumb_home p-4">
				<?php
				if (has_post_thumbnail()) { ?>
					<img class="card-img lozad" data-srcset="<?php the_post_thumbnail_url('thumbnail'); ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php the_post_thumbnail_url('thumbnail'); ?> ?>" alt="<?php the_title_attribute(); ?>">
				<?php } else { ?>
					<img class="card-img lozad" data-srcset="https://via.placeholder.com/150 2x, image-to-lazy-load-1x.jpg 1x" data-src="https://via.placeholder.com/150" alt="<?php the_title_attribute(); ?>">
				<?php } ?>
			</div>
		</div>
	</div>
</div>