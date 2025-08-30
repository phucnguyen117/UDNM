<?php
get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg') ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
            interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>

<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
            <?php $homepageEvents = new WP_Query(array(
                'posts_per_page'     => 2,
                'post_type' => 'event',
                'meta_key' => 'start_day',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'start_day',
                    )
                )
            ));
            while ($homepageEvents->have_posts()) :
                $homepageEvents->the_post();
            ?>
                <div class="event-summary">
                    <?php $date_event = new DateTime(the_field('start_day'));
                    $month_event = $date_event->format('M');
                    $day_event = $date_event->format('d');
                    ?>
                    <a class="event-summary__date t-center" href="#">
                        <span class="event-summary__month"><?php echo $month_event; ?> </span>
                        <span class="event-summary__day">25</span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a
                                href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h5>
                        <p> <?php
                            if (has_excerpt())
                                echo get_the_excerpt();
                            else
                                echo  wp_trim_words(get_the_content(), 18);
                            ?><a href="#" class="nu gray">Learn more</a>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">View All Events</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>


            <div class="event-summary">
                <a class="event-summary__date event-summary__date--beige t-center" href="#">
                    <span class="event-summary__month">Jan</span>
                    <span class="event-summary__day">20</span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="#">We Were Voted Best School</a>
                    </h5>
                    <p>For the 100th year in a row we are voted #1. <a href="#" class="nu gray">Read more</a></p>
                </div>
            </div>


            <p class="t-center no-margin"><a href="#" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide"
                style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide"
                style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <!-- <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                        id, thumbnail, title, excerpt, content, permalink,
                        the_id(), the_thumbnail(), the_title(), the_content() khoong co return
                        get_the_id(), get_the_thumbnail(), get_the_title(), get_the_content() khoong co return -->

                    </div>
                </div>
            </div>
            <div class="hero-slider__slide"
                style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>

<?php
get_footer();
