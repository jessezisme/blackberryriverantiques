<?php wp_enqueue_style('style-page-front-page', get_template_directory_uri() . '/dist/css/front-page/front-page.css'); ?>
<?php get_header(); ?>

<?php
$getHeroText = get_post_meta(get_the_ID(), 'hp_hero_image_text', TRUE) ? get_post_meta(get_the_ID(), 'hp_hero_image_text', TRUE) : get_bloginfo('title');
$getHeroImageID = get_post_meta(get_the_ID(), 'hp_hero_bg_image', TRUE);
$getHeroImageSRC = '';
if ($getHeroImageID) {
  $getHeroImageSRC = wp_get_attachment_image_src($getHeroImageID, 'full');
  $getHeroImageSRC = $getHeroImageSRC[0];
}
?>

<main id="main">

  <div class="page">

    <!-- hero -->
    <div class="page-hero" style="background-image: url(<?php echo $getHeroImageSRC; ?> )">
      <div class="container">
        <div class="page-hero_content">
          <div class="page-hero_content-inner">
            <?php
            echo $getHeroText;
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- product grid -->
    <?php get_template_part('partials/partial-product-grid/partial-product-grid', 'page'); ?>

    <!-- intro -->
    <div class="pg-hp-intro">
      <div class="container">
        <div class="col-xs-12">
          <div class="pg-hp-intro_content">
            <?php echo the_content(); ?>
          </div>
        </div>
      </div>
    </div>

  </div>

</main>


<?php get_footer(); ?>