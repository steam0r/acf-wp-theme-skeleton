<?php
$pressCat = get_category_by_slug('press');
$args = array(
  'post_type' => 'post',
  "cat" => $pressCat->cat_ID
);
$pressPosts = get_posts($args);

?>

<div class="pressarchive">
    <?php $i = 0; foreach ($pressPosts as $pressPost): $even = ($i % 2 == 0); ?>
        <div class="nocontainer<?= $even ? ' even' : ' odd'; ?>">
            <div class="container">
                <article id="post-<?php $pressPost->ID; ?>">
                  <?php if ($even): ?>
                      <a href="<?= get_permalink($pressPost); ?>">
                          <div class="header"<?php if (has_post_thumbnail($pressPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pressPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                              &nbsp;
                          </div>
                      </a>
                      <div class="content">
                          <div class="title">
                            <?= get_the_title($pressPost) ?>
                          </div>
                        <?= get_the_excerpt($pressPost); ?>
                          <a href="<?= get_permalink($pressPost); ?>#more" class="more">
                              <img class="bmwi"
                                   src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                          </a>
                      </div>
                  <?php else: ?>
                      <div class="content">
                          <div class="title">
                            <?= the_title() ?>
                          </div>
                        <?= get_the_excerpt(); ?>
                          <a href="<?= get_permalink($pressPost); ?>#more" class="more">
                              <img class="bmwi"
                                   src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                          </a>
                      </div>
                      <a href="<?= get_permalink($pressPost); ?>">
                          <div class="header"<?php if (has_post_thumbnail($pressPost)): ?> style="background-image: url('<?= wp_get_attachment_image_src(get_post_thumbnail_id($pressPost->ID), 'single-post-thumbnail')[0]; ?>');"<?php endif; ?>>
                              &nbsp;
                          </div>
                      </a>
                  <?php endif; ?>

                </article>
            </div>
        </div>
      <?php $i++; endforeach; ?>
</div>

