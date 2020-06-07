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

    /**
     *
     * Search functionality:
     * handles all search-related functionality
     *
     */
    var moduleSearch = {
      searchRoute: window.berry_util.rootURL,
      isOpen: false,
      searchTimeout: null,
      searchTerm: '',
      dataResponseObj: {},
      $elOverlay: $("[data-js='search-overlay']"),
      $elSearchForm: $("[data-js='search-overlay_form']"),
      $elSearchInput: $("[data-js='search-overlay_input']"),
      $elSearchBtn: $("[data-js='search_btn']"),
      $elSearchBtnClose: $("[data-js='search_btn_close']"),
      $elSearchResults: $('#search-overlay_results'),
      classOverflowHidden: 'base-overflow_hidden',

      /*
        initializer 
      */
      init: function () {
        var self = this;

        // open search
        this.$elSearchBtn.click(function () {
          self.openSearch();
        });
        // close search
        this.$elSearchBtnClose.click(function () {
          self.closeSearch();
        });
        // prevent search form submit
        this.$elSearchForm.on('submit.berrySearchSubmit', function (event) {
          event.preventDefault();
          return false;
        });
        // listens for any input on search field
        this.$elSearchInput.on('input.berrySearchInput', function (event) {
          // get search term now
          self.searchTerm = $.trim($(this).val().toLowerCase());
          // clear results if term is empty
          if (!self.searchTerm.length) {
            self.clearResults();
          }
          // clear any previous timeout; done to avoid multiple calls while still typing
          if (self.searchTimeout) {
            window.clearTimeout(self.searchTimeout);
          }
          // set new timeout
          self.searchTimeout = window.setTimeout(function () {
            self.runRequest();
          }, 1500);
        });
        // trap focus inside overlay
        this.$elOverlay.on('focusout.berrySearchFocusOut', function (event) {
          window.setTimeout(function () {
            if (self.isOpen && self.$elOverlay.find('*:focus').length === 0) {
              self.$elOverlay.find('a, button').first().trigger('focus');
            }
          }, 25);
        });
      },
      /*
        opens search overlay
      */
      openSearch: function () {
        var self = this;
        self.isOpen = true;
        self.$elOverlay.removeClass('is-hidden');
        $('body').addClass(self.classOverflowHidden);
        self.$elSearchInput.trigger('focus');
      },
      /*
        closes search overlay
      */
      closeSearch: function () {
        var self = this;
        self.isOpen = false;
        self.dataResponseObj = {};
        self.$elOverlay.addClass('is-hidden');
        $('body').removeClass(self.classOverflowHidden);
        self.clearResults();
        self.searchTerm = '';
        self.$elSearchInput.val('');
        self.$elSearchBtn.trigger('focus');
      },

      /*
        runs search request
      */
      runRequest: function () {
        var self = this;
        var getSearchTerm = self.searchTerm;
        // set loading spinners
        function setLoadingSpinner() {
          self.$elOverlay.addClass('is-loading');
        }
        // clear loading spinner
        function clearLoadingSpinner() {
          self.$elOverlay.removeClass('is-loading');
        }
        // success callback
        function successCB(response) {
          self.dataResponseObj = {
            searchTerm: getSearchTerm,
            response: response,
          };
          self.updateResults();
        }
        // always runs callback
        function alwaysCB() {
          clearLoadingSpinner();
        }
        // run request
        function runRequest() {
          setLoadingSpinner();

          $.ajax({
            url: window.berry_util.rootURL + '/wp-json/berry/v1/search?term=' + encodeURIComponent(getSearchTerm),
            type: 'GET',
          })
            .done(successCB)
            .always(alwaysCB);
        }
        if (getSearchTerm && self.dataResponseObj.searchTerm !== getSearchTerm) {
          runRequest();
        }
      },
      /*
        Updates DOM with results
      */
      updateResults: function () {
        var self = this;
        var searchTerm = self.dataResponseObj.searchTerm || '';
        var response = self.dataResponseObj.response || [];

        // avoid updating if current search term doesn't match requested search term
        if (self.dataResponseObj.searchTerm !== self.searchTerm) {
          return false;
        }
        // no results
        if (!response.length) {
          self.clearResults();
          $('<div role="alert"> No Results Found </div>').appendTo(self.$elSearchResults);
          return false;
        }
        // updates DOM with results
        function updateDOM() {
          var $elUL = $('<ul role="listbox"></ul>');

          response.forEach(function (val, index, arr) {
            var getLI = $('<li></li>');
            var getLink = $('<a></a>').attr('href', val.permalink);
            var getTitle = $('<div></div>').text(val.post_product_name);

            getTitle.appendTo(getLink);
            getLink.appendTo(getLI);
            getLI.appendTo($elUL);
          });
          self.clearResults();
          $elUL.appendTo(self.$elSearchResults);
        }
        updateDOM();
      },
      /*
        clear DOM results
      */
      clearResults: function () {
        var self = this;
        self.$elSearchResults.off().empty().html();
        self.dataResponseObj = {};
      },
    };

    moduleSearch.init();
  });
})(jQuery);
