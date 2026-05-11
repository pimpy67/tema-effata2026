<?php
/**
 * Template Name: Pagina Iscrizione Newsletter
 * Description: Form iscrizione newsletter con salvataggio DB
 */
get_header();

$esito = $_GET['esito'] ?? '';

// Hero background: usa immagine in evidenza se disponibile, altrimenti colore scuro
$hero_bg = has_post_thumbnail()
    ? 'background-image: url(\'' . get_the_post_thumbnail_url(null, 'full') . '\'); background-position: 65% 20%; background-size: cover; background-repeat: no-repeat;'
    : 'background: #10100e;';
?>

<main role="main">

  <!-- HERO -->
  <div class="hero-progetti" style="<?php echo $hero_bg; ?> padding: 160px 0 100px;">
    <div class="content" style="text-align:center;">
      <span style="display:inline-block; background:#ed1c23; color:#fff; font-size:13px; font-weight:700; letter-spacing:4px; text-transform:uppercase; padding:10px 28px; margin-bottom:28px; border-radius:2px;">Newsletter Effatà</span>
      <h1 style="color:#fff; font-size:4.2rem; font-weight:900; margin-bottom:24px; line-height:1.1; text-shadow: 0 2px 20px rgba(0,0,0,0.4);">
        Entra nel cuore<br><span style="color:#313131; font-size: 1.6rem; text-shadow: none; background: rgba(255,255,255,0.80); padding: 3px 10px; border-radius: 2px; line-height: 1;">dell'Uganda con noi</span>
      </h1>
      <p style="color:#fff; font-size:1.35rem; max-width:620px; margin:0 auto; line-height:1.8; text-shadow: 0 1px 8px rgba(0,0,0,0.5);">
        Iscriviti per ricevere gli aggiornamenti da Silvia Marcolin e vedere come la tua vicinanza cambia davvero la vita di questi bambini.
      </p>
    </div>
  </div>

  <!-- CONTENUTO GUTENBERG (form shortcode + altri blocchi) -->
  <section style="background:#f2f2f2; padding:60px 0;">
    <div class="content">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
