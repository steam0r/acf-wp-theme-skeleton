<?php
$headline = get_sub_field('headline');
$subtext = get_sub_field('subtext');
$checkpoints = get_sub_field('checkpoints');
$cta = get_sub_field('cta');

?>
<div class="container">
    <div class="checklist">
        <div class="headline">
          <?= $headline ?>
        </div>
        <div class="subtext">
          <?= $subtext ?>
        </div>
        <div class="checkpoints">
          <?php for ($count = 0; $count < count($checkpoints); $count++): $point = $checkpoints[$count]; ?>
              <div class="checkpoint">
                <?php if ($point["url"]): ?>
                    <a href="<?= $point["url"] ?>" target="_blank">
                        <div class="icon" style="background-image: url('<?= $point["image"]["url"] ?>');">&nbsp;</div>
                    </a>
                <?php else: ?>
                    <div class="icon" style="background-image: url('<?= $point["image"]["url"] ?>');">&nbsp;</div>
                <?php endif; ?>
                  <div class="headline">
                    <?= $point["headline"] ?>
                  </div>
                  <div class="subtext">
                    <?= $point["subtext"] ?>
                  </div>
              </div>
          <?php endfor; ?>
        </div>
      <?php if ($cta["text"]): ?>
          <a href="<?= $cta["url"] ?>">
              <div class="cta">
                <?= $cta["text"] ?>
                  <span class="arrow"><img
                              src="<?= get_stylesheet_directory_uri() . "/public/img/arrow1.png" ?>"></span>
              </div>
          </a>
      <?php endif; ?>
    </div>
</div>
