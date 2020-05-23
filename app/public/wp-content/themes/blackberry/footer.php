<footer id="footer" class="text-light">
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-6 footer_section">
        <p class="h5"> <?php echo get_bloginfo('title'); ?> </p>
        <div>
          <?php
          wp_nav_menu(array(
            'menu' => 'header-main'
          ));
          ?>
        </div>
      </div>
      <div class="col-12 col-sm-6 footer_section">
        <p class="h5">Learn More About Our Products </p>
        <a class="btn btn-primary" href="/contact"> Contact </a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>