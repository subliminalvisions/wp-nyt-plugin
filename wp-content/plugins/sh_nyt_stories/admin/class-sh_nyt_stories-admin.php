<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://subliminalvisions.com/
 * @since      1.0.0
 *
 * @package    Sh_nyt_stories
 * @subpackage Sh_nyt_stories/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sh_nyt_stories
 * @subpackage Sh_nyt_stories/admin
 * @author     Stephen Harris <subliminalvisions@gmail.com>
 */
class Sh_nyt_stories_Admin
{
  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * The options name to be used in this plugin
   *
   * @since  	1.0.0
   * @access 	private
   * @var  	string 		$option_name 	Option name of this plugin
   */
  private $option_name = "Sh_nyt_stories";

  // public function get_hidden_key()
  // {
  //   include_once "partials/sh_api_key_hidden.php";
  //   $apkey = $Sh_nyt_stories_key->hidden_key;
  //   global $apkey;
  // }
  /**
   * Add an options page under the Settings submenu
   *
   * @since  1.0.0
   */
  public function add_options_page()
  {
    $this->plugin_screen_hook_suffix = add_options_page(
      __("NYT Stories Settings", "nyt-stories"),
      __("NYT Stories", "nyt-stories"),
      "manage_options",
      $this->plugin_name,
      [$this, "display_options_page"]
    );
  }

  public function register_setting()
  {
    // Add a General section
    add_settings_section(
      $this->option_name . "_general",
      __("General", "outdated-notice"),
      [$this, $this->option_name . "_general_cb"],
      $this->plugin_name
    );
  }

  /**
   * Render the options page for plugin
   *
   * @since  1.0.0
   */
  public function display_options_page()
  {
    include_once "partials/sh_nyt_stories-admin-display.php"; ?>
    <div class="wrap">
        <h2>NYT Stories Settings Page</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields("smashing_fields");
            do_settings_sections("smashing_fields");
            submit_button();?>
        </form>
    </div> <?php
  }

  /**
   * sections for admin
   * @since    1.0.0
   */
  public function setup_sections()
  {
    add_settings_section(
      "shnyt_apikey_field",
      "API Key",
      [$this, "section_callback"],
      "smashing_fields"
    );
    // add_settings_section(
    //   "our_second_section",
    //   "Second Section Title",
    //   [$this, "section_callback"],
    //   "smashing_fields"
    // );
    // add_settings_section(
    //   "our_third_section",
    //   "Third Section Title",
    //   [$this, "section_callback"],
    //   "smashing_fields"
    // );
  }

  public function section_callback($arguments)
  {
    echo "ideally you'd save in this field but whatever <br>";
  }
  public function setup_fields()
  {
    add_settings_field(
      "shnyt_apikey_field",
      "ApiKey Field ",
      [$this, "field_callback"],
      "smashing_fields",
      "shnyt_apikey_field"
    );
  }
  public function field_callback($arguments)
  {
    echo '<input name="shnyt_apikey_field" id="shnyt_apikey_field" type="text" value="' .
      get_option("shnyt_apikey_field") .
      '" />';
  }

