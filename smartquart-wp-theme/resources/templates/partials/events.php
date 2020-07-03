<?php
$events = get_sub_field('events');
$headline = get_sub_field('headline');

// stupid hack because locale is not installed
$months = [
  "Jan" => "Jan",
  "Feb" => "Feb",
  "Mar" => "Mar",
  "Apr" => "Apr",
  "May" => "Mai",
  "Jun" => "Jun",
  "Jul" => "Jul",
  "Aug" => "Aug",
  "Sep" => "Sep",
  "Oct" => "Okt",
  "Nov" => "Nov",
  "Dec" => "Dec"
];
?>
<div class="eventsheadline container">
    <div class="headline"><?= $headline ?></div>
</div>
<div class="nocontainer" style="background-color: rgb(235, 245, 255);">
    <div class="container">
        <div class="events">
          <?php for ($count = 0; $count < count($events); $count++): $event = $events[$count]; ?>
          <?php $month = $months[strftime("%h", strtotime($event["date"]))]; ?>
              <div class="event">
                  <div class="date">
                      <div class="day"><?= strftime("%d.<br/>" . $month, strtotime($event["date"])) ?></div>
                      <div class="year"><?= strftime("%Y", strtotime($event["date"])) ?></div>
                  </div>
                  <div class="info">
                      <div class="time"><?= strftime("%H:%M", strtotime($event["date"])) ?></div>
                      <div class="headline"><?= $event["headline"] ?></div>
                      <div class="text"><?= $event["text"] ?></div>
                  </div>
                  <div class="location">
                      <div class="marker"
                           style="background-image: url('<?= get_stylesheet_directory_uri() . "/public/img/mitmachen_local.png" ?>');">
                          &nbsp;
                      </div>
                    <?= nl2br($event["room"]) ?>
                  </div>
              </div>
          <?php endfor; ?>
        </div>
    </div>
</div>
