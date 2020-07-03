<?php
$headline = get_sub_field('headline');
?>
<div class="nocontainer" style="background-color: rgb(235, 245, 255);">
    <div class="pageheadline" style="background-image: url('<?= get_stylesheet_directory_uri() . "/public/img/blog_top.png" ?>');">
        <?= $headline ?>
    </div>
</div>
