<?php get_header(); ?>
<div class="body_detail mt-5">
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="row">
					<div class="col-md-2 ">
						<div class="left-sticky-detail">
							<p class="left_bar_title mb-1 pb-1">
								<?php the_author(); ?>
							</p>
							<span class="left_bar_body">
								<?php the_author_description(); ?>
							</span>
						</div>
					</div>
					<div class="col-md-8">
						<h1><?php the_title(); ?></h1>
						<p class="desc"><?php the_excerpt(); ?> </p>
						<div class="media">
							<div class="media-body">
								<div class="d-flex">
									<div class=" p-2 align-items-left">
										<img data-src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?>" class="lozad mr-3 author_image_detail rounded-circle" alt="<?php the_author(); ?>" width="40" height="40">
									</div>
									<div class="p-2 align-items-left">
										<p class="detail_author_name"><?php the_author(); ?></p>
									</div>
									<div class="ml-auto p-2 author_social float-right">
										<i class=" bagikan align-items-center"> Bagikan : </i>
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Bagikan ke Facebook">
											<i class="fab fa-facebook-square fa-2x float-right"></i>
										</a>
										<a href="https://twitter.com/home?status=<?php the_permalink(); ?> <?php the_title(); ?>" title="Bagikan ke Twitter">
											<i class="fab fa-twitter-square fa-2x float-right"></i>
										</a>
										<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php the_permalink(); ?>&description=<?php the_title(); ?>" title="Bagikan ke Pinterest">
											<i class="fab fa-pinterest-square fa-2x float-right"></i>
										</a>
										<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=<?php the_title(); ?>&source=" title="Bagikan ke linkedin">
											<i class="fab fa-linkedin fa-2x float-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php
						if (has_post_thumbnail()) { ?>
							<img class="img_heading lozad" data-srcset="<?php the_post_thumbnail_url('full'); ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php the_post_thumbnail_url('full'); ?>" alt="halo....">
						<?php } else { ?>
							<img class="img_heading lozad img-fluid" data-srcset="https://via.placeholder.com/650x200 2x, image-to-lazy-load-1x.jpg 1x" data-src="https://via.placeholder.com/650x250" alt="<?php the_title_attribute(); ?>">
						<?php } ?>
						<div class="content">
							<?php echo the_content(); ?>
						</div>
						<?php echo the_tags('<div class="pt-5 pb-2"><span class="badge badge-success tags_bottom">', '</span><span class="badge badge-success tags_bottom">', '</span></div>');  ?>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>

		<div class="row">
			<div class="col-md-8 col-sm-12 offset-md-2 mb-5  pt-4 pb-4">
				<?php if (get_comments_number(get_the_ID()) > 0) { ?>
					<span class="comment_title">Komentar</span><br><br>
				<?php } ?>
				<?php
				comments_template('/comments.php');
				echo "<br>";
				if (comments_open() || pings_open()) {
					formComment(get_the_ID());
				}
				?>
			</div>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>