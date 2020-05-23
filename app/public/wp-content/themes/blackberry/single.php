<!-- styles -->
<?php
wp_enqueue_style('style-single', get_template_directory_uri() . '/dist/css/single/single.css');
?>
<!-- header -->
<?php get_header(); ?>

<?php
// name 
$getProductName = get_post_meta($post->ID, 'posts_product_name', true);
// description
$getProductDescription = get_post_meta($post->ID, 'posts_product_description', true);
// pricing
$getProductPrice = get_post_meta($post->ID, 'posts_price', true);
// featured image 
$getFeaturedImg = get_the_post_thumbnail($post->ID, 'large', array(
  'class' => 'img-fluid'
));
// slideshow
$getSlideshow = get_field('posts_slideshow');
?>


<main id="main">

  <!-- next/previous links -->
  <div class="single-pagination">
    <div class="container">
      <div class="row section-spacing">
        <div class="col-6 text-left">
          <?php
          $previousPost = get_previous_post();
          if ($previousPost) {
          ?>
            <a href="<?php echo get_permalink($previousPost->ID) ?>"> &lt; Previous Product </a>
          <?php
          }
          ?>
        </div>
        <div class="col-6 text-right">
          <?php
          $nextPost = get_next_post();
          if ($nextPost) {
          ?>
            <a href="<?php echo get_permalink($nextPost->ID); ?>"> Next Product &gt; </a>
          <?php
          }
          ?>
        </div>
        <?php
        wp_reset_postdata();
        ?>
      </div>
    </div>
  </div>

  <!-- product -->
  <div class="single">
    <div class="container">
      <div class="row">
        <div class="col-12 col-xl-6 single_content-wrap single_spacing-md">
          <?php
          if ($getSlideshow) {
            echo $getSlideshow;
          } elseif ($getFeaturedImg) {
            echo $getFeaturedImg;
          }
          ?>
        </div>
        <div class="col-12 col-xl-6 single_detail-wrap single_spacing-md">
          <div class="single_name-wrap single_spacing-xl ">
            <h1 class="single_name"><?php echo $getProductName; ?></h1>
          </div>
          <div class="single_price single_spacing-xl ">
            <?php echo $getProductPrice; ?>
          </div>
          <div class="single_desc single_spacing-xl ">
            <?php echo $getProductDescription; ?>
          </div>
          <div class="single_contact single_spacing-xl ">
            <a href="#contact-form"> To purchase this product or if you have any questions, please contact us via this form. </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- contact form -->
  <div id="contact-form" class="single-form">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="single-form_contact-heading"> Contact </h2>
        </div>
        <div class="col-12">
          <div>
            <?php
            echo do_shortcode('[contact-form-7 id="143" title="Contact Form"]');
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<!-- product grid -->
<?php get_template_part('partials/partial-product-grid/partial-product-grid', 'partial-product-grid'); ?>


<!-- footer -->
<?php get_footer(); ?>