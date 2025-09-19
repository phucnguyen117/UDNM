<?php
get_header(); ?>

<section class="search-results py-5 bg-light">
    <div class="container">
        <!-- Search Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-dark">
                Kết quả tìm kiếm cho: <span class="text-warning"><?php echo get_search_query(); ?></span>
            </h1>
        </div>

        <!-- Search Results -->
        <?php if (have_posts()) : ?>
            <div class="row justify-content-center">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'style' => 'height: 200px; object-fit: cover;']); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/no-image.jpg" 
                                         class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?php the_title(); ?>">
                                </a>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">
                                    <a href="<?php the_permalink(); ?>" class="text-dark text-decoration-none"><?php the_title(); ?></a>
                                </h5>
                                <p class="card-text text-muted flex-grow-1"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                                <a href="<?php the_permalink(); ?>" class="stretched-link"></a>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 text-muted small d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-person-circle me-1"></i><?php the_author(); ?></span>
                                <span><i class="bi bi-calendar me-1"></i><?php echo get_the_date('d/m/Y'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper my-4 d-flex justify-content-center">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('« Trước', 'textdomain'),
                    'next_text' => __('Sau »', 'textdomain'),
                    'before_page_number' => '<span class="me-2 btn btn-outline-warning">',
                    'after_page_number'  => '</span>',
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="d-flex align-items-center justify-content-center" style="min-height: 50vh;">
                <div class="alert alert-warning text-center w-75">
                    Không tìm thấy kết quả nào cho từ khóa <strong><?php echo get_search_query(); ?></strong>. 
                    Hãy thử tìm kiếm với từ khóa khác.
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>