<div class="sidebar-card p-4 bg-light rounded shadow-sm border border-warning">
    <!-- Search Widget -->
    <div class="mb-4">
        <h4 class="sidebar-title mb-3 fw-bold text-dark border-bottom border-2 border-warning pb-2"><?php _e('Tìm kiếm', 'phucnguyentheme'); ?></h4>
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="d-flex align-items-center">
            <input type="search" class="form-control me-2" placeholder="<?php _e('Nhập từ khóa...', 'phucnguyentheme'); ?>" value="<?php echo get_search_query(); ?>" name="s" style="border-radius: 0.25rem;" />
            <button type="submit" class="btn btn-outline-warning"><i class="bi bi-search text-dark"></i></button>
        </form>
    </div>

    <!-- Categories Widget -->
    <div class="mb-4">
        <h4 class="sidebar-title mb-3 fw-bold text-dark border-bottom border-2 border-warning pb-2"><?php _e('Danh mục', 'phucnguyentheme'); ?></h4>
        <ul class="list-group list-group-flush">
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => 1,
                'exclude' => 1 // Loại bỏ "Chưa phân loại"
            ));
            foreach ($categories as $category) {
                echo '<li class="list-group-item border-0 py-2"><a href="' . get_category_link($category->term_id) . '" class="text-decoration-none text-dark hover-text-warning">' . $category->name . ' <span class="badge bg-warning text-dark ms-2">' . $category->count . '</span></a></li>';
            }
            ?>
        </ul>
    </div>

    <!-- Popular Posts Widget -->
    <div class="mb-4 p-3 bg-white rounded shadow-sm">
        <h4 class="sidebar-title mb-3 fw-bold text-dark border-bottom border-2 border-warning pb-2"><?php _e('Bài viết nổi bật', 'phucnguyentheme'); ?></h4>
        <ul class="list-unstyled m-0 p-0">
            <?php
            $popular_posts = new WP_Query(array(
                'posts_per_page' => 3,
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            ));
            if ($popular_posts->have_posts()) :
                while ($popular_posts->have_posts()) : $popular_posts->the_post();
            ?>
                <li class="d-flex align-items-start mb-3">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="flex-shrink-0 me-3">
                            <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;" 
                                 alt="<?php the_title(); ?>">
                        </a>
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark hover-text-warning">
                            <h6 class="mb-1 fw-bold"><?php the_title(); ?></h6>
                        </a>
                        <small class="text-muted"><i class="bi bi-calendar me-1"></i><?php echo get_the_date('d/m/Y'); ?></small>
                    </div>
                </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<li class="text-muted">' . __('Chưa có bài nổi bật.', 'phucnguyentheme') . '</li>';
            endif;
            ?>
        </ul>
    </div>
</div>

<style>
.sidebar-card .hover-text-warning:hover {
    color: #ffc107 !important;
}
</style>