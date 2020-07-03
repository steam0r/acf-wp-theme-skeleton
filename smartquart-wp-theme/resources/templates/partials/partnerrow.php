<?php
$image = get_sub_field('image');
$text = get_sub_field('text');
$moretext = get_sub_field('more_text');
$backgroundColor = get_sub_field('background');
$position = get_sub_field('position_logo');
$headline = get_sub_field('headline');
$url = get_sub_field('url');
$rand = rand();
?>
<div class="nocontainer" style="background-color: <?= $backgroundColor ?>;">
    <div class="container">
        <div class="partnerrow <?= $position ?>">
          <?php if ($position == "left"): ?>
            <?php if ($url): ?>
                  <a href="<?= $url ?>" target="_blank">
                      <div class="image"><img src="<?= $image['url']; ?>"/></div>
                  </a>
            <?php else: ?>
                  <div class="image"><img src="<?= $image['url']; ?>"/></div>
            <?php endif; ?>
              <div class="content">
                  <div class="headline"><?= $headline; ?></div>
                  <div class="text">
                        <?= $text; ?>
                    <?php if($moretext): ?>
                        <img class="more" data-click="toggle" data-target="moretext-<?= $rand ?>" src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                    <?php endif; ?>
                  </div>
                <?php if($moretext): ?>
                    <div class="text moretext" id="moretext-<?= $rand ?>" style="display: none;"><?= $moretext; ?></div>
                <?php endif; ?>
              </div>
          <? else: ?>
              <div class="content">
                  <div class="headline"><?= $headline; ?></div>
                  <div class="text">
                    <?= $text; ?>
                    <?php if($moretext): ?>
                      <img class="more" data-click="toggle" data-target="moretext-<?= $rand ?>" src="<?= get_stylesheet_directory_uri() . "/public/img/link_more.png" ?>"/>
                    <?php endif; ?>
                  </div>
                  <?php if($moretext): ?>
                  <div class="text moretext" id="moretext-<?= $rand ?>" style="display: none;"><?= $moretext; ?></div>
                  <?php endif; ?>
              </div>
            <?php if ($url): ?>
                  <a href="<?= $url ?>" target="_blank">
                      <div class="image"><img src="<?= $image['url']; ?>"/></div>
                  </a>
            <?php else: ?>
                  <div class="image"><img src="<?= $image['url']; ?>"/></div>
            <?php endif; ?>
          <? endif; ?>
        </div>
    </div>
</div>