  // api call
  public function get_nyt_stories()
  {
    error_reporting(-1);
    include_once "partials/sh_api_key_hidden.php";
    // get an api key at https://developer.nytimes.com/ , and put in file like so:
    // global $hidden_api_key;
    // $hidden_api_key = "YourApiKeyValueHere";

    global $api_key;
    $api_key = $hidden_api_key;

    // if (isset($hidden_api_key)):
    //   echo "<br>api key: " . $hidden_api_key . "<br>";
    // else:
    //   echo "<br>api key: " . '$hidden_api_key is empty';
    // endif;
    // $url = "https://api.nytimes.com/svc/topstories/v2/business.json?";
    // echo $nyt_url;
    // echo "<br/>";
    // $arguments = [
    //   "api-key" => $hidden_api_key
    // ];
    // $url_parameters = [];
    // foreach ($arguments as $key => $value) {
    //   $url_parameters[] = $key . "=" . $value;
    // }
    // $url = $url . implode("&", $url_parameters);
    $url =
      "https://api.nytimes.com/svc/topstories/v2/business.json?api-key=" .
      $api_key;
    $response = file_get_contents($url);
    if ($response) {
      // print_r($response);
      // response is defo there but printing it is ugly
    }
  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles()
  {
    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Sh_nyt_stories_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Sh_nyt_stories_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_style(
      $this->plugin_name,
      plugin_dir_url(__FILE__) . "css/sh_nyt_stories-admin.css",
      [],
      $this->version,
      "all"
    );
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts()
  {
    /**
     * This function is provided for demonstration purposes only.
     *
     * An instance of this class should be passed to the run() function
     * defined in Sh_nyt_stories_Loader as all of the hooks are defined
     * in that particular class.
     *
     * The Sh_nyt_stories_Loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    wp_enqueue_script(
      $this->plugin_name,
      plugin_dir_url(__FILE__) . "js/sh_nyt_stories-admin.js",
      ["jquery"],
      $this->version,
      false
    );
  }

  /**
   * Creates a new custom post type
   *
   * @since 	1.0.0
   * @access 	public
   * @uses 	register_post_type()
   */
  public static function new_cpt_stories()
  {
    $cap_type = "post";
    $plural = "NYT_Stories";
    $single = "NYT_Story";
    $cpt_name = "NYT_Story";

    $opts["can_export"] = true;
    $opts["capability_type"] = $cap_type;
    $opts["description"] = "";
    $opts["exclude_from_search"] = false;
    $opts["has_archive"] = false;
    $opts["hierarchical"] = false;
    $opts["map_meta_cap"] = true;
    $opts["menu_icon"] = "dashicons-businessman";
    $opts["menu_position"] = 25;
    $opts["public"] = true;
    $opts["publicly_querable"] = true;
    $opts["query_var"] = true;
    $opts["register_meta_box_cb"] = "";
    $opts["rewrite"] = false;
    $opts["show_in_admin_bar"] = true;
    $opts["show_in_menu"] = true;
    $opts["show_in_nav_menu"] = true;
    $opts["show_ui"] = true;
    $opts["supports"] = ["title", "editor", "thumbnail"];
    $opts["taxonomies"] = [];

    $opts["capabilities"]["delete_others_posts"] = "delete_others_{$cap_type}s";
    $opts["capabilities"]["delete_post"] = "delete_{$cap_type}";
    $opts["capabilities"]["delete_posts"] = "delete_{$cap_type}s";
    $opts["capabilities"][
      "delete_private_posts"
    ] = "delete_private_{$cap_type}s";
    $opts["capabilities"][
      "delete_published_posts"
    ] = "delete_published_{$cap_type}s";
    $opts["capabilities"]["edit_others_posts"] = "edit_others_{$cap_type}s";
    $opts["capabilities"]["edit_post"] = "edit_{$cap_type}";
    $opts["capabilities"]["edit_posts"] = "edit_{$cap_type}s";
    $opts["capabilities"]["edit_private_posts"] = "edit_private_{$cap_type}s";
    $opts["capabilities"][
      "edit_published_posts"
    ] = "edit_published_{$cap_type}s";
    $opts["capabilities"]["publish_posts"] = "publish_{$cap_type}s";
    $opts["capabilities"]["read_post"] = "read_{$cap_type}";
    $opts["capabilities"]["read_private_posts"] = "read_private_{$cap_type}s";

    $opts["labels"]["add_new"] = esc_html__(
      "Add New {$single}",
      "sh_nyt_stories"
    );
    $opts["labels"]["add_new_item"] = esc_html__(
      "Add New {$single}",
      "sh_nyt_stories"
    );
    $opts["labels"]["all_items"] = esc_html__($plural, "sh_nyt_stories");
    $opts["labels"]["edit_item"] = esc_html__(
      "Edit {$single}",
      "sh_nyt_stories"
    );
    $opts["labels"]["menu_name"] = esc_html__($plural, "sh_nyt_stories");
    $opts["labels"]["name"] = esc_html__($plural, "sh_nyt_stories");
    $opts["labels"]["name_admin_bar"] = esc_html__($single, "sh_nyt_stories");
    $opts["labels"]["new_item"] = esc_html__("New {$single}", "sh_nyt_stories");
    $opts["labels"]["not_found"] = esc_html__(
      "No {$plural} Found",
      "sh_nyt_stories"
    );
    $opts["labels"]["not_found_in_trash"] = esc_html__(
      "No {$plural} Found in Trash",
      "sh_nyt_stories"
    );
    $opts["labels"]["parent_item_colon"] = esc_html__(
      "Parent {$plural} :",
      "sh_nyt_stories"
    );
    $opts["labels"]["search_items"] = esc_html__(
      "Search {$plural}",
      "sh_nyt_stories"
    );
    $opts["labels"]["singular_name"] = esc_html__($single, "sh_nyt_stories");
    $opts["labels"]["view_item"] = esc_html__(
      "View {$single}",
      "sh_nyt_stories"
    );

    $opts["rewrite"]["ep_mask"] = EP_PERMALINK;
    $opts["rewrite"]["feeds"] = false;
    $opts["rewrite"]["pages"] = true;
    $opts["rewrite"]["slug"] = esc_html__(
      strtolower($plural),
      "sh_nyt_stories"
    );
    $opts["rewrite"]["with_front"] = false;

    $opts = apply_filters("sh_nyt_stories-cpt-options", $opts);

    register_post_type(strtolower($cpt_name), $opts);
  } // new_cpt_job()
}
