<?php

/**
 * Template Name: Home Page
 */

acf_form_head();
get_header();

?>

<section class="content">
  <?php while (have_posts()) :
    the_post(); ?>
    <?php the_content(); ?>
    <?php if (have_rows('content')): ?>
    <?php while (have_rows('content')):
      the_row(); ?>
          <a name="<?= get_row_layout() ?>"></a>
      <?php
      include(get_stylesheet_directory() . '/resources/templates/partials/' . get_row_layout() . '.php');
      ?>
    <?php endwhile; ?>
  <?php endif; ?>
  <?php endwhile; // end of the loop. ?>
    <div class="maps nocontainer">
        <a href="/bedburg" class="map" style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_bedburg.png' ?>')">&nbsp;</a>
        <a href="/kaisersesch" class="map" style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_kaisersesch.png' ?>')">&nbsp;</a>
        <a href="/essen" class="map" style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_essen.png' ?>')">&nbsp;</a>
    </div>
</section>

<?php get_footer(); ?>
