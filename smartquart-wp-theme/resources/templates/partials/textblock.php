<?php
$text = get_sub_field('text');
$headline = get_sub_field('headline');
?>
<div class="container">
    <div class="textblock">
        <?php if($headline): ?>
        <div class="headline">
          <?= $headline; ?>
        </div>
        <?php endif; ?>
        <div class="text">
          <?= $text ?>
        </div>
    </div>
</div>
