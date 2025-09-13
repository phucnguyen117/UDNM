<?php
/**
 * Template Name: Search Page
 * Description: Hiển thị kết quả tìm kiếm
 */

get_header(); ?>

<div class="container mt-4">
    <h2 class="mb-4">
        Kết quả tìm kiếm cho: <span class="text-primary">"<?php echo get_search_query(); ?>"</span>
    </h2>

    <?php if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" 
                                     class="card-img-top" alt="<?php the_title(); ?>">
                            </a>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <p class="card-text">
                                <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                            </p>
                        </div>

                        <div class="card-footer text-muted">
                            <small><i class="bi bi-calendar"></i> <?php echo get_the_date(); ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Phân trang -->
        <div class="pagination-wrapper my-4">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('« Trước'),
                'next_text' => __('Sau »'),
            ));
            ?>
        </div>

    <?php else : ?>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 50vh;">
            <div class="alert alert-warning text-center w-100">
                Không tìm thấy kết quả nào cho từ khóa <b><?php echo get_search_query(); ?></b>.
            </div>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
