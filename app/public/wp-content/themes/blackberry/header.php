<!doctype html>
<html lang="en-US">

<head>

  <meta charset="utf-8">

  <title><?php wp_title(''); ?></title>

  <meta name="description" content="<?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <meta name="theme-color" content="#fafafa">

  <?php
  wp_enqueue_style('style-main', get_template_directory_uri() . '/dist/css/main/main.css');
  wp_enqueue_style('style-header', get_template_directory_uri() . '/dist/css/header/header.css');
  wp_enqueue_style('style-footer', get_template_directory_uri() . '/dist/css/footer/footer.css');
  wp_enqueue_style('style-font', 'https://fonts.googleapis.com/css?family=Karla:400,700|Merriweather:400,700&display=swap');
  wp_enqueue_script('script-jquery', get_template_directory_uri() . '/dist/vendor/jquery/jquery-3.5.0.min.js', array(), '', true);
  wp_enqueue_script('script-bootstrap-js', get_template_directory_uri() . '/dist/vendor/bootstrap-4.4.1/dist/js/bootstrap.min.js', array(), '', true);
  ?>

  <?php
  wp_add_inline_script(
    'script-jquery',
    'jQuery(document).ready(function($){
      $("[data-js=\'header-mob_btn\']").click(function(event) {
        $("[data-js=\'header-mob_flyout\']").toggleClass("is-open").hasClass("is-open")
        ? $(this).attr("aria-expanded", "true")
        : $(this).attr("aria-expanded", "false"); 
      }); 
    });'
  );
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
  </header>