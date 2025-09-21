<?php
/*
Template Name: Trang chủ
*/
get_header(); ?>

<div class="carousel-container">
<div id="homepageCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>

    <div class="carousel-inner">
        <?php 
        // Banner 1
        $banner1_img  = get_field('banner_image1');
        // Banner 2
        $banner2_img  = get_field('banner_image2');
        ?>

        <!-- Banner 1 -->
        <?php if ($banner1_img): ?>
        <div class="carousel-item active" data-bs-interval="5000">
            <img src="<?php echo esc_url($banner1_img['url']); ?>" class="d-block w-100 banner-img" alt="<?php echo esc_attr($banner1_img['alt']); ?>">

            <div class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start h-100">
                <div class="caption-content w-50">
                    <?php if (get_field('banner_title')): ?>
                    <h2 class="fw-bold"><?php echo esc_html(get_field('banner_title')); ?></h2>
                    <?php endif; ?>

                    <?php if (get_field('banner_desc')): ?>
                    <h3 class="lead"><?php the_field('banner_desc'); ?></h3>
                    <?php endif; ?>

                    <?php if (get_field('banner_btn_link') && get_field('banner_btn_text')): ?>
                    <a href="<?php echo esc_url(get_field('banner_btn_link')); ?>" class="btn btn-danger mt-3 btn-sm">
                        <?php echo esc_html(get_field('banner_btn_text')); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Banner 2 -->
        <?php if ($banner2_img): ?>
        <div class="carousel-item <?php echo empty($banner1_img) ? 'active' : ''; ?>" data-bs-interval="5000">
            <img src="<?php echo esc_url($banner2_img['url']); ?>" class="d-block w-100 banner-img" alt="<?php echo esc_attr($banner2_img['alt']); ?>">

            <div class="carousel-caption d-flex flex-column justify-content-center align-items-start text-start h-100">
                <div class="caption-content w-50">
                    <?php if (get_field('banner_title2')): ?>
                    <h2 class="fw-bold"><?php the_field('banner_title2'); ?></h2>
                    <?php endif; ?>

                    <?php if (get_field('banner_desc2')): ?>
                    <h3 class="lead"><?php the_field('banner_desc2'); ?></h3>
                    <?php endif; ?>

                    <?php if (get_field('banner_btn_link2') && get_field('banner_btn_text2')): ?>
                    <a href="<?php the_field('banner_btn_link2'); ?>" class="btn btn-danger mt-3 btn-sm">
                        <?php the_field('banner_btn_text2'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

  </div>
</div>
</div>

<div class="news-block mb-5">
    <div class="container news-row">
        <h2 class="news-title"><?php _e('Tin Tức', 'phucnguyentheme'); ?></h2>
            <div class="vr d-none d-lg-block"></div>
        <div class="news-categories">
            <!-- bai viet con -->
            <?php
            $child_categories = get_categories(array(
                'orderby' => 'name',
                'order'   => 'ASC',
                'parent'  => 0
            ));

            foreach ($child_categories as $parent_cat) {
                $children = get_categories(array(
                    'orderby' => 'name',
                    'order'   => 'ASC',
                    'parent'  => $parent_cat->term_id
                ));

                foreach ($children as $child) {
                    echo '<a href="' . get_category_link($child->term_id) . '" class="news-category news-category-child">' . $child->name . '</a>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Sticker -->
    <div class="news-overlay d-none d-lg-block" alt="Sticker trang trí">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/anh2.png"  alt="Sticker" />
    </div>
</div>


<section class="latest-news py-5 mt-4 position-relative">
    
    <!-- Sticker -->
    <div class="news-overlay2 d-none d-lg-block" alt="Sticker trang trí">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/anh3.png" alt="Sticker">
    </div>

    <div class="container">
        <h2 class="section-title mb-5"><?php _e('Tin Mới Nhất', 'phucnguyentheme'); ?></h2>
        <div class="row">
            <?php
            $latest_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 4, // số bài muốn hiển thị
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($latest_posts->have_posts()) :
                while ($latest_posts->have_posts()) : $latest_posts->the_post();
            ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3 bg-white">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-top']); ?>
                            <?php endif; ?>
                            <div class="card-body">
                            <h3 class="card-title h5">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                                <p class="card-text">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                <p class="card-text text-muted small mb-2 d-flex justify-content-between">
                                    <span><i class="bi bi-calendar-event"></i> <?php echo get_the_date(); ?></span>
                                    <span>
                                        <i class="bi bi-folder"></i> 
                                        <?php
                                          $categories = get_the_category();
                                          if ( ! empty( $categories ) ) {
                                              echo esc_html( $categories[0]->name ); // chỉ hiện danh mục đầu tiên
                                          }
                                        ?>
                                    </span>
                                </p>
                                <a href="<?php the_permalink(); ?>" 
                                class="stretched-link" 
                                aria-label="Xem chi tiết bài viết: <?php the_title_attribute(); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center">' . __('Chưa có bài viết nào.', 'phucnguyentheme') . '</p>';
            endif;
            ?>
        </div>
    </div>
</section>


<section class="latest-news py-5 mt-4 position-relative">

    <!-- Sticker -->
    <div class="news-overlay2 d-none d-lg-block" alt="Sticker trang trí">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/anh3.png" alt="Sticker">
    </div>

    <div class="container">
        <h2 class="section-title mb-5"><?php esc_html_e('Tin Nổi Bật', 'phucnguyentheme'); ?></h2>
        <div class="row">
            <?php
            $popular_posts = new WP_Query(array(
                'posts_per_page' => 4, 
                'meta_key'       => 'post_views_count',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC',
            ));

            if ($popular_posts->have_posts()) :
                while ($popular_posts->have_posts()) : $popular_posts->the_post();
            ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3 bg-white">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-top']); ?>
                            <?php endif; ?>
                            <div class="card-body">
                            <h3 class="card-title h5">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>                                
                                <p class="card-text">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </p>
                                <p class="card-text text-muted small mb-2 d-flex justify-content-between">
                                    <span><i class="bi bi-calendar-event"></i> <?php echo get_the_date(); ?></span>
                                    <span>
                                        <i class="bi bi-folder"></i> 
                                        <?php
                                          $categories = get_the_category();
                                          if (!empty($categories)) {
                                              echo esc_html($categories[0]->name);
                                          }
                                        ?>
                                    </span>
                                </p>
                                <a href="<?php the_permalink(); ?>" 
                                class="stretched-link" 
                                aria-label="Xem chi tiết bài viết: <?php the_title_attribute(); ?>">
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center">' . __('Chưa có bài nổi bật nào.', 'phucnguyentheme') . '</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<section class="latest-news py-5 mt-4 position-relative">

    <!-- Sticker -->
    <div class="news-overlay2 d-none d-lg-block" alt="Sticker trang trí">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/anh3.png" alt="Sticker">
    </div>

    <div class="container">
        <h2 class="section-title mb-4 text-center">
            <?php _e('Video Nổi Bật', 'phucnguyentheme'); ?>
        </h2>
        <?php
        $video_url = get_field('home_video');

        if ($video_url):
            $embed_url = '';

            // Link watch?v=
            if (strpos($video_url, 'watch?v=') !== false) {
                $parts = parse_url($video_url);
                parse_str($parts['query'], $query);
                $video_id = $query['v'] ?? '';
                $list_id = $query['list'] ?? '';
                $embed_url = 'https://www.youtube-nocookie.com/embed/' . $video_id;
                if ($list_id) {
                    $embed_url .= '?list=' . $list_id;
                }
            }
            // Link rút gọn youtu.be
            elseif (strpos($video_url, 'youtu.be/') !== false) {
                $parts = parse_url($video_url);
                $video_id = ltrim($parts['path'], '/');
                parse_str($parts['query'] ?? '', $query);
                $list_id = $query['list'] ?? '';
                $embed_url = 'https://www.youtube-nocookie.com/embed/' . $video_id;
                if ($list_id) {
                    $embed_url .= '?list=' . $list_id;
                }
            }
            // Đặt title cho iframe: ưu tiên tiêu đề trang, fallback mặc định
            $iframe_title = sprintf(
                /* translators: %s: site name */
                __('Video nổi bật từ %s', 'phucnguyentheme'),
                get_bloginfo('name')
            );
            ?>
            <div class="video-wrapper mx-auto" style="max-width: 700px;">
                <div class="ratio ratio-16x9 shadow-lg rounded-3 overflow-hidden">
                    <iframe 
                        src="<?php echo esc_url($embed_url); ?>" 
                        title="<?php echo esc_attr($iframe_title); ?>"
                        loading="lazy"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center text-muted">
                <?php _e('Chưa có video được chọn.', 'phucnguyentheme'); ?>
            </p>
        <?php endif; ?>
    </div>
</section>


<?php get_footer(); ?>
