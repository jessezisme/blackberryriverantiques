<?php

function berry_init_post_types()
{
  // register post type
  register_post_type(
    'event',
    array(
      'show_in_rest' => true,
      'has_archive' => true,
      'public' => true,
      'labels' => array(
        'name' => 'Events'
      ),
      'menu-icon' => 'dashicons-calendar-alt',
      'add_new_item' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'singular_name' => 'Event',
      'supports' => array('title', 'editor', 'excerpt')
    )
  );
}

add_action('init', 'berry_init_post_types');
