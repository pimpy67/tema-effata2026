<?php
/**
 * Meta dell'articolo: categoria, data, autore (usato da single.php).
 */
?>
<div class="single-meta">
    <?php $cats = get_the_category(); if ( $cats ) : ?>
    <a class="single-category" href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>">
        <?php echo esc_html( $cats[0]->name ); ?>
    </a>
    <?php endif; ?>
    <span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
    <span class="post-author"><?php esc_html_e( 'di', 'tema-effata2026' ); ?> <?php the_author_posts_link(); ?></span>
</div>
