<?php
function phucnguyen_theme_setup() {
    // Thêm hỗ trợ tiêu đề
    add_theme_support('title-tag');
    
    // Thêm hỗ trợ hình ảnh nổi bật
    add_theme_support('post-thumbnails');
    
    // Đăng ký menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'phucnguyen-theme'),
    ));

    // Cho phép theme hỗ trợ logo
    add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
    ));
    
    // Đăng ký sidebar
    register_sidebar(array(
        'name' => __('Main Sidebar', 'phucnguyen-theme'),
        'id' => 'main-sidebar',
        'description' => __('Widgets in this area will be shown on all posts and pages.', 'phucnguyen-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('after_setup_theme', 'phucnguyen_theme_setup');

// Thêm CSS và JS
function phucnguyen_theme_scripts() {
    wp_enqueue_style('phucnguyen-style', get_stylesheet_uri());
    //bootstrap css
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3', 'all');
    //bootstrap js
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
    //bootstrap icon
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css', array(), '1.11.3', 'all');
    // Thêm custom js
    wp_enqueue_style('custom-css', get_template_directory_uri().'/assets/css/custom.css', [], filemtime(get_template_directory() . '/assets/css/custom.css'));
    wp_enqueue_script('custom-js', get_theme_file_uri('/assets/js/custom.js'), ['bootstrap-css'], filemtime(get_template_directory() . '/assets/js/custom.js'), true);
}
add_action('wp_enqueue_scripts', 'phucnguyen_theme_scripts');


// Bootstrap Nav Walker
class Bootstrap_Nav_Menu_Walker extends Walker_Nav_Menu {
    private $dropdown_toggle = '<a href="%s" class="nav-link dropdown-toggle" id="menu-item-dropdown-%s" role="button" data-bs-toggle="dropdown" aria-expanded="false">%s</a>';

    function start_lvl(&$output, $depth=0, $args=null) {
        $output .= '<ul class="dropdown-menu shadow-sm">';
    }

    function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        if (in_array('menu-item-has-children', $classes)) {
            $output .= '<li class="nav-item dropdown">';
            $output .= sprintf(
                $this->dropdown_toggle,
                esc_url($item->url),
                $item->ID,
                esc_html($item->title)
            );
        } else {
            $output .= '<li class="nav-item"><a class="nav-link" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
        }
    }

    function end_el(&$output, $item, $depth=0, $args=null) {
        $output .= "</li>";
    }
}


// Thêm Banner Custom
function phucnguyen_customize_register($wp_customize) {
    $wp_customize->add_section('homepage_banner', array(
        'title'    => __('Homepage Banner', 'phucnguyen-theme'),
        'priority' => 30,
    ));

    // Banner 1
    $wp_customize->add_setting('banner1_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner1_image', array(
        'label'    => __('Banner 1', 'phucnguyen-theme'),
        'section'  => 'homepage_banner',
        'settings' => 'banner1_image',
    )));

    // Banner 2
    $wp_customize->add_setting('banner2_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner2_image', array(
        'label'    => __('Banner 2', 'phucnguyen-theme'),
        'section'  => 'homepage_banner',
        'settings' => 'banner2_image',
    )));

    // Banner 3
    $wp_customize->add_setting('banner3_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner3_image', array(
        'label'    => __('Banner 3', 'phucnguyen-theme'),
        'section'  => 'homepage_banner',
        'settings' => 'banner3_image',
    )));
}
add_action('customize_register', 'phucnguyen_customize_register');


//Điều chỉnh tìm kiếm
function mytheme_search_only_posts($query) {
    if ($query->is_search && $query->is_main_query() && !is_admin()) {
        $query->set('post_type', 'post'); // Chỉ tìm trong bài viết
    }
}
add_action('pre_get_posts', 'mytheme_search_only_posts');

?>