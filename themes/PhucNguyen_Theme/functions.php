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
    wp_enqueue_script('custom-js', get_theme_file_uri('/assets/js/custom.js'), [], filemtime(get_template_directory() . '/assets/js/custom.js'), true);
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


// Lấy số lượt xem bài viết
function get_post_views($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}

// Tăng lượt xem mỗi khi mở bài viết
function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Tăng lượt xem khi load single post
function track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    set_post_views($post_id);
}
add_action( 'wp_head', 'track_post_views');


//footer
function mytheme_customize_register($wp_customize) {
    $wp_customize->add_section('footer_info', array(
        'title'    => __('Footer', 'textdomain'),
        'priority' => 160,
    ));

    $wp_customize->add_setting('footer_email', array('default' => 'Nhập email vào'));
    $wp_customize->add_control('footer_email', array(
        'label' => __('Email', 'textdomain'),
        'section' => 'footer_info',
        'type' => 'email'
    ));

    $wp_customize->add_setting('footer_phone', array('default' => 'Nhập số vào'));
    $wp_customize->add_control('footer_phone', array(
        'label' => __('Số điện thoại', 'textdomain'),
        'section' => 'footer_info',
        'type' => 'text'
    ));

    $wp_customize->add_setting('footer_facebook', array('default' => '#'));
    $wp_customize->add_control('footer_facebook', array(
        'label' => __('Facebook URL', 'textdomain'),
        'section' => 'footer_info',
        'type' => 'url'
    ));

    $wp_customize->add_setting('footer_twitter', array('default' => '#'));
    $wp_customize->add_control('footer_twitter', array(
        'label' => __('Twitter X URL', 'textdomain'),
        'section' => 'footer_info',
        'type' => 'url'
    ));

    $wp_customize->add_setting('footer_threads', array('default' => '#'));
    $wp_customize->add_control('footer_threads', array(
        'label' => __('Threads URL', 'textdomain'),
        'section' => 'footer_info',
        'type' => 'url'
    ));

}
add_action('customize_register', 'mytheme_customize_register');


// languages textdomain
function phucnguyentheme_load_textdomain() {
    load_theme_textdomain('phucnguyentheme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'phucnguyentheme_load_textdomain');


?>