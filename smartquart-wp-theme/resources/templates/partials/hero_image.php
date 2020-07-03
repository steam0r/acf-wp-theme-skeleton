<?php
$fullWidth = get_sub_field('fullwidth');
$headline = get_sub_field('headline');
$subtext = get_sub_field('subtext');
$image = get_sub_field('image');
$color = get_sub_field('color')
?>
<div class="nocontainer">
    <div class="hero"<?php if ($image["url"]): ?> style="background-image: url('<?= $image["url"]; ?>');"<? endif; ?>>
        <div class="container <?= print $color; ?>">
            <div class="headline">
                <span class="highlight"><?= nl2br($headline) ?></span>
            </div>
            <div class="subtext">
                <span class="highlight"><?= nl2br($subtext) ?></span>
            </div>
        </div>
    </div>
</div>
