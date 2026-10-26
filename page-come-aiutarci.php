<?php
/**
 * Template Name: Come Aiutarci
 */
get_header(); ?>

<main role="main">

    <!-- Hero -->
    <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
    <div class="hero-progetti"<?php if ($url) echo ' style="background-image: url(' . esc_url($url) . ');"'; ?>>
        <div class="content">
            <h1><?php the_title(); ?></h1>
            <?php get_template_part('template-parts/breadcrumbs'); ?>
        </div>
    </div>

    <!-- Contenuto Gutenberg -->
    <div class="come-aiutarci-wrap">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
            the_content();
        endwhile; endif; ?>
    </div>

</main>

<?php get_footer(); ?>
