<?php
/* A sidebar in the footer? Yep. You can can customize
 * your footer with four columns of widgets.
 */
// get_sidebar( 'footer' );
?>
<!-- FOOTER  -->
<footer>
    <div class="container">
        <div class="up">
            <a href="#top">
                <img src="<?= get_stylesheet_directory_uri() . "/public/img/back_to_top.png" ?>"/>
            </a>
        </div>
        <div class="imprint">
            <div class="links">
                <a href="/impressum">Impressum</a><br/>
                <a href="/datenschutz">Datenschutz</a><br/>
                <a href="/disclaimer">Disclaimer</a><br/>
            </div>
            <div class="address">
                <b>SmartQuart</b><br/>
                E.ON SE<br/>
                Brüsseler Platz 1<br/>
                45131 Essen<br/>
            </div>
            <div class="contact">
                <a href="tel:+4920112-15251">+49 201 12-15251</a><br/>
                <a href="/kontakt">kontakt@smartquart.energy</a><br/>
                <a href="<?= get_site_url() ?>">www.smartquart.energy</a>
            </div>
        </div>
        <div class="info">
            <div class="text">
                SmartQuart ist Teil des Programms „Reallabore der Energiewende“ des
                Bundesministeriums für Wirtschaft und Energie.
            </div>
            <div class="partners" style="background-image: url('<?= get_stylesheet_directory_uri() . "/public/img/footer_partner_all.png" ?>');">&nbsp;</div>
        </div>
        <div class="logos">
            <img class="logo" src="<?= get_stylesheet_directory_uri() . "/public/img/footer_logo.svg" ?>"/><br/>
            <img class="bmwi" src="<?= get_stylesheet_directory_uri() . "/public/img/footer_bmwi.svg" ?>"/>
        </div>
    </div>
</footer>

<!-- .JS includes -->
<script type="text/javascript">
  var bloginfo = {
    url: '<?php bloginfo('url'); ?>',
    template_url: '<?php bloginfo('template_url'); ?>'
  };
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/public/js/libraries.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/public/js/helper.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/public/js/app.min.js"></script>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
</body>
</html>
