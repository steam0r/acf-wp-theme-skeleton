<?php
$image = get_sub_field('image');
$url = get_sub_field('url');
$headline = get_sub_field('headline');
$subtext = get_sub_field('subtext');
?>
<div class="nocontainer" style="background-color: rgb(235, 245, 255);">
    <div class="container">
        <div class="picture">
          <?php if($headline): ?><div class="headline"><?= $headline ?></div><?php endif; ?>
          <?php if($subtext): ?><div class="subtext"><?= $subtext ?></div><?php endif; ?>
          <?php if ($url): ?>
              <a href="<?= $url; ?>">
                  <img src="<?= $image['url']; ?>"/>
              </a>
          <?php else: ?>
              <img src="<?= $image['url']; ?>"/>
          <?php endif; ?>
        </div>
    </div>
</div>
