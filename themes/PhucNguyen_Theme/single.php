<?php get_header(); ?>

<style>
.post-meta {
    margin-bottom: 15px;
}
.post-meta .category {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9em;
    color: #333;
}
.post-meta .text-muted {
    font-size: 0.85em;
}
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <!-- Title -->
                <h1 class="mb-3"><?php the_title(); ?></h1>

                <!-- Meta info -->
                <div class="mb-4 text-muted small">
                    <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?> &nbsp;|&nbsp;
                    <i class="bi bi-person"></i> <?php the_author(); ?> &nbsp;|&nbsp;
                    <i class="bi bi-folder"></i>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="text-decoration-none text-muted">';
                        echo esc_html($categories[0]->name);
                        echo '</a>';
                    }
                    ?>
                    &nbsp;|&nbsp;
                    <i class="bi bi-eye"></i> <?php echo get_post_views(get_the_ID()); ?> lượt xem
                </div>

                <!-- Content -->
                <div class="entry-content mb-5">
                    <?php the_content(); ?>
                </div>
                <hr>

                <!-- Related posts -->
                <?php
                $related_posts = new WP_Query(array(
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'category__in' => wp_get_post_categories(get_the_ID()),
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($related_posts->have_posts()) :
                ?>
                    <div class="mb-5">
                        <h4 class="mb-3">Bài viết liên quan</h4>
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                <div class="col">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <div class="card h-100 border shadow-sm flex-row align-items-center">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('medium'); ?>" 
                                                     class="img-fluid rounded-start" 
                                                     style="width: 100px; height: 100px; object-fit: cover;" 
                                                     alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                            <div class="card-body py-2 px-3 flex-grow-1">
                                                <h6 class="mb-1 fw-bold"><?php the_title(); ?></h6>
                                            <div class="post-meta d-flex align-items-center gap-3">
                                                <span class="category">
                                                    <i class="bi bi-folder"></i>
                                                    <?php
                                                    $categories = get_the_category();
                                                    if (!empty($categories)) {
                                                        echo esc_html($categories[0]->name);
                                                    }
                                                    ?>
                                                </span>
                                                <small class="text-muted"><?php echo get_the_date(); ?></small>
                                            </div>                                            
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php
                    wp_reset_postdata();
                endif;
                ?>

            <!-- Comments -->
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

            <?php endwhile; else : ?>
                <p class="text-center">Không tìm thấy bài viết.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
