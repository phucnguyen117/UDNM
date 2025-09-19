<?php
get_header();
?>

<div class="container py-5">
    <style>
        .text-yellow {
            color: #f7d000 !important;
        }
        .btn-yellow {
            background-color: #f7d000;
            border-color: #f7d000;
            color: #000;
        }
        .btn-yellow:hover {
            background-color: #e0bc00;
            border-color: #e0bc00;
            color: #000;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1 class="display-1 fw-bold text-yellow mb-4">404</h1>
            <h2 class="mb-4"><?php esc_html_e('Oops! Trang không tìm thấy', 'textdomain'); ?></h2>
            <p class="lead text-muted mb-4"><?php esc_html_e('Có vẻ như trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển. Hãy thử tìm kiếm hoặc quay lại trang chủ.', 'textdomain'); ?></p>

            <!-- Search Form -->
            <div class="mb-4">
                <form role="search" method="get" class="search-form d-flex justify-content-center" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group w-50">
                        <input type="search" class="form-control" placeholder="<?php esc_attr_e('Tìm kiếm...', 'textdomain'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                        <button type="submit" class="btn btn-yellow"><?php esc_html_e('Tìm', 'textdomain'); ?></button>
                    </div>
                </form>
            </div>

            <!-- Navigation Links -->
            <div class="d-flex justify-content-center gap-3">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-yellow"><?php esc_html_e('Về trang chủ', 'textdomain'); ?></a>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-outline-secondary"><?php esc_html_e('Xem bài viết', 'textdomain'); ?></a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>