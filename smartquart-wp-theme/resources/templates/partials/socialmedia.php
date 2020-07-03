<?php
$chart = get_sub_field('chart');
$facebook = get_sub_field('facebook');
$twitter = get_sub_field('twitter');

?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v7.0" nonce="VIHHk1XN"></script>

<div id="fb-root"></div>
<div class="container">
    <div class="socialmedia">
        <div class="facebook">
            <div class="headline">Facebook</div>
            <div class="fb-page" data-href="https://www.facebook.com/<?= $facebook ?>" data-tabs="timeline"
                 data-width="" data-height="" data-small-header="false" data-adapt-container-width="true"
                 data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/<?= $facebook ?>" class="fb-xfbml-parse-ignore"><a
                            href="https://www.facebook.com/<?= $facebook ?>">Facebook</a></blockquote>
            </div>
        </div>
        <div class="twitter">
            <div class="headline">Twitter</div>
            <a class="twitter-timeline" data-lang="de" data-height="500" href="https://twitter.com/<?= $twitter ?>?ref_src=twsrc%5Etfw">Tweets by <?= $twitter ?></a>
        </div>
    </div>
</div>
