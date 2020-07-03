<?php
$map1 = get_sub_field('map1');
$map2 = get_sub_field('map2');
$map3 = get_sub_field('map3');
?>
<div class="container">
    <div class="maps">
        <a href="<?= $map1["url"] ?>" class="map" style="background-image: url('<?= $map1["image"] ?>')">&nbsp;</a>
        <a href="<?= $map2["url"] ?>" class="map" style="background-image: url('<?= $map2["image"] ?>')">&nbsp;</a>
        <a href="<?= $map3["url"] ?>" class="map" style="background-image: url('<?= $map3["image"] ?>')">&nbsp;</a>
    </div>
</div>
