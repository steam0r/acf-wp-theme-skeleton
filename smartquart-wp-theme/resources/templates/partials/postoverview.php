<?php

$pressCat = get_category_by_slug('press');
$pinnedCat = get_category_by_slug('pinned');
$pinnedPosts = get_posts([
  "cat" => $pinnedCat->cat_ID
]);

$pinnedIds = [];
foreach ($pinnedPosts as $exclude) {
  $pinnedIds[] = $exclude->ID;
}

$overviewPosts = get_posts([
  "category__not_in" => [$pinnedCat->cat_ID, $pressCat->cat_ID],
  "exclude" => $pinnedPosts
]);
?>

<div class="archive">
  <?php $i = 0;
  foreach ($pinnedPosts as $pinnedPost): $even = ($i % 2 == 0); ?>
      <div class="nocontainer<?= $even ? ' even' : ' odd'; ?>">
          <div class="container">
              <article id="post-<?php $pinnedPost->ID; ?>">
                <?php if ($even): ?>
                    <a href="<?= get_permalink($pinnedPost); ?>">
                        <div class="header"<?php if (has_post_thumbnail($pinnedPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pinnedPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                            &nbsp;
                        </div>
                    </a>
                    <div class="content">
                        <div class="title">
                            <a href="<?= get_permalink($pinnedPost); ?>">
                                <?= get_the_title($pinnedPost) ?>
                            </a>
                        </div>
                      <?= get_the_excerpt($pinnedPost); ?>
                        <a href="<?= get_permalink($pinnedPost); ?>#more" class="more">
                            <img class="bmwi"
                                 src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="content">
                        <div class="title">
                            <a href="<?= get_permalink($pinnedPost); ?>">
                              <?= get_the_title($pinnedPost) ?>
                            </a>
                        </div>
                      <?= get_the_excerpt($pinnedPost); ?>
                        <a href="<?= get_permalink($pinnedPost); ?>#more" class="more">
                            <img class="bmwi"
                                 src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                        </a>
                    </div>
                    <a href="<?= get_permalink($pinnedPost); ?>">
                        <div class="header"<?php if (has_post_thumbnail($pinnedPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pinnedPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                            &nbsp;
                        </div>
                    </a>
                <?php endif; ?>

              </article>
          </div>
      </div>
    <?php $i++; endforeach; ?>
  <?php
  foreach ($overviewPosts as $overviewPost): $even = ($i % 2 == 0); ?>
      <div class="nocontainer<?= $even ? ' even' : ' odd'; ?>">
          <div class="container">
              <article id="post-<?php $overviewPost->ID; ?>">
                <?php if ($even): ?>
                    <a href="<?= get_permalink($overviewPost); ?>">
                        <div class="header"<?php if (has_post_thumbnail($overviewPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($overviewPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                            &nbsp;
                        </div>
                    </a>
                    <div class="content">
                        <div class="title">
                            <a href="<?= get_permalink($overviewPost); ?>">
                              <?= get_the_title($overviewPost) ?>
                            </a>
                        </div>
                      <?= get_the_excerpt($overviewPost); ?>
                        <a href="<?= get_permalink($overviewPost); ?>#more" class="more">
                            <img class="bmwi"
                                 src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="content">
                        <div class="title">
                            <a href="<?= get_permalink($overviewPost); ?>">
                              <?= get_the_title($overviewPost) ?>
                            </a>
                        </div>
                      <?= get_the_excerpt($overviewPost); ?>
                        <a href="<?= get_permalink($overviewPost); ?>#more" class="more">
                            <img class="bmwi"
                                 src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                        </a>
                    </div>
                    <a href="<?= get_permalink($overviewPost); ?>">
                        <div class="header"<?php if (has_post_thumbnail($overviewPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($overviewPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                            &nbsp;
                        </div>
                    </a>
                <?php endif; ?>

              </article>
          </div>
      </div>
    <?php $i++; endforeach; ?>
</div>

