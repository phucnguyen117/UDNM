<?php get_header(); ?>
<main>
    <div class="container">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article>
                <h1><?php the_title(); ?></h1>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>