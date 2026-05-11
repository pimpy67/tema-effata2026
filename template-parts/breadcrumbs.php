<!-- BREADCRUMBS CON YOAST-->
<div class="breadcrumbs">
    <?php
    
    if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
    }
    
    ?>
</div> <!-- end breadrumbs -->        

<!-- BREADCRUMBS CON RANK_MATH-->

<?php if ( function_exists('rank_math_the_breadcrumbs') ) : ?>
    <div class="breadcrumbs">
        <?php rank_math_the_breadcrumbs(); ?>
    </div>
<?php endif; ?>