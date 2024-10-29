<?php
/* Help TABS  */
/* Dashboard */
// Priority 5 allows the removal of default tabs and insertion of other plugin's tabs
add_filter( 'contextual_help', 'ayo_pins_help', 5, 3 );
function ayo_pins_help( $old_help, $screen_id, $screen )
{
// Adjust for your correct screen_id, see plugin recommendation bellow
    if( 'dashboard' != $screen_id )
        return;
// For new ones: duplicate this, change id's and create custom callbacks
    $screen->add_help_tab( array(
        'id'      => 'pins-help',
        'title'   => 'Pins',
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'ayo_pins_print_help'
    ));
// This sets the sidebar, which is common for all tabs of this screen
    get_current_screen()->set_help_sidebar(
        '<p><strong>' . __('For more information:') . '</strong></p>' .
        '<p>' . __('<a href="http://wordpress.stackexchange.com/" title="" target="_blank">Learn More About Wordpress</a>') . '</p>' .
        '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'.
        '<p>' . __('<a href="https://www.adminyo.com" target="_blank">Learn all about Adminyo Features</a>') . '</p>'
      //  '<p>' . __('<a href="https://support.adminyo.com" target="_blank">Check Adminyo WIKI</a>') . '</p>'
      //  '<p>' . __('<a href="/wp-admin/admin.php?page=adminyo%2Flib%2Fayo_admin.php" target="_blank">Adminyo Settings Page</a>')  '</p>'.
    );
    return $old_help;
}
function ayo_pins_print_help()
{
    echo '<p><b>Dashboard Pin Zone</b></p>
    <p>Pin to Dashboard is the tool that allows you to create a shortcut to a current Custom Post Type (e.g. Posts, Pages, Products etc.) directly on the Welcome area of the Dashboard. This means that you can start working immediately after login! No time wasted! The set of pins is specific to each user!</p>
    <br>
    <p><b>Your Pin’s on the Admin Bar - <b>ONLY ON PRO</b></b></b></p>
    <p>We add to the top Admin Bar, Your Pins area. Now you can access your favorite Pins from any were, even from the Front End. <b>ONLY ON PRO</b></b></p>
    <br>
    <p><b>Order your Pins with Drag and Drop - <b>ONLY ON PRO</b></b></p>
    <p>You can reorder your Pins with Drag and Drop. What’s more simple than dragging a pin and dropping it where you feel it makes sense? <b>ONLY ON PRO</b></p>
    <br>
    <p><b>Sort your Pins on the Dashboard by type, color, views, date, or search them by title</b></p>
    <p>When you have pinned multiple post types on your Dashboard, and the list gets big, you can now use the new Sort Pins option. You can use the preset filters or you can search by title.</p>
    <br>
    <p><b>You can color coded your Pins - <b>ONLY ON PRO</b></b></b></p>
    <p>For a fast identification of your Pins, you can use the material design colors to find them faster or to mark your development progress of a post or a page. <b>ONLY ON PRO</b></b></p>
    <br>
    <p><b>Pins Info</b></p>
    <p>There’s an info button on pin cards which displays overview information, like comment number, author, views, etc. Each card displays specific information for the custom post type. For example, a product pin card will display information such as stock quantity, sales number, status, rating and the number of comments or views.</p>
    <br>
    <p><b>Pin from Quick Search</b></p>
    <p>Another way you can Pin or UnPin a Custom Post Type is directly from the Quick Search bar.</p>
    <br>
    <p><b>Remove Welcome Links</b></p>
    <p>Clean the Default Welcome Panel Links if you are not using them and enjoy a clean Pin Zone.</p>
    <br>
          <p><b>More Actions</b></p>
          <p><b><a href="'.admin_url().'admin.php?page=AdminyoWP%2Flib%2Fayo_admin.php">Adminyo Settings Page</a> - <a href="http://adminyo.com/pin-to-dashboard/">Full Documentation on Pins</a> - <a href="http://codecanyon.net/item/adminyo-intelligent-wordpress-admin/14784440/comments">Having Issues?</a> - <a href="http://support.adminyo.com">Adminyo Wiki Page</a></b></p>
    ';
}//end of notice

/* Edit post */
add_filter( 'contextual_help', 'ayo_editpins_help', 5, 3 );
function ayo_editpins_help( $old_help, $screen_id, $screen )
{
// Adjust for your correct screen_id, see plugin recommendation bellow
    $post_type= get_post_type();
    if( 'edit-post' != $screen_id )
        return;
// For new ones: duplicate this, change id's and create custom callbacks
    $screen->add_help_tab( array(
        'id'      => 'pins-help',
        'title'   => 'Pins',
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'ayo_editpins_print_help'
    ));
// This sets the sidebar, which is common for all tabs of this screen
    get_current_screen()->set_help_sidebar(
        '<p><strong>' . __('For more information:') . '</strong></p>' .
        '<p>' . __('<a href="http://wordpress.stackexchange.com/" title="" target="_blank">Learn More About Pins</a>') . '</p>' .
        '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
      //  '<p>' . __('<a href="https://support.adminyo.com" target="_blank">Check Adminyo WIKI</a>') . '</p>'
    );
    return $old_help;
}
function ayo_editpins_print_help()
{
    echo '<p><b>Dashboard Pin Zone</b></p>
    <p>Pin to Dashboard is the tool that allows you to create a shortcut to a current Custom Post Type (e.g. Posts, Pages, Products etc.) directly on the Welcome area of the Dashboard. This means that you can start working immediately after login! No time wasted! The set of pins is specific to each user!</p>
    <br>
    <p><b>Pins Columns</b></p>
    <p>In every Custom Post Types (e.g. Posts, Pages, Products, etc.) listings page, you will find at the right side a new column named Pins. This is the first way you can Pin or UnPin any of the Custom Post Types you’ve pinned.</p>
    <br>
    <p><b>Your Pin’s on the Admin Bar</b></p>
    <p>We add to the top Admin Bar, Your Pins area. Now you can access your favorite Pins from any were, even from the Front End.</p>
    <br>
    <p><b>Pin from Quick Search</b></p>
    <p>Another way you can Pin or UnPin a Custom Post Type is directly from the Quick Search bar.</p>
    <br>
          <p><b>More Actions</b></p>
          <p><b><a href="'.admin_url().'admin.php?page=adminyo%2Flib%2Fayo_admin.php">Adminyo Settings Page</a> - <a href="http://adminyo.com/pin-to-dashboard/">Full Documentation on Pins</a> - <a href="http://codecanyon.net/item/adminyo-intelligent-wordpress-admin/14784440/comments">Having Issues?</a> - <a href="http://support.adminyo.com">Adminyo Wiki Page</a></b></p>
    ';
}//end of notice

