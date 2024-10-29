<?php
/*Start of dashboard pin board */
remove_action('welcome_panel','wp_welcome_panel');
function ayo_pinsdash_welcome() {
global $ayo_options;
?>
<div class="custom-welcome-panel-content">
<?php
if ($ayo_options['welcome_panel'] == false) {?>
	<h2><?php _e( 'Welcome to WordPress!' );?></h2>
	<p class="about-description"><?php _e( 'We’ve assembled some links to get you started:' );?></p>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h3><?php _e( "Get Started" );?></h3>
		<a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php the_permalink() ?>"><?php _e( 'Customize Your Site' );?></a>
			<p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">change your theme completely</a>' ), admin_url( 'options-general.php' ) );?></p>
	</div>
	<div class="welcome-panel-column">
		<h4><?php _e( 'Next Steps' ); ?></h4>
		<ul>
		<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) );?></li>
		<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) );?></li>
		<?php else : ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) );?></li>
		<?php endif; ?>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) );?></li>
		</ul>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h4><?php _e( 'More Actions' ); ?></h4>
		<ul>
			<li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) );?></li>
			<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) );?></li>
		</ul>
	</div>
	<!--si mai multe-->
<?php };?>
</div>
<!-- end columns dash-->
<!---->
<div class="pinboard_content">
	
<?php global $ayo_options;
?>
	<h2><?php _e( "Your Pins" );?></h2>
	<div  class="line-pin-to-dashboard"></div><br>
<!--Start of the body-->
<body>
	<!-- start of popup-->
<script>
jQuery(document).ready(function($){

$('.pro_only').click(function(){//card_colorchange
	 $('#overlay, #popup').css('display', 'block');
});
$('.pro_onlycolor').click(function(){//card_colorchange
	 $('#overlay, #popup').css('display', 'block');
});
$('.close_pro').click(function(){
$('#overlay, #popup').fadeOut("slow");
});
$('#overlay').click(function(){
	 $('#overlay, #popup').fadeOut("slow");
 //  console.log('close overlay');
});
})
</script>
<div class="pro_all">
<div id="overlay" ></div>
<div id="popup">
 <a href="https://codecanyon.net/item/adminyo-intelligent-wordpress-admin/14784440?ref=vagabondLabs" target="_blank">
	 <img src="<?php echo AdminYo_dirURL . '/img/getpro.jpg';?>" alt="" style="width:100%; border:0;">
 </a>

<!-- end of popup-->
</div> <!-- END - div class="top-bg" -->
</div>
	<div id="pins_container">
<!-- PINS SORT SECTION -->
<div class="item-filter">
	<div class="sort-pin-title">
		<b>Sort pins:</b>
	</div><br>
	<div id="sort-pin-1" class="sort-pin-1">
		<form>
        <select id="item-filter-select">
            <option value="all" id="all">Show All</option>
				</select>
    </form>
	</div>
	  <a href="javascript:pinsort_colors()" class="pinsort_colors" title="Sort pins by color"> <span class="dashicons dashicons-art"></span>Sort by color </a>
		<a href="javascript:pinsort_views()" class="pinsort_views" title="Sort pins by views"> <span class="dashicons dashicons-chart-bar"></span>Sort by views </a>
			<a href="javascript:pinsort_date()" class="pinsort_date" title="Sort pins by date"><span class="dashicons dashicons-calendar"></span> Sort by date </a>
		<div class="sort-pin-2">
			<input placeholder="Or start typing the title here ..." id="box" type="text" />
		</div>
<br /><br />

</div>
<!-- Start of the sortable list..containing all the pinned posts -->
		<ul id="sortable">
