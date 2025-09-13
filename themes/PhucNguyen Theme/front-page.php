<?php get_header(); ?>

<div class="carousel-container">
<div id="homepageCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

  <div class="carousel-indicators">
    <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#homepageCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">
    <?php 
      $banners = [
        get_theme_mod('banner1_image'),
        get_theme_mod('banner2_image'),
        get_theme_mod('banner3_image')
      ];
      $active = "active";
      foreach ($banners as $banner) :
        if ($banner): ?>
          <div class="carousel-item <?php echo $active; ?>" data-bs-interval="4000">
            <img src="<?php echo esc_url($banner); ?>" class="d-block w-100 banner-img" alt="Banner">
          </div>
        <?php 
        $active = ""; // chỉ active cho ảnh đầu tiên
        endif;
      endforeach;
    ?>
  </div>
</div>
</div>


<section class="latest-news container my-5">
  <h2 class="mb-4">Tin mới nhất</h2>
  <div class="row">
    <?php
      // Lấy 5 bài viết mới nhất
      $latest_posts = new WP_Query(array(
        'post_type'      => 'post',   // lấy bài viết
        'posts_per_page' => 5,        // số lượng tin
        'orderby'        => 'date',   // sắp xếp theo ngày
        'order'          => 'DESC'    // mới nhất trước
      ));

      if ($latest_posts->have_posts()) :
        while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
          
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                </a>
              <?php endif; ?>

              <div class="card-body">
                <h5 class="card-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h5>
                <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              </div>
              <div class="card-footer text-muted">
                <small>🗓 <?php echo get_the_date(); ?></small>
              </div>
            </div>
          </div>

        <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>Chưa có tin tức nào.</p>';
      endif;
    ?>
  </div>
</section>

<?php get_footer(); ?>
