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

    <!-- Contenuto articolo -->
    <div class="single-article-wrap">
        <div class="content">
            <div class="flex article-flex">

                <div class="col-6 col-1">

                    <!-- Titolo -->
                    <h1 class="single-title"><?php the_title(); ?></h1>

                    <!-- Meta: categoria + data + autore -->
                    <div class="single-meta">
                        <?php $cats = get_the_category(); if ( $cats ) : ?>
                        <a class="single-category" href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
                            <?php echo esc_html( $cats[0]->name ); ?>
                        </a>
                        <?php endif; ?>
                        <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                        <span class="post-author"><?php esc_html_e( 'di', 'tema-effata2026' ); ?> <?php the_author_posts_link(); ?></span>
                    </div>

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
