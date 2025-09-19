<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-section mb-5">
    <style>
        .comments-section {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .comment-list {
            list-style: none;
            padding: 0;
        }
        .comment-item {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 15px;
            padding: 15px;
        }
        .comment-reply {
            margin-left: 40px;
            border-left: 3px solid #e9ecef;
            padding-left: 15px;
        }
        @media (max-width: 576px) {
            .comment-reply {
                margin-left: 15px;
                padding-left: 10px;
            }
        }
        .comment-meta {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .comment-author {
            font-weight: 600;
            color: #333;
        }
        .comment-date {
            font-size: 0.85em;
            color: #6c757d;
            margin-left: 10px;
        }
        .comment-content {
            line-height: 1.6;
            color: #444;
        }
        .comment-reply-link {
            font-size: 0.9em;
            color: #007bff;
            text-decoration: none;
        }
        .comment-reply-link:hover {
            text-decoration: underline;
        }
        .comment-navigation .nav-links {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }
        .comment-navigation .nav-links .page-numbers {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
        }
        .comment-navigation .nav-links .page-numbers.current {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .comment-navigation .nav-links .page-numbers:hover {
            background-color: #f8f9fa;
        }
        .no-comments {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }
        .comment-form .form-control {
            border-radius: 6px;
            border: 1px solid #ced4da;
        }
        .comment-form .btn-primary {
            background-color: #f7d000;
            border-color: #f7d000;
            border-radius: 6px;
            padding: 10px 20px;
            color: #000
        }
        .comment-form .btn-primary:hover {
            background-color: #e0bc00;
            border-color: #e0bc00;
        }
    </style>

    <?php if (have_comments()) : ?>
        <h4 class="mb-4"><?php printf(_n('%s Bình luận', '%s Bình luận', get_comments_number(), 'textdomain'), number_format_i18n(get_comments_number())); ?></h4>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => function ($comment, $args, $depth) {
                    ?>
                    <li <?php comment_class('comment-item' . ($depth > 1 ? ' comment-reply' : '')); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="comment-meta">
                            <div class="me-3">
                                <?php echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle')); ?>
                            </div>
                            <div>
                                <span class="comment-author"><?php echo esc_html(get_comment_author()); ?></span>
                                <span class="comment-date"> • <?php echo get_comment_date(get_option('date_format')); ?> <?php echo get_comment_time(get_option('time_format')); ?></span>
                            </div>
                        </div>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <div class="alert alert-warning mt-2" role="alert">
                                <?php esc_html_e('Bình luận của bạn đang chờ duyệt.', 'textdomain'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="comment-content">
                            <?php comment_text(); ?>
                        </div>
                        <div class="mt-2">
                            <?php
                            comment_reply_link(array_merge($args, array(
                                'reply_text' => '<i class="bi bi-reply"></i> ' . esc_html__('Trả lời', 'textdomain'),
                                'depth'      => $depth,
                                'max_depth'  => $args['max_depth'],
                                'add_below'  => 'comment',
                                'before'     => '<span class="comment-reply-link">',
                                'after'      => '</span>'
                            )));
                            ?>
                        </div>
                    </li>
                    <?php
                }
            ));
            ?>
        </ul>

        <?php
        $comment_pagination = paginate_comments_links(array(
            'prev_text' => '&laquo; ' . esc_html__('Trước', 'textdomain'),
            'next_text' => esc_html__('Tiếp theo', 'textdomain') . ' &raquo;',
            'type'      => 'list',
            'echo'      => false
        ));
        if ($comment_pagination) : ?>
            <nav class="comment-navigation" aria-label="<?php esc_attr_e('Điều hướng bình luận', 'textdomain'); ?>">
                <?php echo wp_kses_post($comment_pagination); ?>
            </nav>
        <?php endif; ?>

    <?php else : ?>
        <p class="no-comments"><?php esc_html_e('Chưa có bình luận nào. Hãy là người đầu tiên bình luận!', 'textdomain'); ?></p>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments text-muted"><?php esc_html_e('Bình luận đã bị đóng.', 'textdomain'); ?></p>
    <?php endif; ?>

    <?php
    $comment_form_args = array(
        'class_form'         => 'comment-form needs-validation',
        'class_submit'       => 'btn btn-primary mt-2',
        'title_reply'        => esc_html__('Viết bình luận', 'textdomain'),
        'title_reply_before' => '<h5 class="mb-3">',
        'title_reply_after'  => '</h5>',
        'comment_notes_before' => '',
        'comment_field'      => '
            <div class="mb-3">
                <label for="comment" class="form-label visually-hidden">' . esc_html__('Bình luận', 'textdomain') . '</label>
                <textarea class="form-control" placeholder="' . esc_attr__('Bình luận của bạn...', 'textdomain') . '" id="comment" name="comment" rows="5" required></textarea>
                <div class="invalid-feedback">' . esc_html__('Vui lòng nhập bình luận.', 'textdomain') . '</div>
            </div>',
        'fields'             => array(
            'author' => '
                <div class="mb-3">
                    <label for="author" class="form-label visually-hidden">' . esc_html__('Họ tên', 'textdomain') . '</label>
                    <input class="form-control" id="author" placeholder="' . esc_attr__('Họ tên', 'textdomain') . '" name="author" type="text" value="' . esc_attr(wp_get_current_commenter()['comment_author']) . '" required>
                    <div class="invalid-feedback">' . esc_html__('Vui lòng nhập họ tên.', 'textdomain') . '</div>
                </div>',
            'email'  => '
                <div class="mb-3">
                    <label for="email" class="form-label visually-hidden">' . esc_html__('Email', 'textdomain') . '</label>
                    <input class="form-control" id="email" placeholder="' . esc_attr__('Email', 'textdomain') . '" name="email" type="email" value="' . esc_attr(wp_get_current_commenter()['comment_author_email']) . '" required>
                    <div class="invalid-feedback">' . esc_html__('Vui lòng nhập email hợp lệ.', 'textdomain') . '</div>
                </div>',
        ),
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" %4$s>' . esc_html__('Gửi bình luận', 'textdomain') . '</button>',
        'logged_in_as'       => '<p class="logged-in-as mb-3">' . sprintf(
            esc_html__('Đăng nhập với tư cách %s. %s'),
            '<a href="' . esc_url(admin_url('profile.php')) . '">' . esc_html(wp_get_current_user()->display_name) . '</a>',
            '<a href="' . esc_url(wp_logout_url(get_permalink())) . '">' . esc_html__('Đăng xuất?', 'textdomain') . '</a>'
        ) . '</p>',
        'cookies'            => '', // Remove the cookies consent checkbox
    );

    // Include url field only for logged-in users
    if (is_user_logged_in()) {
        $comment_form_args['fields']['url'] = '
            <div class="mb-3">
                <label for="url" class="form-label visually-hidden">' . esc_html__('Website', 'textdomain') . '</label>
                <input class="form-control" id="url" placeholder="' . esc_attr__('Website (không bắt buộc)', 'textdomain') . '" name="url" type="url" value="' . esc_attr(wp_get_current_commenter()['comment_author_url']) . '">
            </div>';
    }

    comment_form($comment_form_args);
    ?>
</div>