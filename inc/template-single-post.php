<div class="body_detail">
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
                        <p class="desc">
                            <?php if (has_excerpt()) {
                                echo  get_the_excerpt();
                            }  ?>
                        </p>
                        <div class="media">
                            <div class="media-body">
                                <div class="d-flex  justify-content-center">
                                    <div class="p-2 align-items-left">
                                        <img data-src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?>" class="lozad mr-3 author_image_detail rounded-circle" alt="<?php the_author(); ?>" width="40" height="40">
                                    </div>
                                    <div class="p-2 align-items-left mt-1">
                                        <p class="detail_author_name"><?php the_author(); ?> at <?php the_date('D, d M Y') ?> </p>
                                    </div>
                                    <div class="ml-auto p-2 author_social float-right mt-1">
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
                            <img class="img_heading lozad" data-srcset="<?php the_post_thumbnail_url('medium'); ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php the_post_thumbnail_url('full'); ?>" alt="halo....">
                        <?php } else { ?>
                            <img class="img_heading lozad img-fluid" data-srcset="https://via.placeholder.com/650x200 2x, image-to-lazy-load-1x.jpg 1x" data-src="https://via.placeholder.com/650x250" alt="<?php the_title_attribute(); ?>">
                        <?php } ?>
                        <div class="content">
                            <?php echo the_content(); ?>
                        </div>
                        <?php echo the_tags('<div class="pt-5 pb-2"><span class="badge badge-success tags_bottom mb-2">', '</span><span class="mb-2 badge badge-success tags_bottom">', '</span></div>');  ?>
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
        <div class="row mp-5 d-flex flex-row">
            <div class="col-md-12 mb-5">
                <div class="title_related_heading border-bottom ">Postingan Terkait</div>
            </div>
            <?php
            $related = ci_get_related_posts(get_the_ID(), 3);
            if ($related->have_posts()) :
                while ($related->have_posts()) : $related->the_post(); ?>
                    <div class=" col-md-4 card_related">
                        <div class="card">
                            <?php
                            if (has_post_thumbnail()) { ?>
                                <img class="card-img-top img_related lozad" data-srcset="<?php the_post_thumbnail_url('medium'); ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php the_post_thumbnail_url('medium') ?>" alt="<?php the_title_attribute(); ?>" height="200">
                            <?php } else { ?>
                                <img class="card-img-top img_related lozad" data-srcset="https://via.placeholder.com/720x350" data-src="https://via.placeholder.com/720x350" alt="<?php the_title_attribute(); ?>" height="200">
                            <?php } ?>
                            <div class="card-body">
                                <a href="<?php the_permalink(); ?>">
                                    <h2 class="card-title title_related" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
                                </a>
                                <div class="d-flex flex-row">
                                    <div class="p-2 align-items-center">
                                        <img class="rounded-circle img_related lozad" data-srcset="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?> 2x, image-to-lazy-load-1x.jpg 1x" data-src="<?php echo esc_url(get_avatar_url(get_the_author_meta('ID'))) ?>" alt="<?php get_the_author(); ?>" width="50" height="50">
                                    </div>
                                    <div class="p-2 align-items-center">
                                        <div class="author_related_and_category ">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"> <?php the_author(); ?> </a> In <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>"><?php echo get_the_category()[0]->cat_name; ?></a><br>
                                            <span class="time_related"><?php the_time('F j, Y') ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();

            ?>
        </div>

    </div>
</div>
</div>