<?php
$slides = get_sub_field('slides');

$speed = get_sub_field('slider_speed');
if ($speed || empty($speed)) {
  $speed = 500;
}
$autoplay = get_sub_field('slider_autoplay');
if (!$autoplay || empty($autoplay)) {
  $autoplay = "false";
} else {
  $autoplay = "true";
}
$timeout = get_sub_field('slider_timeout');
if ($timeout || empty($timeout)) {
  $timeout = 4000;
}

?>

<div class="nocontainer">
    <div class="slideshow">
        <ul class="rslides">
          <?php for ($count = 0; $count < count($slides); $count++): $slide = $slides[$count]; ?>
              <li class="slide">
                <?php if ($slide["video"]): ?>
                  <?php if ($slide["image"]): ?>
                        <div id="videothumb-<?= $count ?>"
                             class="image"<?php if ($slide["image"]["url"]): ?> style="background-image: url('<?php print $slide["image"]["url"]; ?>');"<? endif; ?>>
                            &nbsp;
                        </div>
                  <?php endif; ?>
                    <video id="video-<?= $count ?>"<?php if ($slide["image"]): ?> style="display: none;"<?php endif; ?>>
                        <source src="<?= $slide["video"]["url"] ?>">
                        Your browser does not support the video tag.
                    </video>
                    <div class="play">
                        <div class="button"
                             style="background-image: url('<?= get_stylesheet_directory_uri() . "/public/img/play.png" ?>');"
                             data-click="play" data-target="video-<?= $count ?>">&nbsp;
                        </div>
                        <div id="fullscreen-<?= $count ?>" class="togglefullscreen dashicons dashicons-external">
                            &nbsp;
                        </div>
                    </div>
                <?php else: ?>
                    <div class="image"<?php if ($slide["image"]["url"]): ?> style="background-image: url('<?php print $slide["image"]["url"]; ?>');"<? endif; ?>>
                        &nbsp;
                    </div>
                <?php endif; ?>
                  <div id="text-<?= $count ?>" class="text <?= print $slide["color"]; ?>">
                      <div class="headline"><span class="highlight"><?= $slide["title"]; ?></span></div>
                    <?php if ($slide["subheadline"]): ?>
                        <div class="subtext"><span class="highlight"><?= $slide["subheadline"]; ?></span></div>
                    <?php endif; ?>
                    <?php if ($slide["more"] && !empty($slide["more"]["text"])): ?>
                        <a href="<?php print $slide["more"]["url"]; ?>" class="more link">
                            <div class="cta">
                              <?php print $slide["more"]["text"]; ?>
                            </div>
                            <div class="arrow"><img
                                        src="<?= get_stylesheet_directory_uri() . "/public/img/arrow1.png" ?>"></div>
                        </a>
                    <?php endif; ?>
                  </div>
              </li>
          <?php endfor; ?>
        </ul>
        <ul id="sliderpager" class="pager" style="display: none;">
          <?php for ($count = 0; $count < count($slides); $count++): $slide = $slides[$count]; ?>
              <li><a href="#">&#x2B24;</a></li>
          <?php endfor; ?>
        </ul>
    </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('video').bind('ended', function() {
      jQuery('.slideshow .play .button').css('display', 'block');
    });
    slideshow = jQuery('.togglefullscreen').each(function(event) {
      var icon = jQuery(this);
      icon.on('click', function(event) {
        event.stopPropagation();
        var id = icon.attr('id').split('-', 2)[1];
        var video = document.getElementById('video-' + id);
        if (video) {
          if (video.requestFullscreen) {
            video.requestFullscreen();
          } else if (video.mozRequestFullScreen) { /* Firefox */
            video.mozRequestFullScreen();
          } else if (video.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            video.webkitRequestFullscreen();
          } else if (video.msRequestFullscreen) { /* IE/Edge */
            video.msRequestFullscreen();
          }
          setTimeout(function() {
            if (document.addEventListener) {
              document.addEventListener('fullscreenchange', exitHandler, false);
              document.addEventListener('mozfullscreenchange', exitHandler, false);
              document.addEventListener('MSFullscreenChange', exitHandler, false);
              document.addEventListener('webkitfullscreenchange', exitHandler, false);
            }
          }, 500);
          function exitHandler() {
            if (document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement !== null || document.mozFullScreenElement || document.webkitFullscreenElement) {
              video.pause();
              jQuery('.slideshow .play .button').css('display', 'block');
              jQuery('.slideshow .togglefullscreen').css('display', 'none');
              video.pause();
              jQuery('.rslides').trigger('mouseleave');
              clearInterval(stopAutoplay);
              jQuery('.slideshow').unbind('click');
              document.removeEventListener('fullscreenchange', exitHandler);
              document.removeEventListener('mozfullscreenchange', exitHandler);
              document.removeEventListener('MSFullscreenChange', exitHandler);
              document.removeEventListener('webkitfullscreenchange', exitHandler);
            }
          }
        }
      });
    });
    jQuery('.rslides').responsiveSlides({
      auto: <?= $autoplay ?>,             // Boolean: Animate automatically, true or false
      speed: <?= $speed ?>,             // Integer: Speed of the transition, in milliseconds
      timeout: <?= $timeout ?>,          // Integer: Time between slide transitions, in milliseconds
      pager: true,           // Boolean: Show pager, true or false
      nav: true,             // Boolean: Show navigation, true or false
      random: false,          // Boolean: Randomize the order of the slides, true or false
      pause: true,           // Boolean: Pause on hover, true or false
      pauseControls: true,    // Boolean: Pause when hovering controls, true or false
      prevText: '&lt;',   // String: Text for the "previous" button
      nextText: '&gt;',       // String: Text for the "next" button
      maxwidth: '',           // Integer: Max-width of the slideshow, in pixels
      navContainer: '',       // Selector: Where controls should be appended to, default is after the 'ul'
      manualControls: '.slideshow .pager',     // Selector: Declare custom pager navigation
      namespace: 'rslides',   // String: Change the default namespace used
      before: function() {
      },   // Function: Before callback
      after: function() {
      }     // Function: After callback
    });
    setTimeout(function() {
      document.getElementById('sliderpager').style.display = 'flex';
    }, 200);
  });
</script>
