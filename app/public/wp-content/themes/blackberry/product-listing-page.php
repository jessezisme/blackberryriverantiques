<?php

/**
 *
 * Template Name: Product Listing Page
 *
 */
?>

<?php
wp_enqueue_style('style-product-listing-page', get_template_directory_uri() . '/dist/css/product-listing-page/plp.css');
?>
<?php get_header(); ?>

<main id="main">

  <section class="plp">
    <div class="container">
      <div class="row section-spacing">
        <div class="col-12 plp_content ">
          <?php echo the_content(); ?>
        </div>
      </div>
      <!-- product grid -->
      <div class="row section-spacing">
        <?php
        // set the "paged" parameter (use 'page' if the query is on a static front page)
        $paged = (get_query_var('paged')) ? get_query_var('paged') : '1';
        $args = array(
          'nopaging'               => false,
          'paged'                  => $paged,
          'posts_per_page'         => '30',
          'post_type'              => 'post'
        );
        // query
        $query = new WP_Query($args);
        // loop
        if ($query->have_posts()) {
          while ($query->have_posts()) {
            $query->the_post();
            // image 
            $getMainImg = get_post_meta($post->ID, 'posts_product_main_image', true);
            $getAltText = get_post_meta($getMainImg, '_wp_attachment_image_alt', true) ? get_post_meta($getMainImg, '_wp_attachment_image_alt', true) : '';
            $getImg = wp_get_attachment_image($getMainImg, 'medium_large', false, array(
              'class' => 'img-fluid grid-item_img'
            ));
            $getImgSrcMedLg = wp_get_attachment_image_src($getMainImg, 'medium_large', false);
            $getImgSrcMed = wp_get_attachment_image_src($getMainImg, 'medium', false);
            // name 
            $getProductName = get_post_meta($post->ID, 'posts_product_name', true);
            // description
            $getProductShortDescription = get_post_meta($post->ID, 'posts_product_description', true);
            $getProductExcerpt = get_the_excerpt();
            $getProductExcerptTruncate = strlen($getProductExcerpt) > 80 ? substr($getProductExcerpt, 0, 80) . '...' : $getProductExcerptTruncate;
            $getDescription = $getProductShortDescription ? $getProductShortDescription : $getProductExcerptTruncate;
        ?>
            <div class="grid-item col-xs-12 col-sm-6 col-md-4 text-dark text-center">
              <a href="<?php the_permalink($post->ID); ?>">
                <div class="grid-item_img-wrap grid-item_spacing text-dark ">
                  <img class="img-fluid grid-item_img" alt="<?php echo $getAltText; ?>" src="<?php echo $getImgSrcMedLg[0]; ?>" srcset="<?php echo $getImgSrcMed[0]; ?> 300w, <?php echo $getImgSrcMedLg[0]; ?> 768w, " sizes="100vw, (min-width: 576px) 50vw">
                </div>
                <div class="grid-item_name-wrap grid-item_spacing text-dark ">
                  <?php echo $getProductName; ?>
                </div>
                <div class="grid-item_cta grid-item_spacing">
                  View Product
                </div>
              </a>
            </div>
        <?php
          }
        }
        ?>
      </div>
      <!-- pagination -->
      <div class="row section-spacing">
        <div class="col-6 text-right">
          <?php
          if (get_previous_posts_page_link() && $paged != 1) {
          ?>
            <a href="<?php echo get_previous_posts_page_link() ?>">Previous</a>
          <?php
          }
          ?>
        </div>
        <div class="col-6 text-left">
          <?php
          if (get_next_posts_page_link($query->max_num_pages)) {
          ?>
            <a href="<?php echo get_next_posts_page_link() ?>">Next</a>
          <?php
          }
          ?>
        </div>
        <?php
        wp_reset_postdata();
        ?>
      </div>
    </div>

  </section>

</main>

<?php get_footer(); ?>