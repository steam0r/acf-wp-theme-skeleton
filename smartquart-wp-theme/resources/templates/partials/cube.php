<?php
$cube = get_sub_field('cube');
$headline = get_sub_field('headline');
$subtext = get_sub_field('subtext');

if ($cube["active"]): ?>
    <div class="container">
        <div class="cube">
          <?php if($headline): ?><div class="headline"><?= $headline ?></div><?php endif; ?>
          <?php if($subtext): ?><div class="subtext"><?= $subtext ?></div><?php endif; ?>
            <div class="hover">
                <a href="/interactiv">
                    was bietet smartquart
                </a>
            </div>
            <a href="/elektrisch">das elektrische quartier</a>
            <a href="/urban">das urbane quartier</a>
            <a href="/wasserstoff">das wassertoff-quartier</a>
        </div>
    </div>
<?php endif; ?>
