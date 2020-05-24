(function ($) {
  var UTIL = window.berry_util;
  var ROOT_URL = UTIL.rootURL;

  $(document).ready(function () {
    /**
     * Mobile Navigation:
     * handles the mobile navigation functionality
     */
    $("[data-js='header-mob_btn']").click(function (event) {
      $("[data-js='header-mob_flyout']").toggleClass('is-open').hasClass('is-open')
        ? $(this).attr('aria-expanded', 'true')
        : $(this).attr('aria-expanded', 'false');
    });
  });
})(jQuery);
