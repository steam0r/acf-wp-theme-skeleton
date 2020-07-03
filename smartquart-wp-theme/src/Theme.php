<?php

namespace SmartQuart;

use KKL\Ligatool\Shortcode\GameDayTable;
use Symfony\Component\Yaml\Yaml;

define('MY_ACF_PATH', get_stylesheet_directory() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/');
define('MY_ACF_URL', get_stylesheet_directory_uri() . '/vendor/advanced-custom-fields/advanced-custom-fields-pro/');

class Theme
{

  /**
   * contains information from config/config.yml
   *
   * @var array $config
   */
  private $config;

  /**
   * @var Theme $instance
   */
  private static $instance;

  public static function getInstance()
  {
    return self::$instance;
  }

  public function init()
  {
    self::$instance = $this;

    if (!class_exists('acf')) {
      // Plugin path to the included ACF Pro plugin
      include_once(MY_ACF_PATH . 'acf.php');
    }

    $this->config = Yaml::parse(file_get_contents(get_stylesheet_directory() . "/config/config.yml"), Yaml::PARSE_OBJECT_FOR_MAP);

    add_filter('acf/settings/load_json', array($this, 'my_acf_json_load_point'));
    add_filter('acf/settings/save_json', array($this, 'my_acf_json_save_point'));

    // Customize the url setting to fix incorrect asset URLs.
    add_filter('acf/settings/url', array($this, 'my_acf_settings_url'));

    // (Optional) Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', array($this, 'my_acf_settings_show_admin'));

    // add shortcodes
    add_shortcode('acf_wrapper', array(ACFWrapper::class, 'render'));

    // add support for images in blogposts
    add_theme_support('post-thumbnails', array('post'));

    $this->activate();

    if (is_admin()) {
      $this->initBackend();
    }

  }

  public function getConfig()
  {
    return $this->config->config;
  }

  private function activate()
  {
    $width = 350;
    $header_info = array(
      'width' => $width,
      'height' => $width * 0.31640625,
      'default-image' => get_template_directory_uri() . '/public/img/markenzeichen.png',
    );
    add_theme_support('custom-header', $header_info);

    $header_images = array(
      'markenzeichen' => array(
        'url' => get_template_directory_uri() . '/public/img/markenzeichen.png',
        'thumbnail_url' => get_template_directory_uri() . '/public/img/markenzeichen.png',
        'description' => 'SmartQuart',
      )
    );
    register_default_headers($header_images);

    $header_info = array(
      'width' => $width,
      'height' => $width * 0.31640625,
      'default-image' => get_template_directory_uri() . '/public/img/footer_partner_all.png',
    );
    add_theme_support('custom-footer', $header_info);


    add_filter('excerpt_more', function ($more) {
      return '';
    });

    add_action('after_setup_theme', array($this, 'addCategories'));

    add_action('wp_enqueue_scripts', array($this, 'load_dashicons_front_end'));


    $this->initForms();

  }

  public function load_dashicons_front_end()
  {
    wp_enqueue_style('dashicons');
  }

  public function addCategories()
  {
    wp_insert_term(
      'Pinned',
      'category',
      array(
        'description' => 'Blogposts in dieser Kategorie tauchen immer zu erst im Modul Blogposts auf',
        'slug' => 'pinned'
      )
    );
    wp_insert_term(
      'Pressemitteilung',
      'category',
      array(
        'description' => 'Blogposts in dieser Kategorie tauchen bei den Pressemitteilungen auf, aber nicht auf der Blogübersicht',
        'slug' => 'press'
      )
    );
  }

  private function initBackend()
  {
    $backend = new Backend();
    $backend->init();
  }

  private function initForms()
  {
    add_action('init', array($this, 'ideasform_init'));
    add_action('acf/init', array($this, 'my_acf_ideaform_init'));
    add_filter('post_updated_messages', array($this, 'idea_updated_messages'));

    add_action('init', array($this, 'contactform_init'));
    add_action('acf/init', array($this, 'my_acf_contactform_init'));
    add_filter('post_updated_messages', array($this, 'contact_updated_messages'));

    add_action('acf/save_post', array($this, 'form_send_email'));

    add_role("idea_contact",
      "Kontakt: Ideen",
      array(
        "read" => true,  // true allows this capability
        "edit_posts" => true,
      )
    );

    add_role("contact_contact",
      "Kontakt: Kontaktformular",
      array(
        "read" => true,  // true allows this capability
        "edit_posts" => true,
      )
    );

  }

  function form_send_email($post_id)
  {

    $types = array('contact', 'idea');
    $post_type = get_post_type($post_id);
    if (!in_array($post_type, $types) && get_post_status($post_id) == 'draft') {
      return;
    }

    // $post_title = get_the_title($post_id);
    // $post_url = get_permalink($post_id);

    if ($post_type === 'idea') {
      $subject = "SmartQuart: Eine neue Idee!";
      $message = "Hallo:\n\n";
      $message .= "es wurde eine neue Idee über das Ideenformular eingereicht:\n\n";
      $message .= get_field('name', $post_id) . "\n";
      $message .= get_field('email', $post_id) . "\n\n";
      $message .= get_field('idee', $post_id) . "\n\n\n";
      $message .= "Mit freundlichen Grüßen,\n";
      $message .= "das SmartQuart-Team";

      $contacts = get_users(array(
        'role' => 'idea_contact'
      ));

    } else {
      $subject = "SmartQuart: Eine neue Kontaktanfrage!";
      $message = "Hallo:\n\n";
      $message .= "es wurde eine neue Kontaktanfrage über die Website erstellt:\n\n";
      $message .= get_field('name', $post_id) . "\n";
      $message .= get_field('email', $post_id) . "\n\n";
      $message .= get_field('anfrage', $post_id) . "\n\n\n";
      $message .= "Mit freundlichen Grüßen,\n";
      $message .= "das SmartQuart-Team";

      $contacts = get_users(array(
        'role' => 'contact_contact'
      ));

    }

    foreach ($contacts as $contact) {
      wp_mail($contact->data->user_email, $subject, $message);
    }

  }

  function my_acf_ideaform_init()
  {

    // Check function exists.
    if (function_exists('acf_register_form')) {

      acf_register_form(array(
        'id' => 'new-idea',
        'post_id' => 'new_post',
        'new_post' => array(
          'post_type' => 'idea',
          'post_status' => 'draft'
        ),
        'post_title' => false,
        'post_content' => false,
        'uploader' => 'basic',
        'submit_value' => 'Absenden',
        'return' => '?updated=true#ideaform',
        'updated_message' => "Vielen Dank für Ihre Nachricht. Wir melden uns schnellstmöglich bei Ihnen.",
      ));
    }

    add_action('acf/validate_save_post', array($this, 'my_acf_validate_save_post'));
  }

  function my_acf_validate_save_post()
  {

    if ($_POST['_acf_form'] == 'new-idea') {
      if ($_POST['acf']['field_5ef36cef7ce8c'] != 1) {
        acf_add_validation_error('acf[field_5ef36cef7ce8c]', 'Dieses Feld ist ein Pflichtfeld');
      }
    }

    if ($_POST['_acf_form'] == 'new-contact') {
      if ($_POST['acf']['field_5ef370431db6c'] != 1) {
        acf_add_validation_error('acf[field_5ef370431db6c]', 'Dieses Feld ist ein Pflichtfeld');
      }
    }

  }

  function my_acf_contactform_init()
  {

    // Check function exists.
    if (function_exists('acf_register_form')) {

      acf_register_form(array(
        'id' => 'new-contact',
        'post_id' => 'new_post',
        'new_post' => array(
          'post_type' => 'contact',
          'post_status' => 'draft'
        ),
        'post_title' => false,
        'post_content' => false,
        'uploader' => 'basic',
        'submit_value' => 'Absenden',
        'return' => '?updated=true#contactform',
        'updated_message' => "Vielen Dank für Ihre Nachricht. Wir melden uns schnellstmöglich bei Ihnen.",
      ));
    }
  }


  public function pre_save_post($post_id)
  {
    if ($_POST['_acf_post_id'] != 'new_post') {
      return $post_id;
    }
    if ($_POST['_acf_form'] != 'new-idea') {
      return $post_id;
    }
    $post = array(
      'post_type' => 'idea',
      'post_title' => $_POST['acf']['field_5ee0b8a115249']
    );
    $post_id = wp_insert_post($post);
    $_POST['return'] = add_query_arg(array('post_id' => $post_id), $_POST['return']);
    return $post_id;
  }

  /**
   * Registers the `idea` post type.
   */
  function ideasform_init()
  {
    register_post_type('idea', array(
      'labels' => array(
        'name' => "Ideen",
        'singular_name' => "Idee",
        'all_items' => "Alle Ideen",
        'archives' => "Ideen Archiv",
        'attributes' => "Ideen Attribute",
        'insert_into_item' => "Idee hinzufügen",
        'uploaded_to_this_item' => "Upload",
        'featured_image' => "Bild",
        'set_featured_image' => "Bild setzen",
        'remove_featured_image' => "Bild entfernen",
        'use_featured_image' => "Als Bild benutzen",
        'filter_items_list' => "Ideen filtern",
        'items_list_navigation' => "Ideen navigation",
        'items_list' => "Ideen",
        'new_item' => "Neue Idee",
        'add_new' => "Hinzufügen",
        'add_new_item' => "Neue Idee hinzugügen",
        'edit_item' => "Idee bearbeiten",
        'view_item' => "Idee ansehen",
        'view_items' => "Ideen ansehen",
        'search_items' => "Suche",
        'not_found' => "Keine Ergebnisse",
        'not_found_in_trash' => "Keine Ideen im Papierkorb",
        'parent_item_colon' => "Übergeordnete Idee",
        'menu_name' => "Ideen",
      ),
      'public' => true,
      'hierarchical' => false,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'supports' => array('title', 'editor'),
      'has_archive' => true,
      'rewrite' => true,
      'query_var' => true,
      'menu_position' => null,
      'menu_icon' => 'dashicons-lightbulb',
      'show_in_rest' => true,
      'rest_base' => 'idea',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));
  }

  /**
   * Registers the `contact` post type.
   */
  function contactform_init()
  {
    register_post_type('contact', array(
      'labels' => array(
        'name' => "Kontaktanfragen",
        'singular_name' => "Kontaktanfrage",
        'all_items' => "Alle Kontaktanfragen",
        'archives' => "Kontaktanfragen Archiv",
        'attributes' => "Kontaktanfragen Attribute",
        'insert_into_item' => "Kontaktanfrage hinzufügen",
        'uploaded_to_this_item' => "Upload",
        'featured_image' => "Bild",
        'set_featured_image' => "Bild setzen",
        'remove_featured_image' => "Bild entfernen",
        'use_featured_image' => "Als Bild benutzen",
        'filter_items_list' => "Kontaktanfragen filtern",
        'items_list_navigation' => "Kontaktanfragen navigation",
        'items_list' => "Kontaktanfragen",
        'new_item' => "Neue Kontaktanfrage",
        'add_new' => "Hinzufügen",
        'add_new_item' => "Neue Kontaktanfrage hinzugügen",
        'edit_item' => "Kontaktanfrage bearbeiten",
        'view_item' => "Kontaktanfrage ansehen",
        'view_items' => "Kontaktanfrage ansehen",
        'search_items' => "Suche",
        'not_found' => "Keine Ergebnisse",
        'not_found_in_trash' => "Keine Kontaktanfragen im Papierkorb",
        'parent_item_colon' => "Übergeordnete Kontaktanfrage",
        'menu_name' => "Kontaktanfragen",
      ),
      'public' => true,
      'hierarchical' => false,
      'show_ui' => true,
      'show_in_nav_menus' => true,
      'supports' => array('title', 'editor'),
      'has_archive' => true,
      'rewrite' => true,
      'query_var' => true,
      'menu_position' => null,
      'menu_icon' => 'dashicons-format-chat',
      'show_in_rest' => true,
      'rest_base' => 'contact',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
    ));


  }

  /**
   * Sets the post updated messages for the `idea` post type.
   *
   * @param array $messages Post updated messages.
   * @return array Messages for the `idea` post type.
   */
  function idea_updated_messages($messages)
  {
    global $post;

    $permalink = get_permalink($post);

    $messages['idea'] = array(
      0 => '', // Unused. Messages start at index 1.
      /* translators: %s: post permalink */
      1 => sprintf('Idee bearbeitet. <a target=\"_blank\" href=\"%s\">Idee ansehen</a>', esc_url($permalink)),
      2 => "Feld aktualisiert",
      3 => "Feld gelöscht",
      4 => "Idee bearbeitet",
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf('Idee zurückgesetzt auf Version %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
      /* translators: %s: post permalink */
      6 => sprintf('Neue Idee. <a href="%s">Idee ansehen</a>', esc_url($permalink)),
      7 => "Idee gespeichert",
      /* translators: %s: post permalink */
      8 => sprintf('Neue Idee. <a href="%s">Idee ansehen</a>', esc_url(add_query_arg('preview', 'true', $permalink))),
      /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
      9 => sprintf('Idee geplant für: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Idee ansehen</a>',
        date_i18n(__('M j, Y @ G:i', 'YOUR-TEXTDOMAIN'), strtotime($post->post_date)), esc_url($permalink)),
      /* translators: %s: post permalink */
      10 => sprintf('Ideenentwurf aktualisiert. <a target="_blank" href="%s">Idee ansehen</a>', esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
  }

  /**
   * Sets the post updated messages for the `contact` post type.
   *
   * @param array $messages Post updated messages.
   * @return array Messages for the `contact` post type.
   */
  function contact_updated_messages($messages)
  {
    global $post;

    $permalink = get_permalink($post);

    $messages['contact'] = array(
      0 => '', // Unused. Messages start at index 1.
      /* translators: %s: post permalink */
      1 => sprintf('Kontaktanfrage bearbeitet. <a target=\"_blank\" href=\"%s\">Kontaktanfrage ansehen</a>', esc_url($permalink)),
      2 => "Feld aktualisiert",
      3 => "Feld gelöscht",
      4 => "Kontaktanfrage bearbeitet",
      /* translators: %s: date and time of the revision */
      5 => isset($_GET['revision']) ? sprintf('Kontaktanfrage zurückgesetzt auf Version %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
      /* translators: %s: post permalink */
      6 => sprintf('Neue Kontaktanfrage. <a href="%s">Kontaktanfrage ansehen</a>', esc_url($permalink)),
      7 => "Idee gespeichert",
      /* translators: %s: post permalink */
      8 => sprintf('Neue Kontaktanfrage. <a href="%s">Kontaktanfrage ansehen</a>', esc_url(add_query_arg('preview', 'true', $permalink))),
      /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
      9 => sprintf('Kontaktanfrage geplant für: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Kontaktanfrage ansehen</a>',
        date_i18n(__('M j, Y @ G:i', 'YOUR-TEXTDOMAIN'), strtotime($post->post_date)), esc_url($permalink)),
      /* translators: %s: post permalink */
      10 => sprintf('Kontaktanfragenentwurf aktualisiert. <a target="_blank" href="%s">Kontaktanfrage ansehen</a>', esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
  }

  public function my_acf_json_load_point($paths)
  {
    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/config/fieldgroups';

    // return
    return $paths;
  }

  public function my_acf_json_save_point($path)
  {

    // update path
    $path = get_stylesheet_directory() . '/config/fieldgroups';


    // return
    return $path;

  }

  public function my_acf_settings_url($url)
  {
    return MY_ACF_URL;
  }

  public function my_acf_settings_show_admin($show_admin)
  {
    // return (strpos(home_url($wp->request), "localhost") !== false);
    return true;
  }

}
