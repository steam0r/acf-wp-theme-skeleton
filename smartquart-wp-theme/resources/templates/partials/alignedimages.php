<?php
$headline = get_sub_field('headline');
$textBlock1 = get_sub_field('text_block_one');
$textBlock2 = get_sub_field('text_block_two');

$imgHeadlineRight = get_sub_field('image_headline_right');
$imgHeadlineTop = get_sub_field('image_headline_top');

$imgDividerLeft = get_sub_field('image_divider_left');
$imgDividerRight = get_sub_field('image_divider_right');

?>
<div class="container">
    <div class="alignedimages">
        <div class="header">
            <div class="left">
                <div class="image">
                    <img src="<?= $imgHeadlineTop["url"] ?>"/>
                </div>
                <div class="headline">
                  <?= $headline ?>
                </div>
            </div>
            <div class="right">
                <div class="image">
                    <img src="<?= $imgHeadlineRight["url"] ?>"/>
                </div>
            </div>
        </div>
        <div class="textblock left">
          <?= $textBlock1 ?>
        </div>
        <div class="divider">
            <div class="left">
                <div class="image">
                    <img src="<?= $imgDividerLeft["url"] ?>"/>
                </div>
            </div>
            <div class="right">
                <div class="image">
                    <img src="<?= $imgDividerRight["url"] ?>"/>
                </div>
            </div>
        </div>
        <div class="textblock right">
          <?= $textBlock2 ?>
        </div>
    </div>
</div>
