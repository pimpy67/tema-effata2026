<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
 </head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <header role="banner">
        <div class="content">
            <div class="header">
                <a href="<?php echo esc_url(home_url()); ?>" title="<?php esc_attr_e('Home', 'tema-effata2026'); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo1.png" alt="<?php esc_attr_e('Logo Effata', 'tema-effata2026'); ?>" width="80" height="80">
                </a>


    
            </div> <!-- end header -->
        </div> <!-- End content-->
    </header>

 