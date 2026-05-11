<?php
/**
 * Template Name: Chi Siamo
 */
get_header(); ?>

<main role="main">

    <!-- Hero -->
    <?php
    $hero_style = '';
    if ( has_post_thumbnail() ) {
        $img_url = get_the_post_thumbnail_url( $post->ID, 'full' );
        $hero_style = 'background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url(\'' . esc_url($img_url) . '\'); background-size: cover; background-position: center center; background-repeat: no-repeat;';
    }
    ?>
    <div class="hero-progetti"<?php if ($hero_style) echo ' style="' . $hero_style . '"'; ?>>
        <div class="content">
            <h1><?php the_title(); ?></h1>
            <?php get_template_part('template-parts/breadcrumbs'); ?>
        </div>
    </div>

    <!-- Contenuto Gutenberg (sezioni 2–8) -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
    endwhile; endif; ?>

</main>

<?php get_footer(); ?>
