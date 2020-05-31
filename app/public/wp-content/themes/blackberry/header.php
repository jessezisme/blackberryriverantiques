<!doctype html>
<html lang="en-US">

<head>

  <meta charset="utf-8">

  <title><?php wp_title(''); ?></title>

  <meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0f222b">

  <?php
  wp_enqueue_style('style-main', get_template_directory_uri() . '/dist/css/main/main.css');
  wp_enqueue_style('style-font', 'https://fonts.googleapis.com/css?family=Karla:400,700|Merriweather:400,700&display=swap');
  wp_enqueue_script('script-bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap-4.4.1/dist/js/bootstrap.min.js', array('jquery'), '', true);
  wp_enqueue_script('script-main', get_template_directory_uri() . '/dist/js/main.js', array('jquery'), '', true);
  wp_localize_script('script-main', 'berry_util', array(
    'rootURL' => get_site_url()
  ));

  ?>

  <?php
  wp_head();
  ?>
</head>

<body>

  <header id="header">
    <nav class="container">
      <div class="header-full d-none d-lg-block">
        <div class="header-inner text-light">
          <div class="header-logo">
            <a href="/"><?php echo get_bloginfo('title'); ?></a>
          </div>
          <div class="header-nav-main">
            <button data-js="search_btn" class="btn btn-primary header-nav_search-btn">
              <span class="sr-only"> Search </span>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M23.822 20.88l-6.353-6.354c.93-1.465 1.467-3.2 1.467-5.059.001-5.219-4.247-9.467-9.468-9.467s-9.468 4.248-9.468 9.468c0 5.221 4.247 9.469 9.468 9.469 1.768 0 3.421-.487 4.839-1.333l6.396 6.396 3.119-3.12zm-20.294-11.412c0-3.273 2.665-5.938 5.939-5.938 3.275 0 5.94 2.664 5.94 5.938 0 3.275-2.665 5.939-5.94 5.939-3.274 0-5.939-2.664-5.939-5.939z" /></svg>
            </button>
            <?php
            wp_nav_menu(array(
              'menu' => 'header-main'
            ));
            ?>
          </div>
        </div>
      </div>
      <div class="header-mob d-xs-block d-lg-none clearfix">
        <div class="header-mob_flex">
          <div class="header-mob_name">
            <?php echo get_bloginfo('title'); ?>
          </div>
          <button data-js="search_btn" class="btn btn-primary header-nav_search-btn">
            <span class="sr-only"> Search </span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M23.822 20.88l-6.353-6.354c.93-1.465 1.467-3.2 1.467-5.059.001-5.219-4.247-9.467-9.468-9.467s-9.468 4.248-9.468 9.468c0 5.221 4.247 9.469 9.468 9.469 1.768 0 3.421-.487 4.839-1.333l6.396 6.396 3.119-3.12zm-20.294-11.412c0-3.273 2.665-5.938 5.939-5.938 3.275 0 5.94 2.664 5.94 5.938 0 3.275-2.665 5.939-5.94 5.939-3.274 0-5.939-2.664-5.939-5.939z" /></svg>
          </button>
          <button data-js="header-mob_btn" class="header-mob_btn" aria-expanded="false" aria-controls="header-mob_flyout">
            <span class="open-icon">
              <svg class="header-mob_nav-btn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" /></svg>
              <span class="sr-only"> Open Navigation </span>
            </span>
            <span class="close-icon">
              <svg class="header-mob_nav-btn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M20.197 2.837l.867.867-8.21 8.291 8.308 8.202-.866.867-8.292-8.21-8.23 8.311-.84-.84 8.213-8.32-8.312-8.231.84-.84 8.319 8.212 8.203-8.309zm-.009-2.837l-8.212 8.318-8.31-8.204-3.666 3.667 8.321 8.24-8.207 8.313 3.667 3.666 8.237-8.318 8.285 8.204 3.697-3.698-8.315-8.209 8.201-8.282-3.698-3.697z" /></svg>
            </span>
          </button>
        </div>
        <div data-js="header-mob_flyout" id="header-mob_flyout" class="header-mob_flyout">
          <?php
          wp_nav_menu(array(
            'menu' => 'header-main'
          ));
          ?>
        </div>
      </div>
    </nav>

    <div data-js="search-overlay" id="search-overlay" class="is-hidden">
      <div class="search-overlay_in">
        <div class="text-center">
          <button data-js="search_btn_close" id="search-overlay_close" class="btn btn-primary"> Close Search </button>
        </div>
        <form data-js="search-overlay_form">
          <div class="form-group">
            <input aria-controls="search-overlay_results" data-js="search-overlay_input" type="search" aria-label="Search Products" placeholder="Search Products" class="form-control">
          </div>
        </form>
        <div id="search-overlay_loading">
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div id="search-overlay_results">
        </div>
      </div>
    </div>


  </header>