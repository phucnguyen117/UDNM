<?php
/**
 * Plugin Name: Form Liên Hệ Floating
 * Description: Plugin tạo form liên hệ floating đẹp mắt với màu vàng, ở bên phải màn hình, bao gồm số điện thoại, Messenger, Zalo (có thể thu gọn), và nút back-to-top. Sử dụng Bootstrap Icons và icon Zalo từ Icons8.
 * Version: 1.4
 * Author: PhucNguyen
 * License: GPL2
 */

// Ngăn chặn truy cập trực tiếp
if (!defined('ABSPATH')) {
    exit;
}

// Thêm trang cài đặt vào menu admin
function fcw_add_admin_menu() {
    add_menu_page(
        'Floating Contact Settings', // Tiêu đề trang
        'Form Liên Hệ',             // Tên menu
        'manage_options',           // Quyền truy cập
        'fcw_settings',             // Slug
        'fcw_settings_page',        // Hàm render trang
        'dashicons-phone'           // Icon menu
    );
}
add_action('admin_menu', 'fcw_add_admin_menu');

// Đăng ký các settings
function fcw_register_settings() {
    register_setting('fcw_options_group', 'fcw_phone_number', 'sanitize_text_field');
    register_setting('fcw_options_group', 'fcw_messenger_link', 'esc_url_raw');
    register_setting('fcw_options_group', 'fcw_zalo_link', 'esc_url_raw');
}
add_action('admin_init', 'fcw_register_settings');

// Hàm render trang cài đặt
function fcw_settings_page() {
    ?>
    <div class="wrap">
        <h1>Floating Contact Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('fcw_options_group');
            do_settings_sections('fcw_settings');
            ?>

            <h2>Cấu Hình Form Liên Hệ</h2>
            <table class="form-table">
                <tr>
                    <th><label for="fcw_phone_number">Số Điện Thoại</label></th>
                    <td>
                        <input type="text" id="fcw_phone_number" name="fcw_phone_number" value="<?php echo esc_attr(get_option('fcw_phone_number')); ?>" style="width: 300px;">
                        <p class="description">Ví dụ: +84123456789</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="fcw_messenger_link">Link Messenger</label></th>
                    <td>
                        <input type="text" id="fcw_messenger_link" name="fcw_messenger_link" value="<?php echo esc_attr(get_option('fcw_messenger_link')); ?>" style="width: 300px;">
                        <p class="description">Ví dụ: https://m.me/username</p>
                    </td>
                </tr>
                <tr>
                    <th><label for="fcw_zalo_link">Link Zalo</label></th>
                    <td>
                        <input type="text" id="fcw_zalo_link" name="fcw_zalo_link" value="<?php echo esc_attr(get_option('fcw_zalo_link')); ?>" style="width: 300px;">
                        <p class="description">Ví dụ: https://zalo.me/1234567890</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Lưu Thay Đổi'); ?>
        </form>
    </div>
    <?php
}

// Enqueue CSS và JS cho frontend
function fcw_enqueue_assets() {
    // Enqueue Bootstrap Icons với handle riêng
    wp_enqueue_style('fcw-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', array(), '1.10.5');

    // CSS tùy chỉnh với phạm vi giới hạn
    $css = "
        /* Chỉ áp dụng cho plugin */
        .fcw-container {
            position: fixed;
            bottom: 20px;
            right: 20px; /* Trở lại bên phải */
            z-index: 10000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
        .fcw-toggle-btn {
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .fcw-toggle-btn:hover {
            background-color: #E5C100;
            transform: scale(1.05);
        }
        .fcw-contact-options {
            display: none;
            flex-direction: column;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            padding: 15px;
            gap: 12px;
            width: 200px;
            text-align: center;
        }
        .fcw-contact-btn {
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            justify-content: center;
        }
        .fcw-contact-btn:hover {
            background-color: #E5C100;
            transform: translateX(-5px); /* Dịch sang trái khi hover */
        }
        .fcw-contact-btn img {
            width: 20px;
            height: 20px;
        }
        .fcw-back-to-top {
            position: fixed;
            bottom: 80px;
            right: 20px; /* Trở lại bên phải */
            background-color: #FFD700;
            color: #000;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            cursor: pointer;
            display: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            z-index: 9999;
        }
        .fcw-back-to-top:hover {
            background-color: #E5C100;
            transform: scale(1.05);
        }
    ";
    wp_add_inline_style('fcw-bootstrap-icons', $css);

    // JS tùy chỉnh
    $js = "
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.fcw-toggle-btn');
            const options = document.querySelector('.fcw-contact-options');
            const backToTop = document.querySelector('.fcw-back-to-top');

            if (toggleBtn && options) {
                toggleBtn.addEventListener('click', function() {
                    options.style.display = options.style.display === 'none' ? 'flex' : 'none';
                });
            }

            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    if (backToTop) backToTop.style.display = 'block';
                } else {
                    if (backToTop) backToTop.style.display = 'none';
                }
            });

            if (backToTop) {
                backToTop.addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
        });
    ";
    wp_add_inline_script('jquery', $js);
}
add_action('wp_enqueue_scripts', 'fcw_enqueue_assets');

// Thêm HTML cho floating contact vào footer
function fcw_add_floating_contact() {
    $phone = get_option('fcw_phone_number');
    $messenger = get_option('fcw_messenger_link');
    $zalo = get_option('fcw_zalo_link');

    // Chỉ hiển thị nếu có ít nhất một option liên hệ
    if ($phone || $messenger || $zalo) {
        ?>
        <div class="fcw-container">
            <div class="fcw-contact-options">
                <?php if ($phone) : ?>
                    <a href="tel:<?php echo esc_attr($phone); ?>" class="fcw-contact-btn"><i class="bi bi-telephone-fill"></i> Gọi Điện</a>
                <?php endif; ?>
                <?php if ($messenger) : ?>
                    <a href="<?php echo esc_url($messenger); ?>" class="fcw-contact-btn" target="_blank"><i class="bi bi-messenger"></i> Messenger</a>
                <?php endif; ?>
                <?php if ($zalo) : ?>
                    <a href="<?php echo esc_url($zalo); ?>" class="fcw-contact-btn" target="_blank"><img src="https://img.icons8.com/?size=100&id=82445&format=png&color=000000" alt="Zalo" style="width:20px; height:20px;"> Zalo</a>
                <?php endif; ?>
            </div>
            <button class="fcw-toggle-btn" aria-label="Mở menu"><i class="bi bi-chat-dots-fill"></i></button>
        </div>
        <button class="fcw-back-to-top" aria-label="Quay lại đầu trang"><i class="bi bi-arrow-up"></i></button>
        <?php
    }
}
add_action('wp_footer', 'fcw_add_floating_contact');