<?php
wp_enqueue_style('style-archive', get_template_directory_uri() . '/dist/css/archive/archive.css');
?>
<?php get_header(); ?>

<main id="main">

  <section class="archive">
    <div class="container">

      <div class="row archive-row">
        <h1 class="h1 col-12"> <?php the_archive_title(); ?> </h1>
        <?php
        if (get_the_archive_description()) {
        ?>
          <p>
            <?php the_archive_description(); ?>
          </p>
        <?php
        }
        ?>
      </div>

      <?php
      while (have_posts()) {
        the_post();
      ?>
        <div class="row archive-row">
          <div class="col-12">
            <div class="archive-item">
              <h3 class="archive-title"> <?php echo get_the_title(); ?> </h3>
              <p class="archive-text">
                <?php the_excerpt(); ?>
              </p>
              <div>
                <a href="<?php the_permalink(); ?>"> View Post </a>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      wp_reset_postdata();
      ?>
    </div>

  </section>

</main>

<?php get_footer(); ?>