<?php
$postin = get_user_meta( get_current_user_id(),'pins')[0];
//Get pins and display in welcome panel Array [ "100", "1", "102", "29", "166", "106", "120", "82" ]
		$post_types = get_post_types();
		$pins_get_order = get_user_meta( $user_id,'pins_order')[0];
		$args = array(
			'post_type'      => $post_types,
			'post_status'    => 'pin_featured',
			//	'orderby'        => 'date',
			//	'order'          => 'DESC',
			'post__in' =>  $postin,
			'posts_per_page' => 30
      );

		$my_query = new WP_Query( $args );
		if ( $my_query->have_posts() && count($postin) > 0) {
			while ( $my_query->have_posts() ) {
		$my_query->the_post();

//Pin card display
//Card header
		echo "<li id='".get_the_ID()."' class='ui-state-default' data-id='".get_the_ID()."'  data-type='".get_post_type()."' data-color='".get_post_meta(get_the_ID(),'card_color', true)."'> </a>";
//Card content
		echo "<div class='all-topbtns'><div class='btn_pin_status'>".get_post_type()."<div class='butoane'><div class='pro_onlycolor'><input  type='hidden' class='pro_onlycolor'></div><input type='hidden'  name='ayo-pin-it' class='button-primary' value='".get_the_ID()."'><button style='background:transparent;border:none;outline:none;' class='card_unpin'><input type='hidden' name='ayo-pin-it' class='button-primary' value='".get_the_ID()."'></button></div></div></div>";//	echo "<div class='btn_pin_title'>". ayo_the_titlesmall('', '', true, '20') . '<br /></div>';
	//<input id='color_code' class='color-picker' name='color_code' type='text' value=''/>         <a href='#' id='show'><img src='/wp-content/plugins/AdminyoWP/img/colorchange_icon.png'/></a>
  	$data = ayo_changePin($_GET["post_id"]);
?>
<!-- pin title-->
	<div class="pin_card" id="<?php get_the_ID() ?>">
	<div class='btn_pin_title'><?php ayo_the_titlesmall('', '', true, '50')?><br /></div>
<!-- pin infos -->
	<div class="pin_infos" id="div_info" style="display:none;position:absolute;">
<!--pin author-->
<?php
// if is NOT a product
	if( get_post_type() !== 'product' ) {
		$position=5; // Define how many character you want to display.
		$message=get_the_author();
		$author = substr($message, 0, $position);
	?>
	<div class="pin_author"><b><?php 	echo $author;if( strlen( $author) > 2){	echo "..."; }?></b><br>AUTHOR</div>
<?php
	}	else {
// pin stock
	$product = new WC_Product( get_the_ID() );
	$stock = $product->get_stock_quantity();
	if ($stock !='') {
	echo "<div class='pin_author'><b>".$stock."</b><br>STOCK</div>";}else {echo "<div class='pin_author'><b>N/A</b><br>STOCK</div>";}
	 				};
?>
<!--comments -->
	<div class="pin_comm"><b><?php comments_number( '0', '1', '% ' )?></b><br>COMM</div>
<!--status -->
<?php
// don't display it on portfolio CPT
	if( get_post_type() !== 'portfolio' && get_post_type() !=='gallery' && get_post_type() !=='attachment') {
?>
<!-- get the pin status-->
	<div class="pin_status">
<?php
//publish
	if ( get_post_status ( $ID ) == 'publish' ) { echo '<b>Publish</b>'; }
//draft
	if ( get_post_status ( $ID ) == 'draft' ) { echo '<b>Draft</b>';	 }
//future
 	if ( get_post_status ( $ID ) == 'future' ) { echo '<b>Future</b>'; }
//trash
	if ( get_post_status ( $ID ) == 'trash' ) {  echo '<b>Trash</b>';  }
//pending
  if ( get_post_status ( $ID ) == 'pending' ) { echo '<b>Pending</b>'; }
?>
	<br>STATUS</div><br>
<?php }
//Display the views
	if( get_post_type() == 'post' || get_post_type() == 'page' || get_post_type() == 'product'  ) {
		  echo "<div class='pin_views'><b><label class='pro_only' style='color:#ff7c7c;font-size:14px;'>PRO</label></b><br>VIEWS</div>";
}
// show the ID
if( get_post_type() !== 'product' ) {
?>
	<div class="pin_date">
<?php
	 echo "<b>".get_the_ID()."</b><br>ID</div>";
?>
<div class="pin_modified" data-date="<?php echo get_the_modified_date();?>">
<?php
 echo "<b>".get_the_modified_date()."</b><br></div>";
};
//gallery pic PREVIEW
	if( get_post_type() == 'portfolio' || get_post_type() =='gallery' && get_post_type() =='attachment') {
		$feat_image =  get_the_post_thumbnail( $post_id, array( 35, 35));
		echo "<div class='pin_thumbnail'><img style='border-radius: 25px;'>" .  $feat_image . "<br></div>";
	}
// show product salesss
if( get_post_type() == 'product' ) {
//do some stuff
		$product = new WC_Product( get_the_ID() );
		$price = $product->price;
		$sales = get_post_meta( $product->id, 'total_sales', true ); //$product->total_sale;
		//$rating = $product ->get_average_rating();
		$revs = $product->is_featured();//get_average_rating(); needs_shipping( )
		$stockcheck= $product->get_availability();
		$rating_html = $product->get_average_rating();
		$need_shippping =$product->needs_shipping();

    echo "<div class='pin_price'><b>".$rating_html."</b><br>RATING</div>";
	if ($sales !=''){
		echo "<div class='pin_sales'><b>" . $sales . "</b><br>SALES</div>";} else {	echo "<div class='pin_sales'><b>N/A</b><br>SALES</div>";}
};
?>
</div>
<!---->
<?php
		echo"<div class='btn_pin_all'><div class='btn_pin_edit'><a href='".admin_url()."post.php?post=" . get_the_ID() . "&action=edit'><div class='pin_inside'><img src='" . AdminYo_dirURL . 'img/edit.png'  . "'></div></a></div><div class='pin_info'>  <img src='" . AdminYo_dirURL . 'img/info_icon.png'  . "'></div></a>";
		echo"<div class='btn_pin_view'><a target='_blank' href=\"" . get_permalink() . "\"><div class='pin_inside'><img src='" . AdminYo_dirURL . 'img/view.png'  . "'></div></a> ";
  	$data =  ayo_changePin($_GET["post_id"]);
?>
</div>
<?php
//display the no pin message.
	echo "</div></li>";
	}
//IF NO PINS FOUND 
 } else {
  echo"<span class='dashicons dashicons-admin-post' style='color:#2196F3;'></span><b>You have no active Pins. Start making some shortcuts of your <a href='".admin_url()."edit.php'>Posts</a>,<a href='".admin_url()."edit.php?post_type=page'>Pages</a> .</b>";
        }