/* Edit page */
add_filter( 'contextual_help', 'ayo_editpagepins_help', 5, 3 );
function ayo_editpagepins_help( $old_help, $screen_id, $screen )
{
// Adjust for your correct screen_id, see plugin recommendation bellow
    $post_type= get_post_type();
    if( 'edit-page' != $screen_id )
        return;
// For new ones: duplicate this, change id's and create custom callbacks
    $screen->add_help_tab( array(
        'id'      => 'pagepins-help',
        'title'   => 'Pins',
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'ayo_editpins_print_help'
    ));
// This sets the sidebar, which is common for all tabs of this screen
    get_current_screen()->set_help_sidebar(
        '<p><strong>' . __('For more information:') . '</strong></p>' .
        '<p>' . __('<a href="http://wordpress.stackexchange.com/" title="" target="_blank">Learn More About Pins</a>') . '</p>' .
        '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
    );
    return $old_help;
}
function ayo_editpagepins_print_help()
{
    echo '<p><b>Dashboard Pin Zone</b></p>
    <p>Pin to Dashboard is the tool that allows you to create a shortcut to a current Custom Post Type (e.g. Posts, Pages, Products etc.) directly on the Welcome area of the Dashboard. This means that you can start working immediately after login! No time wasted! The set of pins is specific to each user!</p>
    <br>
    <p><b>Pins Columns</b></p>
    <p>In every Custom Post Types (e.g. Posts, Pages, Products, etc.) listings page, you will find at the right side a new column named Pins. This is the first way you can Pin or UnPin any of the Custom Post Types you’ve pinned.</p>
    <br>
    <p><b>Your Pin’s on the Admin Bar</b></p>
    <p>We add to the top Admin Bar, Your Pins area. Now you can access your favorite Pins from any were, even from the Front End.</p>
    <br>
    <p><b>Pin from Quick Search</b></p>
    <p>Another way you can Pin or UnPin a Custom Post Type is directly from the Quick Search bar.</p>
    <br>
          <p><b>More Actions</b></p>
          <p><b><a href="'.admin_url().'admin.php?page=adminyo%2Flib%2Fayo_admin.php">Adminyo Settings Page</a> - <a href="http://adminyo.com/pin-to-dashboard/">Full Documentation on Pins</a> - <a href="http://codecanyon.net/item/adminyo-intelligent-wordpress-admin/14784440/comments">Having Issues?</a> - <a href="http://support.adminyo.com">Adminyo Wiki Page</a></b></p>
    ';
}//end of notice

/* Action Button */
// Priority 5 allows the removal of default tabs and insertion of other plugin's tabs
add_filter( 'contextual_help', 'ayo_actionbtn_help', 5, 3 );
function ayo_actionbtn_help( $old_help, $screen_id, $screen )
{
// Not our screen, exit earlier
// Adjust for your correct screen_id, see plugin recommendation bellow
    $post_type= get_post_type();
        if( $post_type != $screen_id )
        return;
// Remove default tabs
//    $screen->remove_help_tabs();
// Add one help tab
// For new ones: duplicate this, change id's and create custom callbacks
    $screen->add_help_tab( array(
        'id'      => 'pins-help',
        'title'   => 'Action Button',
        'content' => '', // left empty on purpose, we use the callback bellow
        'callback' => 'ayo_actionbtn_print_help'
    ));
// This sets the sidebar, which is common for all tabs of this screen
    get_current_screen()->set_help_sidebar(
        '<p><strong>' . __('For more information:') . '</strong></p>' .
        '<p>' . __('<a href="http://wordpress.stackexchange.com/" title="" target="_blank">Learn More About Pins</a>') . '</p>' .
        '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>'
      //  '<p>' . __('<a href="https://support.adminyo.com" target="_blank">Check Adminyo WIKI</a>') . '</p>'
    );
  return $old_help;
}
function ayo_actionbtn_print_help()
{
    echo '<p><b>Important actions at your finger tip, wherever you are in the post</b></p>
          <p>The floating action button is located on the lower right side of the screen and it includes all the actions you need: Page Update, Page Preview, Pin to Dashboard, Back to Top, Scroll to Bottom, Save as Draft and Duplicate Post, Pages … .</p>
          <p><b>More Actions</b></p>
          <p><b><a href="'.admin_url().'admin.php?page=adminyo%2Flib%2Fayo_admin.php">Adminyo Settings Page</a> - <a href="http://adminyo.com/floating-action-button/">Full Documentation on Action Button</a> - <a href="http://codecanyon.net/item/adminyo-intelligent-wordpress-admin/14784440/comments">Having Issues?</a> - <a href="http://support.adminyo.com">Adminyo Wiki Page</a></b></p>
    ';
}
