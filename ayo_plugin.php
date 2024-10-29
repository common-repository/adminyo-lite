<?php
/* Plugin Name: Adminyo - Intelligent WP Admin
 * Description: WORK FASTER AND SMARTER with WordPres Admin - Intelligent tools to make your WordPress ride smoother!
 * Version: 1.3 LITE
 * Author: VagabondLabs.com
 * Author URI:  http://adminyo.com
 *License: GPL2
 *License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
define('AdminYo__MINIMUM_WP_VERSION','4.0');
define('AdminYo__PINS_SLUG','admin-bookmarks');
define('AdminYo__VERSION','1.3');
define('AdminYo_MASTER_USER',true);
define('AdminYo__API_VERSION','1');
define('AdminYo__PLUGIN_DIR',plugin_dir_path(__FILE__));
define('AdminYo__PLUGIN_FILE',__FILE__);
define('AdminYo_URL',plugins_url('',__FILE__));
define('AdminYo_DIR',dirname(__FILE__));
define('AdminYo_dirURL',plugin_dir_url(__FILE__));

/*Including files*/
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_search.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_actionbtn.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_pins.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_help.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_activationmsg.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_admin.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_keys.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_savepos.php');
include_once(AdminYo__PLUGIN_DIR.'lib/ayo_changes.php');


/* Set Plugin Defaults */
$ayo_version="1.3 LITE";
$ayo_list = get_option('ayo_list');
$ayo_options = get_option('ayo_settings', array(
  'dash_pin' => true,
  'pins_filter' => true,
  'ignore_this' => true,
  'enable_posts' => true,
  'enable_pages' => true,
  'enable_produs' => true,
  'menu_post_plus' => true));

/* Enqueue scripts */
add_action('wp_head','ayo_page_viewed'); // attach ayo_page_viewed to the wp_he
add_action( 'activated_plugin', 'ayo_activation_redirect' ); // redirect to activation page
add_action( 'load-index.php', 'show_welcome_panel' );
add_action( 'admin_enqueue_scripts', 'load_ayo_files' );
add_action( 'admin_enqueue_scripts', 'load_ayo_scripts' );
add_action( 'admin_enqueue_scripts', 'load_ayo_visual' );
add_action( 'admin_enqueue_scripts', 'load_ayo_hotkeys' );
//add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
//add_action( 'admin_enqueue_scripts', 'load_ayo_demopop' );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

add_action( 'admin_enqueue_scripts', 'load_ayo_search_normal' );


/* Setting search normal */
 function load_ayo_search_normal(){
   wp_register_style( 'ayo_normalsearch', AdminYo_dirURL . 'css/ayo_normal_search.css' );
   wp_enqueue_style('ayo_normalsearch');
 };
