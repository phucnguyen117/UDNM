<?php
/**
 * Plugin Name: Custom Site Customizer Logo
 * Description: Plugin cho phép thay đổi logo, tiêu đề và mô tả trang web với giao diện trực quan, sử dụng WordPress Media Library.
 * Version: 1.1
 * Author: PhucNguyen
 * License: GPL2
 */

// Ngăn chặn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

// Thêm trang cài đặt vào menu admin
function csc_add_admin_menu() {
    add_options_page(
        'Custom Site Settings', // Tiêu đề trang
        'Custom Site Settings', // Tên menu
        'manage_options',       // Quyền truy cập
        'csc_settings',         // Slug
        'csc_settings_page'     // Hàm render trang
    );
}
add_action('admin_menu', 'csc_add_admin_menu');

// Đăng ký các settings
function csc_register_settings() {
    register_setting('csc_options_group', 'csc_site_title', 'sanitize_text_field');
    register_setting('csc_options_group', 'csc_site_description', 'sanitize_textarea_field');
    register_setting('csc_options_group', 'csc_site_logo_id', 'absint'); // Lưu ID của logo
}
add_action('admin_init', 'csc_register_settings');

// Thêm script cho WordPress Media Uploader
function csc_enqueue_media_uploader() {
    if (isset($_GET['page']) && $_GET['page'] === 'csc_settings') {
        wp_enqueue_media(); // Load WordPress Media Uploader
        wp_enqueue_script('csc_admin_script', plugin_dir_url(__FILE__) . 'csc-admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'csc_enqueue_media_uploader');

// Tạo file JS để xử lý Media Uploader
function csc_create_admin_js() {
    $js_code = <<<JS
jQuery(document).ready(function($) {
    var mediaUploader;
    $('#csc_upload_logo_button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media({
            title: 'Chọn Logo Trang Web',
            button: { text: 'Chọn Logo' },
            multiple: false,
            library: { type: 'image' }
        });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#csc_site_logo_id').val(attachment.id);
            $('#csc_logo_preview').html('<img src="' + attachment.url + '" style="max-width: 300px;" />');
        });
        mediaUploader.open();
    });

    // Xóa logo
    $('#csc_remove_logo_button').click(function(e) {
        e.preventDefault();
        $('#csc_site_logo_id').val('');
        $('#csc_logo_preview').html('<p>Chưa có logo nào được thiết lập.</p>');
    });
});
JS;

    // Lưu file JS vào thư mục plugin
    file_put_contents(plugin_dir_path(__FILE__) . 'csc-admin.js', $js_code);
}
add_action('admin_init', 'csc_create_admin_js');

// Hàm render trang cài đặt
function csc_settings_page() {
    ?>
    <div class="wrap">
        <h1>Custom Site Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('csc_options_group');
            do_settings_sections('csc_settings');
            ?>

            <!-- Phần hiển thị và chọn logo -->
            <h2>Logo Trang Web</h2>
            <p>Hiện tại logo đang sử dụng:</p>
            <div id="csc_logo_preview">
                <?php
                $logo_id = get_option('csc_site_logo_id');
                if ($logo_id) {
                    echo wp_get_attachment_image($logo_id, 'medium', false, array('style' => 'max-width: 300px;'));
                } else {
                    echo '<p>Chưa có logo nào được thiết lập.</p>';
                }
                ?>
            </div>
            <p>
                <input type="hidden" name="csc_site_logo_id" id="csc_site_logo_id" value="<?php echo esc_attr($logo_id); ?>">
                <button id="csc_upload_logo_button" class="button">Chọn hoặc Upload Logo</button>
                <button id="csc_remove_logo_button" class="button">Xóa Logo</button>
                <p class="description">Chọn logo từ Media Library hoặc upload mới (PNG/JPG, kích thước khuyến nghị: 200x50px).</p>
            </p>

            <!-- Phần thay đổi tiêu đề -->
            <h2>Tiêu Đề Trang Web</h2>
            <input type="text" name="csc_site_title" id="csc_site_title" value="<?php echo esc_attr(get_option('csc_site_title', get_option('blogname'))); ?>" style="width: 100%; max-width: 500px;">

            <!-- Phần thay đổi mô tả -->
            <h2>Mô Tả Trang Web</h2>
            <textarea name="csc_site_description" id="csc_site_description" rows="3" style="width: 100%; max-width: 500px;"><?php echo esc_textarea(get_option('csc_site_description', get_option('blogdescription'))); ?></textarea>

            <?php submit_button('Lưu Thay Đổi'); ?>
        </form>
    </div>
    <?php
}

// Cập nhật logo, tiêu đề, mô tả khi submit
function csc_handle_form_submission() {
    if (isset($_POST['option_page']) && $_POST['option_page'] === 'csc_options_group') {
        // Cập nhật tiêu đề và mô tả
        update_option('blogname', sanitize_text_field($_POST['csc_site_title']));
        update_option('blogdescription', sanitize_textarea_field($_POST['csc_site_description']));

        // Cập nhật logo
        $logo_id = absint($_POST['csc_site_logo_id']);
        update_option('csc_site_logo_id', $logo_id);
        if ($logo_id) {
            set_theme_mod('custom_logo', $logo_id); // Cập nhật custom logo cho theme
        } else {
            remove_theme_mod('custom_logo'); // Xóa logo nếu không có
        }
    }
}
add_action('admin_init', 'csc_handle_form_submission');

// Hỗ trợ custom-logo cho theme
function csc_setup_theme_support() {
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'csc_setup_theme_support');