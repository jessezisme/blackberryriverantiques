<?php wp_enqueue_style('style-page-page', get_template_directory_uri() . '/dist/css/page/page.css'); ?>
<?php get_header(); ?>


<main id="main" class="page">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1> This page doesn't exist.
          <br>
          Return <a href="<?php echo get_home_url(); ?>">home</a>.
        </h1>
      </div>
    </div>
  </div>

  <!-- product grid -->
  <?php get_template_part('partials/partial-product-grid/partial-product-grid', 'page'); ?>

</main>


<?php get_footer(); ?>