<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Title -->
            <h1 class="mb-4 section-title">
                <?php single_cat_title( __( 'Danh mục: ', 'phucnguyentheme' ) ); ?>
            </h1>
            <?php if (have_posts()) : ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col">
                            <div class="card h-100 border border-dark shadow-sm">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php the_post_thumbnail_url('medium_large'); ?>" 
                                             class="card-img-top img-fluid rounded-top" 
                                             alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2">
                                        <?php the_title(); ?>
                                    </h5>
                                    <div class="mb-2 text-muted small">
                                        <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?> &nbsp;|&nbsp;
                                        <i class="bi bi-folder"></i>
                                        <?php
                                          $categories = get_the_category();
                                          if ( ! empty( $categories ) ) {
                                              echo esc_html( $categories[0]->name );
                                          }
                                        ?>
                                    </div>
                                    <p class="card-text text-muted flex-grow-1">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="bi bi-chevron-left"></i>',
                        'next_text' => '<i class="bi bi-chevron-right"></i>',
                        'screen_reader_text' => ' ',
                        'type' => 'list', // tạo ul/li để dễ style
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <p class="text-center">Không có bài viết nào trong danh mục này.</p>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 d-none d-lg-block">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
