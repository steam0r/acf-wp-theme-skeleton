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
</section>

<?php get_footer(); ?>
