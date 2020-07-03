<?php

acf_form_head();
get_header();
the_post();
$press = in_category('press');
$title = $press ? "Pressemitteilung" : "Blog";
?>

<section>
    <div class="nocontainer" style="background-color: rgb(235, 245, 255);">
        <div class="pageheadline"
             style="background-image: url('<?= get_stylesheet_directory_uri() . "/public/img/blog_article_top.png" ?>');">
          <?= $title ?>
        </div>
    </div>
    <div class="container" class="single">
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
          <?php if (has_post_thumbnail($post)): ?>
              <div class="image">
                  <img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0]; ?>"/>
              </div>
          <?php endif; ?>
            <div class="date">
              <?= get_the_date("d.n.Y") ?>
            </div>
            <div class="title">
              <?= the_title() ?>
            </div>
            <div class="content">
              <?= the_content(); ?>
            </div>
        </article>
    </div>
    <div class="maps nocontainer">
        <a href="/bedburg" class="map"
           style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_bedburg.png' ?>')">&nbsp;</a>
        <a href="/kaisersesch" class="map"
           style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_kaisersesch.png' ?>')">&nbsp;</a>
        <a href="/essen" class="map"
           style="background-image: url('<?= get_stylesheet_directory_uri() . '/public/img/map_essen.png' ?>')">&nbsp;</a>
    </div>
</section>

<?php get_footer(); ?>
