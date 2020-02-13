<?php get_header(); ?>
<div class="body mt-5">
	<div class="container">
		<div class="p-3">
			<div class="row">
				<div class="col-md-12 shadow-sm p-3 mb-5 bg-white rounded ">
					<h1 class="title_by_category">Hasil Pencarian : <?php echo get_search_query(); ?> </h1>
				</div>
			</div>
		</div>
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
						<div class="card shadow-none">
							<div class="card-body">
								<div class="title_newsletter">Newsletter...</div>
								<p class="card-text">Some quick example text to build on the card title and make up
									<form>
										<div class="form-group">
											<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email">
											<small id="emailHelp" class="form-text text-muted">We'll never share
												your email with anyone else.</small>
										</div>
										<button type="submit" class="btn btn-outline-primary col-md-12">Submit</button>
									</form>
							</div>
						</div>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	const observer = lozad('.lozad', {
		threshold: 0.9,
		load: function(el) {
			el.src = el.dataset.src;
			el.onload = function(el) {
				el.classList.add('fadein');
			}

		}

	});
	observer.observe(); // observes newly added elements as well
</script>

<?php get_footer(); ?>