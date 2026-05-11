<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
  // --- Open Graph / Social Meta ---
  if ( is_front_page() ) {
      $og_title = get_bloginfo('name') . ' — ' . get_bloginfo('description');
  } else {
      $og_title = get_the_title() . ' — ' . get_bloginfo('name');
  }

  if ( is_singular() && has_excerpt() ) {
      $og_description = get_the_excerpt();
  } elseif ( is_singular() && get_the_content() ) {
      $og_description = wp_trim_words( strip_tags( get_the_content() ), 25, '…' );
  } else {
      $og_description = get_bloginfo('description');
  }

  $og_image     = '';
  $og_img_w     = '';
  $og_img_h     = '';

  if ( is_singular() && has_post_thumbnail() ) {
      $thumb_id     = get_post_thumbnail_id( get_the_ID() );
      $og_image     = get_the_post_thumbnail_url( get_the_ID(), 'full' );
      $img_data     = wp_get_attachment_image_src( $thumb_id, 'full' );
      if ( $img_data ) {
          $og_img_w = $img_data[1];
          $og_img_h = $img_data[2];
      }
  } else {
      $og_image = get_template_directory_uri() . '/img/og-default.jpg';
  }

  if ( is_singular() ) {
      $og_url = get_permalink();
  } else {
      global $wp;
      $og_url = home_url( add_query_arg( array(), $wp->request ) );
  }

  $og_type = is_singular('post') ? 'article' : 'website';
  ?>

  <!-- Open Graph (Facebook, LinkedIn, WhatsApp…) -->
  <meta property="og:type"             content="<?php echo esc_attr( $og_type ); ?>">
  <meta property="og:url"              content="<?php echo esc_url( $og_url ); ?>">
  <meta property="og:title"            content="<?php echo esc_attr( $og_title ); ?>">
  <meta property="og:description"      content="<?php echo esc_attr( $og_description ); ?>">
  <meta property="og:image"            content="<?php echo esc_url( $og_image ); ?>">
  <meta property="og:image:secure_url" content="<?php echo esc_url( $og_image ); ?>">
  <?php if ( $og_img_w ) : ?>
  <meta property="og:image:width"      content="<?php echo (int) $og_img_w; ?>">
  <meta property="og:image:height"     content="<?php echo (int) $og_img_h; ?>">
  <?php endif; ?>
  <meta property="og:site_name"        content="<?php echo esc_attr( get_bloginfo('name') ); ?>">
  <meta property="og:locale"           content="it_IT">

  <!-- Twitter / X Card -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?php echo esc_attr( $og_title ); ?>">
  <meta name="twitter:description" content="<?php echo esc_attr( $og_description ); ?>">
  <meta name="twitter:image"       content="<?php echo esc_url( $og_image ); ?>">

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


    
                <button class="hamburger" aria-label="Menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <nav class="navbar">
                    <?php wp_nav_menu( array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'menu mainmenu'
                ) ); ?>
            </nav>
            </div> <!-- end header --> 
        </div> <!-- End content-->
    </header>

