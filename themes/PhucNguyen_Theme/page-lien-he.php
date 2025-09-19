<?php 
/*
Template Name: Liên hệ
*/
get_header(); ?>

<div class="container py-5">
    <style>
        :root {
            --yellow: #f7d000;
            --yellow-dark: #e0bc00;
            --border-yellow: #f7d000;
        }
        .border-yellow {
            border-color: var(--border-yellow) !important;
        }
        .contact-info p {
            font-size: 1.1rem;
        }
    </style>

    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="section-title"><?php _e('Liên Hệ', 'phucnguyentheme'); ?></h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Contact Information -->
            <div class="card shadow border border-yellow rounded-3 bg-light">
                <div class="card-body p-5">
                    <h2 class=" mb-4 text-center"><?php _e('Thông tin liên hệ', 'phucnguyentheme'); ?></h2>
                    
                    <div class="contact-info mb-4 mt-5">
                        <!-- Hàng trên -->
                        <div class="contact-top d-flex flex-column flex-md-row justify-content-center gap-4 mb-3 text-center text-md-start">
                            <p class="d-flex align-items-center gap-2 mb-0 justify-content-center justify-content-md-start">
                                <i class="bi bi-envelope fs-3 fw-bold"></i>
                                <span class="fw-semibold text-shadow-yellow"><?php the_field('contact_email'); ?></span>
                            </p>

                            <p class="d-flex align-items-center gap-2 mb-0 justify-content-center justify-content-md-start">
                                <i class="bi bi-telephone fs-3 fw-bold"></i>
                                <span class="fw-semibold text-shadow-yellow"><?php the_field('contact_phone'); ?></span>
                            </p>
                        </div>

                        <!-- Hàng dưới -->
                        <div class="contact-bottom text-center">
                            <p class="d-flex align-items-center justify-content-center gap-2 mb-0">
                                <i class="bi bi-geo-alt fs-3 fw-bold"></i>
                                <span class="fw-semibold text-shadow-yellow"><?php the_field('contact_address'); ?></span>
                            </p>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <?php if( get_field('facebook_url') ): ?>
                        <a href="<?php the_field('facebook_url'); ?>" target="_blank"><i class="bi bi-facebook fs-2 text-primary"></i></a>
                        <?php endif; ?>

                        <?php if( get_field('x_url') ): ?>
                        <a href="<?php the_field('x_url'); ?>" target="_blank"><i class="bi bi-twitter-x fs-2 text-dark"></i></a>
                        <?php endif; ?>

                        <?php if( get_field('threads_url') ): ?>
                        <a href="<?php the_field('threads_url'); ?>" target="_blank"><i class="bi bi-threads fs-2 text-dark"></i></a>
                        <?php endif; ?>
                    </div>

                    <!-- Google Map -->
                    <div class="rounded-3 overflow-hidden shadow-sm">
                        <?php if( get_field('contact_map') ): ?>
                            <iframe src="<?php the_field('contact_map'); ?>" 
                                    width="100%" height="300" style="border:0;" 
                                    allowfullscreen="" loading="lazy"></iframe>
                        <?php else: ?>
                            <p><em><?php _e('Chưa có bảng đồ', 'phucnguyentheme'); ?></em></p>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>