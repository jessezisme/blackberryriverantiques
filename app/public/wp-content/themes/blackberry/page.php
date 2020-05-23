<?php wp_enqueue_style('style-page-page', get_template_directory_uri() . '/dist/css/page/page.css'); ?>
<?php get_header(); ?>


<main id="main" class="page">

  <section class="container">
    <div class="row">
      <div class="col-12">
        <h1> <?php the_title(); ?> </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="page-maxwidth-text">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

</main>


<?php get_footer(); ?>