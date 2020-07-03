<?php
$number = get_sub_field('blogposts_number');
$title = get_sub_field('blogposts_title');
$subtitle = get_sub_field('blogposts_subtitle');

$pressCat = get_category_by_slug('press');
$pinnedCat = get_category_by_slug('pinned');
$pinned = get_posts([
  "numberposts" => $number,
  "cat" => $pinnedCat->cat_ID
]);

$fillNumber = $number - count($pinned);
$normalPosts = get_posts([
  "numberposts" => $fillNumber,
  "category__not_in" => [ $pinnedCat->cat_ID, $pressCat->cat_ID ]
]);

?>
<div class="container">
    <div class="posts">
      <?php if ($title): ?>
          <div class="headline"><?= $title ?></div>
      <?php endif; ?>
      <?php if ($subtitle): ?>
          <div class="subtext"><?= $subtitle ?></div>
      <?php endif; ?>
        <div class="grid">
          <?php foreach ($pinned as $pinnedPost): ?>
              <div class="post">
                  <a href="<?= get_permalink($pinnedPost); ?>">
                      <div class="header"<?php if (has_post_thumbnail($pinnedPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pinnedPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>&nbsp;</div>
                      <div class="title">
                        <?= $pinnedPost->post_title ?>
                      </div>
                  </a>

                  <div class="excerpt">
                    <?= get_the_excerpt($pinnedPost); ?>
                      <a href="<?= get_permalink($pinnedPost); ?>#more" class="more">
                          <img class="bmwi" src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                      </a>
                  </div>
              </div>
          <?php endforeach; ?>
          <?php foreach ($normalPosts as $normalPost): ?>
              <div class="post">
                  <a href="<?= get_permalink($normalPost); ?>">
                      <div class="header"<?php if (has_post_thumbnail($normalPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($normalPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>&nbsp;</div>
                      <div class="date"></div>
                      <div class="title">
                        <?= get_the_date("j.n.Y", $normalPost) ?> - <?= $normalPost->post_title ?>
                      </div>
                  </a>
                  <div class="excerpt">
                    <?= get_the_excerpt($normalPost); ?>
                      <a href="<?= get_permalink($normalPost); ?>#more" class="more">
                          <img class="bmwi" src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                      </a>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>

