<?php/* Start Header Search */ function ayo_frontheader() {   if(is_admin()) {   global $ayo_options; // init variabile?><div id="header_boxes">  <div class="box1">    <p class="p_search">        <input type="mydsearch" class="si-input"  ng-focus="currentPage = 0" name="s" ng-model="search.$"  placeholder= "Let me know what you're looking for... ","<?php _e( '', 'ayo' ); ?>" style="color: white !important;" id="ayo_tags" autofocus/>    </p>      <div id="box_hide"></div>      <div class = "results_holder">        <div class="afisare" style="display:none;" >          <div id="nada_found" style="display:none;">Nothing found..only dust!</div><!--enable posts--><?php if ($ayo_options['enable_posts'] == true) {?>	       <div class="posts_list"><ul id="ayo_results_posts" class="get_result"></ul></div><?php }; ?><!--enable pages--><?php if ($ayo_options['enable_pages'] == true) {?>        <div class="pages_list"><ul id="ayo_results_pages"  class="get_result"></ul></div><?php }; ?><!--enable products--><?php if (class_exists('Woocommerce')) {?><?php if ($ayo_options['enable_produs'] == true) {?>        <div class="products_list">  <ul id="ayo_results_products"  class="get_result"></ul></div><?php }}; ?>      </div>    </div>  </div></div><?php }};/* Start main footer */add_action('admin_bar_menu', 'ayo_frontheader');function ayo_frontfooter() {/* De bagat in footer */}add_action('admin_footer', 'ayo_frontfooter');//--------end/* Load JS--Instand Finder*/function ayo_enqueue_scripts( $hook ) {//  if( current_user_can('edit_posts') ) {  global $ayo_options;	global $wpdb;	$user_ID = get_current_user_id();	//if ( current_user_can( 'edit_others_pages' ) ) {		$query = 'SELECT ID AS value, post_title AS label, post_type AS type FROM ' . $wpdb->posts;//	} elseif ( current_user_can( 'edit_pages' ) ) {		$query = 'SELECT ID AS value, post_title AS label, post_type AS type FROM ' . $wpdb->posts .		        ' WHERE post_author = ' . $user_ID;	//}	wp_enqueue_script( 'ayo', AdminYo_dirURL . '../js/ayo_search.js',		array( 'jquery', 'jquery-ui-core', 'jquery-ui-autocomplete' ) );	$posts = $wpdb->get_results( $query, ARRAY_A );  $newpost = array();  foreach ($posts as $post) {  $meta = ayo_isPinned($post["value"]);    $post["pinned"] = $meta;    $newpost[] = $post;  }	if( $newpost ) {		wp_localize_script( 'ayo', 'ayo_data', $newpost );	} else {		wp_localize_script( 'ayo', 'ayo_data', null );	}	wp_localize_script( 'ayo', 'ayo_consts', array(			'admin_url'         => admin_url(),			'home_url'          => home_url( '/' ),      'plugins_url'       =>   plugins_url('', __FILE__),		'str_nothing_found' => __( "Nothing found", 'ayo' )  ) );}add_action( 'admin_enqueue_scripts', 'ayo_enqueue_scripts' );//END of file