/*HotKey Maker*/
 function load_ayo_hotkeys(){
/*init scroll bar */
  wp_register_script( 'ayo_hotkeys', AdminYo_dirURL . 'js/menu-hotkeys.js' );
  wp_enqueue_script(  'ayo_hotkeys', AdminYo_dirURL . 'js/menu-hotkeys.js', array( 'jquery' ) );
  wp_register_style( 'ayo_hotkeys', AdminYo_dirURL . 'css/ayo_keybind.css' );
  wp_enqueue_style('ayo_hotkeys');
};
 function load_ayo_files() {
/* Init the globals for the options */
  global $ayo_options;
  global $pagenow;
/*Action Button*/
if ($ayo_options['menu_post_plus'] == true || $ayo_options['hold_clickfab'] == true )
    {
      wp_register_script( 'ayo_actionjs', AdminYo_dirURL . '/js/ayo_actionbtn.js' );
      wp_enqueue_script(  'ayo_actionjs', AdminYo_dirURL . '/js/ayo_actionbtn.js', array( 'jquery' ) );
    };
/*Pin sort JS*/
      wp_register_script( 'ayo_pinsort', AdminYo_dirURL . 'js/ayo_pinsort.js' );
      wp_enqueue_script(  'ayo_pinsort', AdminYo_dirURL . 'js/ayo_pinsort.js', array( 'jquery' ) );

      wp_register_script( 'ayo_pinsinit', AdminYo_dirURL . 'js/ayo_pin.js' );
      wp_enqueue_script(  'ayo_pinsinit', AdminYo_dirURL . 'js/ayo_pin.js', array( 'jquery' ) );

      wp_register_script( 'ayo_pinpin', AdminYo_dirURL . 'js/ayo_pinpin.js' );
      wp_enqueue_script(  'ayo_pinpin', AdminYo_dirURL . 'js/ayo_pinpin.js', array( 'jquery' ) );
      wp_register_script( 'ayo_search', AdminYo_dirURL . 'js/ayo_search.js' );
      wp_enqueue_script(  'ayo_search', AdminYo_dirURL . 'js/ayo_search.js', array( 'jquery' ) );
/*init scroll bar */
      wp_register_script( 'ayo_scroll', AdminYo_dirURL . 'js/ayo_scroll.js' );
      wp_enqueue_script(  'ayo_scroll', AdminYo_dirURL . 'js/ayo_scroll.js', array( 'jquery' ) );
/* Setting hide menu */
}
 function load_ayo_scripts()
     {
      global $ayo_options;
/* Setting auto-collapse */
if ($ayo_options['menu_collapse'] == true)
    {
      if ($pagenow == 'customize.php') {} else{
        wp_register_script( 'ayo_autocollapse', AdminYo_dirURL . 'js/ayo_autocollapse.js' );
        wp_enqueue_script(  'ayo_autocollapse', AdminYo_dirURL . 'js/ayo-autocollapse.js', array( 'jquery' ) );
       }
   };
/* Hide Menu completly */
if ($ayo_options['hide_menu'] == true ) {
     if ($ayo_options['menu_collapse'] == false) {
       if ($pagenow == 'customize.php') {} else{
       wp_register_script( 'ayo_autocollapse',AdminYo_dirURL . 'js/ayo_autocollapse.js' );
       wp_enqueue_script(  'ayo_autocollapse', AdminYo_dirURL . 'js/ayo_autocollapse.js', array( 'jquery' ) );
    }//end collapse
  };
/* load hide css */
      wp_register_style( 'ayo_hidemenu_style', AdminYo_dirURL . 'css/ayo_hide.css' );
      wp_enqueue_style('ayo_hidemenu_style');
 };
/* Setting visuals style */
      wp_register_style( 'ayo_visual_style', AdminYo_dirURL . 'css/ayo_visual.css' );
      wp_enqueue_style('ayo_visual_style');
/* Setting visuals style */
      wp_register_style( 'ayo_style', AdminYo_dirURL . 'css/ayo_style.css' );
      wp_enqueue_style('ayo_style');
/* Setting admin style */
      wp_register_style( 'ayo_admin_style', AdminYo_dirURL . 'css/ayo_admin_style.css' );
      wp_enqueue_style('ayo_admin_style');
/* Setting pins style */
      wp_register_style( 'ayo_pins_style', AdminYo_dirURL . 'css/ayo_pins_style.css' );
      wp_enqueue_style('ayo_pins_style');
/* LOAD JS components */
      wp_register_script( 'ayo_modernizr', AdminYo_dirURL . 'js/modernizr.custom.39460.js' );
	    wp_enqueue_script(  'ayo_modernizr', AdminYo_dirURL . 'js/modernizr.custom.39460.js', array( 'jquery' ) );
    };
/* Setting plus style */
function load_ayo_visual()
    {
      wp_register_style( 'ayo_plus_style', AdminYo_dirURL . 'css/ayo_plus.css' );
      wp_enqueue_style('ayo_plus_style');
    };

/* Register Scripts &amp; Styles in Admin panel*/
 function mw_enqueue_color_picker( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('/js/ayo_colorpick.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
/*Add settings tab*/
 function add_action_links ( $links ) {
  $mylinks = array(
    '<a href="' . admin_url( '/admin.php?page=AdminyoWP/lib/ayo_admin.php' ) . '">Settings</a>',
    );
  return array_merge( $links, $mylinks );
};
/* Force Welcome Panel to be ON */
 function show_welcome_panel()
    {
      $user_id = get_current_user_id();
      if ( 1 != get_user_meta( $user_id, 'show_welcome_panel', true ) )
          update_user_meta( $user_id, 'show_welcome_panel', 1 );
    };

/* Redirect to what's new page after ayo_activation*/
function ayo_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=adminyo-lite/lib/ayo_changes.php' ) ) );
    }
}
//END of file
