<?php
/* Setup shortkeys*/
function ayo_controls_setup($hook_suffix) {
  global $ayo_options;
  if ($ayo_options['hotkey_home'] == true) {
    wp_enqueue_script(  'hotkeys', AdminYo_dirURL . '/js/ayo_keybind_controls.js', array( 'jquery' ) );
    wp_enqueue_script(  'boot_hotkeys', AdminYo_dirURL . '/js/ayo_hotkey_bootstrap.js' );
    }
  };
  
add_action( 'admin_enqueue_scripts', 'ayo_controls_setup' );

//END of file