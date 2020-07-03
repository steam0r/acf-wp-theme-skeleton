<?php
$items = get_sub_field('items');
$unfoldFirst = get_sub_field('unfold_first');
?>
<div class="container">
    <div class="textaccordion">
      <?php for ($count = 0; $count < count($items); $count++): $item = $items[$count]; ?>
          <div class="item">
              <div class="headline" data-click="toggle">
                <?= $item["headline"] ?>
                  <span class="arrow">></span>
              </div>
              <div class="text"<?php if($count == 0 && $unfoldFirst): ?> style="display: block;"<?php endif; ?>>
                <?= $item["text"] ?>
              </div>
          </div>
      <?php endfor; ?>
    </div>
</div>
