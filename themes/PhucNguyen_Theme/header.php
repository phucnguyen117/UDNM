<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
        <?php 
            if (has_custom_logo()) {
                the_custom_logo();
            } else { ?>
                <span class="site-title fw-bold"><?php bloginfo('name'); ?></span>
                <small class="site-description text-muted"><?php bloginfo('description'); ?></small>
        <?php } ?>
    </a>

    <!-- Nút toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Offcanvas menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header mt-3">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php the_custom_logo(); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
    
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'depth' => 2,
                    'fallback_cb' => false,
                    'walker' => new Bootstrap_Nav_Menu_Walker(),
                ));
            ?>

        <hr class="d-lg-none">
          <div class="language-switcher py-2">
              <div class="container">
                  <div class="dropdown d-inline-block">
                      <?php
                      pll_the_languages(array(
                          'dropdown' => 1,
                          'show_flags' => 1,
                          'show_names' => 1,
                          'display_names_as' => 'name',
                          'hide_if_empty' => 1,
                          'dropdown_title' => __('Chọn ngôn ngữ', 'textdomain'),
                      ));
                      ?>
                  </div>
              </div>
          </div>

        <!-- Form tìm kiếm -->
        <form role="search" method="get" class="search-form d-flex d-lg-none mt-4" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="search" class="form-control me-2 w-100" placeholder="<?php _e('Nhập từ khóa...', 'phucnguyentheme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
          <button type="submit" class="btn btn-warning"><i class="bi bi-search"></i></button>
        </form>
        
      </div>
    </div>

    <div class="vr ms-3 d-none d-lg-block"></div>
    
      <!-- Icon tìm kiếm (bên phải menu) -->
      <button class="btn border-0 ms-2 d-none d-lg-block btn-search" type="button" data-bs-toggle="modal" data-bs-target="#searchModal">
        <i class="bi bi-search"></i>
      </button>

  </div>
</nav>


<!-- Modal Search -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
    <div class="modal-content bg-light border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title"><?php _e('Tìm kiếm', 'phucnguyentheme'); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <form role="search" method="get" class="search-form d-flex" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="search" class="form-control me-2" placeholder="<?php _e('Nhập từ khóa...', 'phucnguyentheme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
          <button type="submit" class="btn btn-warning"><i class="bi bi-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

