<?php

require_once 'includes/config.php';
require_once 'includes/post-types.php';
require_once 'includes/utils.php';

function sr_scripts_and_styles() {

  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

  if (!is_admin()) {


    // register main stylesheet
    wp_register_style( 'sr-sprites', get_stylesheet_directory_uri() . '/dist/img/css/_sprites.css', array(), '', 'all' );
    wp_register_style( 'sr-stylesheet', get_stylesheet_directory_uri() . '/dist/style.css', array(), '', 'all' );
    wp_register_script( 'sr-modernizr', get_stylesheet_directory_uri() . '/dist/js/modernizr.min.js', 'all' );
    wp_register_script( 'sr-js', get_stylesheet_directory_uri() . '/dist/script.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'sr-slick', get_stylesheet_directory_uri() . '/dist/js/slick/slick.min.js', 'screen' );
    wp_register_style( 'sr-slickstyle', get_stylesheet_directory_uri() . '/dist/js/slick/slick.css', array(), '', 'all' );

    
    wp_enqueue_style( 'sr-slickstyle' );
    wp_enqueue_style( 'sr-sprites' );
    wp_enqueue_style( 'sr-stylesheet' );
    
    wp_enqueue_script( 'sr-modernizr' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'sr-slick' );
    wp_enqueue_script( 'sr-js' );
    
  }
}

function sr_head_cleanup() {

  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // index link
  remove_action( 'wp_head', 'index_rel_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css

} 


function sr_ahoy() {
  add_theme_support( 'title-tag' );

  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();

  define( 'SR_THEME_DIR', $theme_dir );
  define( 'SR_THEME_URI', $theme_uri );

  add_editor_style();

  add_action( 'init', 'sr_head_cleanup' );

  add_theme_support( 'custom-logo' );

  add_theme_support('post-thumbnails');

  add_action( 'widgets_init', 'sr_register_sidebars' );

  add_action( 'wp_enqueue_scripts', 'sr_scripts_and_styles');

  register_nav_menus(
    array(
      'footer-links' => __( 'Footer Links', 'sr' ), 
      'main-nav' => __( 'Main Nav', 'sr' )
    )
  );
} 

// let's get this party started
add_action( 'init', 'sr_ahoy', 0 );


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes

add_image_size('sr-bucket', 450, 300, true);
add_image_size('sr-single-post', 900, 600, true);
add_image_size('sr-hero', 1800, 800, true);





add_filter( 'image_size_names_choose', 'sr_custom_image_sizes' );

function sr_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'sr-bucket' => __('450px by 300px'),
        'sr-single-post' => __('900px by 600px'),
        'sr-hero' => __('1800px by 800px')
    ) );
}


function sr_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'sr' ),
		'description' => __( 'The first (primary) sidebar.', 'sr' ),
    'before_widget' => '',
    'after_widget' => '',
	));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Sidebar 2', 'sr' ),
    'description' => __( 'The second sidebar.', 'sr' ),
    'before_widget' => '',
    'after_widget' => '',
  ));
}

// add_filter('the_content', 'filter_ptags_on_images');

// function filter_ptags_on_images($content){
//    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
// }

add_filter( 'wp_title', 'sr_wp_title_for_home' );
function sr_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo('title') . ' | ' . get_bloginfo( 'description' );
  }
  return $title . ' | ' . get_bloginfo('title') . ' | ' . get_bloginfo( 'description' );
}


function custom_excerpt_length( $length ) {
  return 16;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//Value Ajax

add_action('wp_ajax_nopriv_sr_ravalues', 'sr_value_getter' );
add_action('wp_ajax_sr_ravalues', 'sr_value_getter' );

function sr_value_getter() {
  $id = json_decode( stripslashes( $_POST['id'] ));
  $value_posts = new WP_Query(
    array(
      'p' => $id,
      'post_type' => 'any',
    )
  );

  while ($value_posts->have_posts()) : $value_posts->the_post();
    $value_content = get_the_content();
  endwhile;
  echo $value_content;
  die();
}

function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
}

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('previous'),
    'next_text'       => __('next'),
    'type'            => 'list',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<div class='pagination'>";
      echo $paginate_links;
    echo "</div>";
  }

}
//Allow SVG upload

function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// filter the Gravity Forms button type
add_filter( 'gform_submit_button', 'form_submit_button', 10, 2 );
function form_submit_button( $button, $form ) {
    return "<button class='button btn btn-primary' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}

if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page();
  
}

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

