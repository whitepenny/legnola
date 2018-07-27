<?php

// Register Custom Post types

function sr_register_post_types() {



  $home_url = get_home_url();
  $bcn_options = get_option( 'bcn_options' );

  $project_root_id = $bcn_options['apost_project_root'];
  $project_slug = trim( str_ireplace( $home_url, '', get_permalink( $project_root_id ) ), '/' );

  $slugs = array(
    'project' => $project_slug,
  );

  // Stories
  register_post_type( 'project', array(
    'labels'              => array(
      'name'              => 'Projects',
      'singular_name'     => 'Project',
      'add_new_item'      => 'Add New Project',
      'edit_item'         => 'Edit Project',
    ),
    'description'         => '',
    'menu_icon'           => 'dashicons-id-alt',
    'public'              => true,
    'show_ui'             => true,
    'has_archive'         => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => false,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'capabilities'        => array(),
    'supports'            => array( 'title', 'editor', 'revisions', 'thumbnail' ),
    'map_meta_cap'        => true,
    'map_meta_cap'        => true,
    'hierarchical'        => false,
    'rewrite'             => array(
      'slug'              => $slugs['project'],
      'with_front'        => false,
    ),
    'query_var'           => true,
  ) );

    $old_slugs = get_option( 'catch_post_type_slugs' );
    if ( empty( $old_slugs ) || (
      $slugs['project'] != $old_slugs['project']
    ) ) {
      flush_rewrite_rules();
      update_option( 'sr_post_type_slugs', $slugs );
    }
  }

  add_action( 'init', 'sr_register_post_types', 5 );