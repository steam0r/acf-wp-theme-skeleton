<?php
$quotes = get_sub_field('quotes');
?>
<div class="nocontainer" style="background-color: #1cd67c">
    <div class="container">
        <div class="quotes">
          <?php foreach ($quotes as $quote): ?>
              <div class="quote">
                  <div class="image" style="background-image: url('<?= $quote["image"]["url"] ?>');">&nbsp;</div>
                  <div class="content">
                      <div class="text"><?= $quote["text"] ?></div>
                      <div class="author"><?= $quote["author"] ?></div>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</div>