wp_reset_postdata();
	if ( $new_status !== 'trash' ) {
// Do something when post is deleted
			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'pin_featured',
				//		'orderby'        => 'date',
				//		'order'          => 'DESC',
				'post__in' =>  get_user_meta( get_current_user_id(),'pins')[0],
				'posts_per_page' => 30
			                        );
			$my_query = new WP_Query( $args );
 }
//}
?>
			</ul>
		</div>
	</div>
</body>
<!-- end of body-->
<?php
//if Welcome Panel it's closed
  if ($ayo_options['welcome_panel'] == false) {?>
	</div>
	
<?php
	}
};
//Start pin board
		add_action( 'welcome_panel', 'ayo_pinsdash_welcome' );
// Limit the  dashboard pin titles
function ayo_the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();
	if ( $length && is_numeric($length) )
	 {
		$title = substr( $title, 0, $length );
	};
	if ( strlen($title)> 0 ) {
		$title = apply_filters('ayo_the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo ) { 	echo $title;  }	else{	return $title;	}
	};
	if ( strlen($title)> 10 ) {
		$title = apply_filters('ayo_the_titlesmall2', $before . $title . $after, $before, $after);
		if ( $echo ) {		echo "...";		}else {	 echo "...";}
	}
}
//query_posts($query_string."&featured=yes"));
class Ayo_Pins_Post
{
    var $db = NULL;
    public $post_types = array();
    function __construct()
		 {
        add_action('init', array(&$this,'init'     ));
        add_action('admin_init', array(&$this,'admin_init'        ));
        add_action('wp_ajax_toggle-featured-post', array(&$this,'admin_ajax'        ));
				//	add_action( 'wp_ajax_toggle-', 'my_ajax_callback' );
     }
    function init()
		{
        add_filter('query_vars', array(&$this,'query_vars'        ));
        add_action('pre_get_posts', array(&$this,'pre_get_posts'        ));
		//		add_action('admin_enqueue_scripts', 'my_ajax_callback');
    }
    function admin_init() {
				//	add_action('admin_enqueue_scripts',array(&$this,'my_ajax_callback'));
        add_filter('current_screen', array(&$this,'my_current_screen'        ));
        add_action('admin_head-edit.php', array(&$this,'admin_head'        ));
        add_filter('pre_get_posts', array(&$this,'admin_pre_get_posts'        ) , 1);
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
				$this->post_types['page'] = 'product';
        ksort($this->post_types);
        foreach ($this->post_types as $key => $val) {
			global $ayo_options;
 if ($ayo_options['pins_filter'] == true) {
            add_filter('manage_edit-' . $key . '_columns', array(&$this,
                'manage_posts_columns'
 ));}
            add_action('manage_' . $key . '_posts_custom_column', array(&$this,
                'manage_posts_custom_column'
            ) , 10, 2);
        }
    }
//set Pins column
    function ayo_add_views_link($views) {
        $post_type = ((isset($_GET['post_type']) && $_GET['post_type'] != "") ? $_GET['post_type'] : 'post');
        $count = $this->ayo_total_featured($post_type);
        $class = $_GET['post_status'] == 'pin_featured' ? "current" : '';
        $views['pin_featured'] = "<a class=\"" . $class . "\" id=\"featured-post-filter\" href=\"edit.php?&post_status=pin_featured&post_type={$post_type}\">Pins <span class=\"count\">({$count})</span></a>";
        return $views;
    }
    function ayo_total_featured($post_type = "post") {
        $rowQ = new WP_Query(array(
            'post_type' => $post_type,
            'post__in' =>  get_user_meta( get_current_user_id(),'pins')[0],
            'posts_per_page' => 1
        ));
        wp_reset_postdata();
        wp_reset_query();
        $rows = $rowQ->found_posts;
        unset($rowQ);
        return $rows;
    }
//Taking care of the AJAX
    function my_current_screen($screen) {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return $screen;
        }
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
				$this->post_types['page'] = 'product';
        ksort($this->post_types);
        foreach ($this->post_types as $key => $val) {
            add_filter('views_edit-' . $key, array(&$this,
                'ayo_add_views_link'
            ));
        }
        return $screen;
    }
