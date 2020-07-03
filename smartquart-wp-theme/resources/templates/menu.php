<div class="menucontainer">
  <div class="burger" data-click="toggle-menu">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <div class="overlay" id="menuoverlay">
    <div class="header">
      <div class="logo">
        <img class="logo" src="<?= get_stylesheet_directory_uri() . "/public/img/footer_logo.png" ?>"/>
      </div>
      <div class="close" data-click="close" data-target="menuoverlay">&times;</div>
    </div>
    <?php
    $excludedPages = "";
    foreach(get_pages() as $page) {
      if($page->menu_order < 0) {
        $ids .= "{$page->ID},";
      }
    }
    wp_nav_menu( array( 'exclude' => $ids ) );
    ?>
  </div>
</div>
