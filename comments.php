<?php
// Se il post richiede password, esce dalla logica dei commenti
// a meno che l'utente non inserisca la password
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
<?php if ( have_comments()) : ?> 
<h3 class="comments-title">
<?php
$comments_number = get_comments_number(); 
if ( $comments_number == 1 ) {
    echo 'Un commento per ' . get_the_title();
}
else {
    echo $comments_number . ' commenti per ' . get_the_Title();
}
?>
</h3>


 <?php the_comments_navigation(); ?>

<ol class="comment-list">
        <?php
            wp_list_comments( array( 
                    'style'      => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 42,
            ) );
        ?>
</ol>

 <?php the_comments_navigation(); ?>

<?php endif; ?> 


<!-- Se i commenti sono aperti, carica il template -->
 
<?php if ( !comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments') ) : ?>
     <h3 class="no-comments"><?php _e('I commenti sono chiusi', 'tema-effata2026'); ?></h3>
<?php endif; ?>

<?php
    comment_form( array(
        'title_reply'        => 'Scrivi cosa ne pensi',
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'label_submit'       => 'Invia il mio commento',
    ) );
?>

</div> <!-- end comments-area -->

