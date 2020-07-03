<?php
require __DIR__ . '/vendor/autoload.php';

use SmartQuart\Theme;

$theme = new Theme();
$theme->init();

$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  'https://github.com/undev-studio/smartquart-wp-theme/',
  __FILE__,
  'smartquart-wp-theme'
);

$myUpdateChecker->getVcsApi()->enableReleaseAssets();
$myUpdateChecker->setAuthentication($theme->getConfig()->update->token);
