<?php
/*
Template Name: Thông Tin 
*/
get_header();
?>

<div class="container pt-5">
    <div class="text-center mb-5">
        <h1 class="section-title"><?php _e('Thông Tin', 'phucnguyentheme'); ?></h1>
    </div>
</div>

<div class="profile-container border border-warning p-4">
    <div class="profile-header">
        <div class="profile-avatar">
            <?php
            $img = get_field('tt_image');
            if ($img) {
                // nếu field image trả về array
                $img_url = is_array($img) ? $img['url'] : $img;
                echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr(get_field('tt_name')) . '" class="avatar-img">';
            }
            ?>
        </div>
        <h1 class="profile-name"><?php the_field('tt_name'); ?></h1>
    </div>

    <div class="profile-content">
        <h2><?php _e('Thông Tin Cá Nhân', 'phucnguyentheme'); ?></h2>
        <div class="profile-info">
            <div class="info-item">
                <span class="info-label"><?php _e('Họ và Tên', 'phucnguyentheme'); ?>:</span>
                <span class="info-value"><?php the_field('tt_name'); ?></span>
            </div>
            <div class="info-item">
                <span class="info-label"><?php _e('Email', 'phucnguyentheme'); ?>:</span>
                <span class="info-value"><?php the_field('tt_email'); ?></span>
            </div>
            <div class="info-item">
                <span class="info-label"><?php _e('Số điện thoại', 'phucnguyentheme'); ?>:</span>
                <span class="info-value"><?php the_field('tt_phone'); ?></span>
            </div>
            <div class="info-item">
                <span class="info-label"><?php _e('Địa chỉ', 'phucnguyentheme'); ?>:</span>
                <span class="info-value"><?php the_field('tt_address'); ?></span>
            </div>
            <div class="info-item">
                <span class="info-label"><?php _e('Mô tả', 'phucnguyentheme'); ?>:</span>
                <span class="info-value"><?php the_field('tt_description'); ?></span>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
