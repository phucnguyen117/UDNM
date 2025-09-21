    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container text-center text-md-left">
            <div class="row text-center text-md-left">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-start">
                <div class="mb-4">
                    <?php 
                        if ( function_exists( 'the_custom_logo' ) ) {
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            if ( has_custom_logo() ) {
                                echo '<img src="'. esc_url( $logo[0] ) .'" width="'. esc_attr( $logo[1] ) .'" height="'. esc_attr( $logo[2] ) .'" alt="'. get_bloginfo( 'name' ) .'">';
                            }
                        }
                    ?>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi cumque illum cupiditate autem alias</p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3 text-start">
                    <h2 class="h5 text-uppercase mb-4 font-weight-bold text-warning"><?php _e('Tin mới nhất', 'phucnguyentheme'); ?></h2>
                    <?php
                        $latest_posts = new WP_Query(array(
                            'posts_per_page' => 2, // Lấy 2 bài viết
                            'post_status'    => 'publish',
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ));
                        if ($latest_posts->have_posts()) :
                            while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                                <p> <i class="bi bi-dot"></i>
                                    <a href="<?php the_permalink(); ?>" class="text-white" style="text-decoration: none;">
                                        <?php the_title(); ?>
                                    </a>
                                </p>
                            <?php endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>' . esc_html__( 'Chưa có bài viết mới', 'phucnguyentheme' ) . '</p>';
                        endif;
                        ?>
                    </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 text-start">
                    <h2 class="h5 text-uppercase mb-4 font-weight-bold text-warning"><?php _e('Tin nổi bật', 'phucnguyentheme'); ?></h2>
                    <?php
                        $featured_posts = new WP_Query(array(
                            'posts_per_page' => 2, // tăng lên 3 bài để cân đối
                            'meta_key' => 'post_views_count',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC',
                        ));
                        if ($featured_posts->have_posts()) :
                            while ($featured_posts->have_posts()) : $featured_posts->the_post(); ?>
                                <p> <i class="bi bi-dot"></i>
                                    <a href="<?php the_permalink(); ?>" class="text-white" style="text-decoration: none;">
                                        <?php the_title(); ?>
                                    </a>
                                </p>
                            <?php endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>' . esc_html__( 'Chưa có bài viết nổi bật', 'phucnguyentheme' ) . '</p>';
                        endif;
                        ?>
                    </div>


                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 text-start">
                    <h2 class="h5 text-uppercase mb-4 font-weight-bold text-warning"><?php _e('Thông tin', 'phucnguyentheme'); ?></h2>
                    <?php if( get_theme_mod('footer_email') ): ?>
                        <p><i class="bi bi-envelope-fill"></i> <?php echo esc_html( get_theme_mod('footer_email') ); ?></p>
                    <?php endif; ?>

                    <?php if( get_theme_mod('footer_phone') ): ?>
                        <p><i class="bi bi-telephone-fill"></i> <?php echo esc_html( get_theme_mod('footer_phone') ); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <hr class="mb-4">

            <div class="row align-items-center">

                <div class="col-md-7 col-lg-8 text-start">
                    <p>©2025
                        <a href="#" style="text-decoration: none;">
                            <strong class="text-warning"><?php _e('Phúc Nguyên', 'phucnguyentheme'); ?></strong>
                        </a>
                    </p>
                </div>

                <div class="col-md-5 col-lg-4">
                    <div class="text-center text-md-end">
                        <ul class="list-unstyled list-inline">

                            <?php if(get_theme_mod('footer_facebook')): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo esc_url(get_theme_mod('footer_facebook')); ?>" class="btn-floating btn-sm text-white" style="font-size: 23px;" target="_blank" aria-label="Facebook"><i
                                class="bi bi-facebook"></i></a>
                            </li>
                            <?php endif; ?>

                            <?php if(get_theme_mod('footer_twitter')): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo esc_url(get_theme_mod('footer_twitter')); ?>" class="btn-floating btn-sm text-white" style="font-size: 23px;" target="_blank" aria-label="Twitter"><i
                                class="bi bi-twitter-x"></i></a>
                            </li>
                            <?php endif; ?>

                            <?php if(get_theme_mod('footer_threads')): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo esc_url(get_theme_mod('footer_threads')); ?>" class="btn-floating btn-sm text-white" style="font-size: 23px;" target="_blank" aria-label="Threads"><i
                                class="bi bi-threads"></i></a>
                            </li>
                            <?php endif; ?>

                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </footer>
<?php wp_footer(); ?>
</body>
</html>