<?php
$image = get_sub_field('image');
$text = get_sub_field('text');
$url = get_sub_field('url');
?>
<div class="nocontainer" style="background-color: rgb(235, 245, 255);">
    <div class="container">
        <div class="imagetext">
            <div class="text"><?= $text; ?></div>
            <?php if($url): ?>
                <a href="<?= $url ?>" class="image">
                    <img src="<?= $image['url']; ?>"/>
                </a>
            <?php else: ?>
                <div class="image"><img src="<?= $image['url']; ?>"/></div>
            <?php endif; ?>
        </div>
    </div>
</div>
