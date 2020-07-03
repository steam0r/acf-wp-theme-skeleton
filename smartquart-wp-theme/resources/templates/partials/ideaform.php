<?php
$image = get_sub_field('image');
?>
<div class="container">
    <div class="ideaform">
        <div class="form">
          <?php acf_form('new-idea'); ?>
        </div>
        <div class="logo" <?php if($image): ?>style="background-image: url('<?= $image["url"]; ?>');"<?php endif; ?>>&nbsp;</div>
    </div>
</div>
