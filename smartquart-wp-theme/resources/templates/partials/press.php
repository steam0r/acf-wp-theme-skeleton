<?php
$number = get_sub_field('number');
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');

$pressCat = get_category_by_slug('press');
$pressPosts = get_posts([
  "numberposts" => $number,
  "cat" => $pressCat->cat_ID
]);

?>
<div class="container">
    <div class="press">
      <?php if ($title): ?>
          <div class="headline"><?= $title ?></div>
      <?php endif; ?>
      <?php if ($subtitle): ?>
          <div class="subtext"><?= $subtitle ?></div>
      <?php endif; ?>
        <div class="posts">
          <?php foreach ($pressPosts as $pressPost): ?>
              <div class="post">
                  <div class="excerpt">
                      <div class="date"><?= get_the_date("j.n.Y", $pressPost) ?></div>
                      <div class="title">
                          <a href="<?= get_permalink($pressPost); ?>">
                            <?= get_the_title($pressPost) ?>
                          </a>
                      </div>
                    <?= get_the_excerpt($pressPost); ?>
                      <a href="<?= get_permalink($pressPost); ?>#more" class="more">
                          <img class="bmwi" src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                      </a>
                  </div>

                  <div class="image"<?php if (has_post_thumbnail($pressPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pressPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                      &nbsp;
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>