//Create pins column
    function manage_posts_columns($columns) {
        global $current_user;
        get_currentuserinfo();
        if (current_user_can('edit_posts', $user_id)) {
            $columns['pin_featured'] = __('Pins');
        }
        return $columns;
}
    function manage_posts_custom_column($column_name, $post_id) {
        //echo "here";
        if ($column_name == 'pin_featured') {
            $is_featured = ayo_isPinned($post_id);
            $class = "dashicons";
            $text = "";
            if ($is_featured) {
                $class.= " dashicons-sticky";
                $text = "";
            } else {
                $class.= " dashicons-admin-post";
            }
            echo "<a href=\"#!featured-toggle\" class=\"featured-post-toggle {$class}\" data-post-id=\"{$post_id}\">$text</a>";
					///	echo "<a href=\"#!featured-toggle\" class=\"featured-post-search {$class}\" data-post-id=\"{$post_id}\">$text</a>";
			  }
    }
//send/receive AJAX request
    function admin_head() {
        echo '<script type="text/javascript">
		jQuery(document).ready(function($){
			$(\'.featured-post-toggle\').on("click",function(e){
				e.preventDefault();
				var _el=$(this);
				var post_id=$(this).attr(\'data-post-id\');
				var data={action:\'toggle-featured-post\',post_id:post_id};
				$.ajax({url:ajaxurl,data:data,type:\'post\',
					dataType:\'json\',
					success:function(data){
					_el.removeClass(\'dashicons-sticky\').removeClass(\'dashicons-admin-post\');
					$("#featured-post-filter span.count").text("("+data.ayo_total_featured+")");
					if(data.new_status){
						_el.addClass(\'dashicons-sticky\');
					}else{
						_el.addClass(\'dashicons-admin-post\');
					}
					}
				});
			});
		});
		</script>';
  }

//Pin inside Search
function my_ajax_callback($hook) {
	header('Content-Type: application/json');
	$post_id = $_POST['post_id'];
	$is_featured = ayo_isPinned($post_id);
	$newStatus = $is_featured ? false : true;
        ayo_changePin($_POST['post_id']);

	// delete_post_meta($post_id, '_is_featured');
	// add_post_meta($post_id, '_is_featured', $newStatus);
	echo json_encode(array(
			'ID' => $post_id,
			'new_status' => $newStatus,
			'ayo_total_featured' => $this->ayo_total_featured(get_post_type($post_id))
	));
	die();
} // end of my_ajax_callback()
function admin_ajax() {
        header('Content-Type: application/json');
        $post_id = $_POST['post_id'];
        $is_featured = ayo_isPinned($post_id);
        $newStatus = $is_featured ? false : true;
        ayo_changePin($_POST['post_id']);
        // delete_post_meta($post_id, '_is_featured');
        // add_post_meta($post_id, '_is_featured', $newStatus);
        echo json_encode(array(
            'ID' => $post_id,
            'new_status' => $newStatus,
            'ayo_total_featured' => $this->ayo_total_featured(get_post_type($post_id))
        ));
        die();
    }
function admin_pre_get_posts($query) {
        global $wp_query;
        if (is_admin() && $_GET['post_status'] == 'pin_featured') {
        	$query->set('post__in', get_user_meta( get_current_user_id(),'pins')[0]);
            // $query->set('meta_key', '_is_featured');
            // $query->set('meta_value', 'yes');
        }
        return $query;
    }
function query_vars($public_query_vars) {
        $public_query_vars[] = 'pin_featured';
        return $public_query_vars;
    }
function pre_get_posts($query) {
        if (!is_admin()) {
            if ($query->get('pin_featured') == 'yes') {
        		$query->set('post__in', get_user_meta( get_current_user_id(),'pins')[0]);

                // $query->set('meta_key', '_is_featured');
                // $query->set('meta_value', 'yes');
            }
        }
        return $query;
    }
//end of setup
}
//widget setup (deprecated)
class Ayo_Pins_Post_Widget extends WP_Widget
{
    private $post_types = array();
    function __construct() {
        parent::WP_Widget(false, $name = 'Featured Post');
    }
    function form($instance) {
              echo "</label>";
        echo "<input id = \"" . $this->get_field_id('num') . "\" class = \"widefat\" name = \"" . $this->get_field_name('num') . "\" type=\"text\" value =\"" . $num . "\" / >";
        echo "</p>";
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['num'] = (int)strip_tags($new_instance['num']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        if ($instance['num'] < 1) {
            $instance['num'] = 10;
        }
        return $instance;
    }
}
$Featured_Post = new Ayo_Pins_Post();
add_action('widgets_init', create_function('', 'return register_widget("Ayo_Pins_Post_Widget");') , 100);


/* Make pins column smaller */
add_action('admin_head', 'pins_column_size');
function pins_column_size() {
    echo '<style type="text/css">';
    echo '.column-pin_featured { text-align: center; width:50px !important; overflow:hidden }';
    echo '</style>';
}
/*Filter post types*/
add_action('restrict_manage_posts', 'ayo_filter_post_type_by_taxonomy');
function ayo_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = get_post_types(); // change to your post type
	$taxonomy  = 'group'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => ASC,
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/* PINS setup */
function ayo_changePin($id)
{
	 $user_id = get_current_user_id();
	 	// delete_user_meta($user_id,'pins');
	 $pins = get_user_meta( $user_id,'pins');
	 if (!$pins) {
		$pins =array();
	 	$pins[]= $id;
	 	add_user_meta($user_id,'pins', $pins);
	 	$status = "pinned";
		$color ="color";
	 }
	  else {
	  	// return var_export(in_array($id, $pins)).var_export($pins);
	 	 if (in_array($id, $pins[0])) {
	 	 	$key = array_search($id,$pins[0]);
	 	 	unset($pins[0][$key]);
	 		$status = "delete";
		 } else {
	 	   $pins[0][]= $id;
	 		$status = "pinned";
	 };
	 update_user_meta( $user_id,'pins', $pins[0]);
	 };
	 return json_encode(array("status"=>$status,"pins"=>$pins));
}
function ayo_isPinned($id)
{
	$user_id = get_current_user_id();
	 $pins = get_user_meta( $user_id,'pins');
	 if ($pins) {
	 	return in_array($id, $pins[0]);
	 }
	 return false;
}
//Pin from card AJAX call
add_action( 'wp_ajax_ayo_t_pin', 'ayo_t_pin' );
function ayo_t_pin() {
	echo ayo_changePin($_GET["post_id"]);
    die();
}
/* unpin from card */
add_action( 'wp_ajax_ayo_un_pin', 'ayo_un_pin' );
function ayo_un_pin() {
	echo ayo_changePin($_GET["post_id"]);
  echo $_GET["post_id"];
    die();
}


//END of file 