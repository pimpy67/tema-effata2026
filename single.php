<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<main role="main">

    <!-- Fascia header piccola -->
    <div class="single-blog-header">
        <div class="single-blog-header__inner">
            <span class="single-blog-label">Blog</span>
        </div>
    </div>

    <!-- Toolbar condividi -->
    <div class="single-toolbar">
        <div class="single-toolbar__inner content">
            <span class="single-toolbar__label">Condividi</span>
            <a class="single-share-btn single-share-btn--fb"
               href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
               target="_blank" rel="noopener" aria-label="Condividi su Facebook">Facebook</a>
            <a class="single-share-btn single-share-btn--tw"
               href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo urlencode( get_the_title() ); ?>"
               target="_blank" rel="noopener" aria-label="Condividi su Twitter">Twitter</a>
            <a class="single-share-btn single-share-btn--mail"
               href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&body=<?php the_permalink(); ?>"
               aria-label="Condividi via email">Email</a>
        </div>
    </div>

    <?php
    // Dagli articoli del 23/10/2026 in poi il titolo va a tutta larghezza, sopra testo e colonna di destra.
    // Gli articoli precedenti restano com'erano.
    $titolo_largo = get_the_date( 'Y-m-d' ) >= '2026-10-23';
    ?>

    <!-- Contenuto articolo -->
    <div class="single-article-wrap">
        <div class="content">

            <?php if ( $titolo_largo ) : ?>
            <!-- Titolo e meta a tutta larghezza -->
            <header class="single-head">
                <h1 class="single-title single-title--largo"><?php the_title(); ?></h1>
                <?php get_template_part( 'template-parts/single-meta' ); ?>
            </header>
            <?php endif; ?>

            <div class="flex article-flex">

                <div class="col-6 col-1">

                    <?php if ( ! $titolo_largo ) : ?>
                    <!-- Titolo -->
                    <h1 class="single-title"><?php the_title(); ?></h1>

                    <?php get_template_part( 'template-parts/single-meta' ); ?>
                    <?php endif; ?>

                    <!-- Immagine in evidenza -->
                    <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="single-featured-img">
                        <?php the_post_thumbnail( 'full', array( 'class' => 'single-thumb' ) ); ?>
                    </figure>
                    <?php endif; ?>

                    <!-- Testo -->
                    <div class="section-title text">
                        <?php the_content(); ?>
                    </div>

                    <div class="divider"></div>

                    <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                </div>

                <?php get_sidebar(); ?>

            </div>
        </div>
    </div>

</main>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
