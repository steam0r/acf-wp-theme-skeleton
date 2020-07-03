<?php
$image = get_sub_field('image');
$position_top = get_sub_field('position_top');
if(!$position_top) {
    $position_top = 250;
}
$url = get_sub_field('url');
?>
<div class="disruptor container" style="margin-top: -<?= $position_top ?>px;">
    <a class="link" href="<?= $url ?>" style="background-image: url('<?= $image["url"]; ?>');"></a>
</div>
