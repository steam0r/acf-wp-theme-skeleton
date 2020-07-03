<?php
$url = get_sub_field('url');
$headline = get_sub_field('headline');
$subtext = get_sub_field('subtext');
?>
<div class="nocontainer" style="background-color: rgb(235, 245, 255); padding-top: 9%; padding-bottom: 5%;">
    <div class="youniverse container">
        <?php if($headline): ?><div class="headline"><?= $headline ?></div><?php endif; ?>
        <?php if($subtext): ?><div class="subtext"><?= $subtext ?></div><?php endif; ?>
        <iframe id="youniverse" src="<?= $url ?>"
                width="100%"
                seamless frameborder="0"
                allowtransparency="true"
                scrolling="no"
                allowfullscreen
                allow="camera;microphone;accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture"></iframe>
    </div>
</div>
<script type="text/javascript">
  function resizeIframe() {
    var iframe = document.getElementById('youniverse');
    var ratio = 2.4776;
    var width = iframe.offsetWidth;
    var height = width / ratio;
    iframe.height = height;
  }

  window.addEventListener('load', resizeIframe);
  window.addEventListener('resize', resizeIframe);

</script>
