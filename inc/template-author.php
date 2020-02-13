<div class="body_author">
    <div class="container">
        <div class="heading_author">
            <div class="col-md-12 shadow-sm p-3 mb-5 bg-white rounded ">
                <div class="row">
                    <div class="col-md-2 justify-content-center">
                        <img data-src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?>" class=" rounded-circle lozad" alt="..." width="130" height="130">
                    </div>
                    <div class="col-md-10 justify-content-center ">
                        <h1 class="author_page_title pt-2"> <?php the_author(); ?> </h1>
                        <p><?php the_author_description(); ?></p>
                        <i class="fab fa-facebook-square fa-2x"></i>
                        <i class="fab fa-twitter-square fa-2x"></i>
                        <i class="fab fa-instagram-square fa-2x"></i>
                    </div>
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
<br>