<?php
wp_enqueue_style('style-partial-product-grid', get_template_directory_uri() . '/dist/css/partials/partial-product-grid/partial-product-grid.css');
?>

<?php
$shouldDisplayGrid = get_post_meta(get_the_ID(), 'product_grid_is_displayed', TRUE);
$getMaxGridSize = get_post_meta(get_the_ID(), 'product_grid_number_products', TRUE) ? get_post_meta(get_the_ID(), 'product_grid_number_products', TRUE) : 6;
$getGridButtonText = get_post_meta(get_the_ID(), 'product_grid_button_text', TRUE);
$getProductListingPage = get_pages(array(
  'post_type'   => 'page',
  'number' => 1,
  'meta_key'     => 'is_product_listing_page',
  'meta_value'   => '1',
));
$getProductListingPageLink;
foreach ($getProductListingPage as $page) {
  $getProductListingPageLink = get_page_link($page->ID);
}
$getProductPosts = get_posts(array(
  'post_type'   => 'post',
  'numberposts' => $getMaxGridSize
));
?>

<?php
if (
  is_404() ||
  ((get_post_type() === 'page' && $shouldDisplayGrid) || (get_post_type() === 'post'))  &&
  $getProductListingPageLink
) {
?>
  <section class="page-products">
    <div class="container">
      <div class="page-products_cta-wrap">
        <a class="btn btn-primary" href="<?php echo $getProductListingPageLink ?>">
          <?php
          $buttonText =  $getGridButtonText ? $getGridButtonText : 'View Available Items';
          echo $buttonText;
          ?>
        </a>
      </div>

      <div class="page-products_grid">
        <div class="row">
          <?php
          $getCounter = 1;
          foreach ($getProductPosts as $product) {
            $getImg = get_the_post_thumbnail($product->ID, 'medium_large');
            $getProductName = get_post_meta($product->ID, 'posts_product_name', true);
            $getProductShortDescription = get_post_meta($product->ID, 'posts_product_description', true);
          ?>
            <div class="grid-item col-xs-12 col-sm-6 col-md-4 text-dark">
              <a href="<?php the_permalink($product); ?>">
                <div class="grid-item_img-wrap text-dark">
                  <?php
                  if ($getImg) {
                    echo $getImg;
                  }
                  ?>
                </div>
                <div class="grid-item_name-wrap text-dark">
                  <?php echo $getProductName ?>
                </div>
                <div class="grid-item_cta"> View Product </div>
              </a>
            </div>
          <?php
          };
          ?>
        </div>
      </div>

    </div>
  </section>
<?php
};
?>