<?php

/**
 * 
 * Theme Support
 * 
 */
function berryFeatures()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

/**
 * 
 * REST API
 * 
 */

/*
  Add author name to post response
*/
function berryRestPost()
{
  register_rest_field('post', 'authorName', array(
    'get_callback' => function () {
      return get_the_author();
    }
  ));
}

/*
  Create new endpoint for search
*/
function berryRestSearchCB($data)
{
  $products = new WP_QUERY(array(
    'post_type' => 'post',
    // 's' => sanitize_text_field($data['term']),
    'post_status' => 'publish',
    'nopaging' => true,
    'posts_per_page' => 30,
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'post_title',
        'compare' => 'LIKE',
        'value' => sanitize_text_field($data['term'])
      ),
      array(
        'key' => 'posts_product_name',
        'compare' => 'LIKE',
        'value' => sanitize_text_field($data['term'])
      ),
      array(
        'key' => 'posts_product_description',
        'compare' => 'LIKE',
        'value' => sanitize_text_field($data['term'])
      )
    )
  ));

  $productResults = array();

  while ($products->have_posts()) {
    $products->the_post();
    array_push($productResults, array(
      'post_title' => get_the_title(),
      'post_product_name' => get_field('posts_product_name'),
      'post_excerpt' => get_the_excerpt(),
      'permalink' => get_the_permalink(),
      'post_thumbnail' => get_the_post_thumbnail(get_the_id(), 'thumbnail', ''),
      'post_price' => get_field('posts_price')
    ));
  }

  return $productResults;
  // return $products->posts;
}

function berryRestSearch()
{
  register_rest_route('berry/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'berryRestSearchCB'
  ));
}


add_action('after_setup_theme', 'berryFeatures');
add_action('rest_api_init', 'berryRestSearch');
add_action('rest_api_init', 'berryRestPost');
