"use strict";!function(o){window.berry_util.rootURL;o(document).ready(function(){o("[data-js='header-mob_btn']").click(function(e){o("[data-js='header-mob_flyout']").toggleClass("is-open").hasClass("is-open")?o(this).attr("aria-expanded","true"):o(this).attr("aria-expanded","false")}),{searchRoute:window.berry_util.rootURL,isOpen:!1,searchTimeout:null,searchTerm:"",dataResponseObj:{},$elOverlay:o("[data-js='search-overlay']"),$elSearchForm:o("[data-js='search-overlay_form']"),$elSearchInput:o("[data-js='search-overlay_input']"),$elSearchBtn:o("[data-js='search_btn']"),$elSearchBtnClose:o("[data-js='search_btn_close']"),$elSearchResults:o("#search-overlay_results"),classOverflowHidden:"base-overflow_hidden",init:function(){var a=this;this.$elSearchBtn.click(function(){a.openSearch()}),this.$elSearchBtnClose.click(function(){a.closeSearch()}),this.$elSearchForm.on("submit.berrySearchSubmit",function(e){return e.preventDefault(),!1}),this.$elSearchInput.on("input.berrySearchInput",function(e){a.searchTerm=o.trim(o(this).val().toLowerCase()),a.searchTerm.length||a.clearResults(),a.searchTimeout&&window.clearTimeout(a.searchTimeout),a.searchTimeout=window.setTimeout(function(){a.runRequest()},1500)}),this.$elOverlay.on("focusout.berrySearchFocusOut",function(e){window.setTimeout(function(){a.isOpen&&0===a.$elOverlay.find("*:focus").length&&a.$elOverlay.find("a, button").first().trigger("focus")},25)})},openSearch:function(){var e=this;e.isOpen=!0,e.$elOverlay.removeClass("is-hidden"),o("body").addClass(e.classOverflowHidden),e.$elSearchInput.trigger("focus")},closeSearch:function(){var e=this;e.isOpen=!1,e.dataResponseObj={},e.$elOverlay.addClass("is-hidden"),o("body").removeClass(e.classOverflowHidden),e.clearResults(),e.searchTerm="",e.$elSearchInput.val(""),e.$elSearchBtn.trigger("focus")},runRequest:function(){var a=this,s=a.searchTerm;function e(e){a.dataResponseObj={searchTerm:s,response:e},a.updateResults()}function r(){a.$elOverlay.removeClass("is-loading")}function t(){a.$elOverlay.addClass("is-loading"),o.ajax({url:window.berry_util.rootURL+"/wp-json/berry/v1/search?term="+encodeURIComponent(s),type:"GET"}).done(e).always(r)}s&&a.dataResponseObj.searchTerm!==s&&t()},updateResults:function(){var n,e=this,a=(e.dataResponseObj.searchTerm,e.dataResponseObj.response||[]);if(e.dataResponseObj.searchTerm!==e.searchTerm)return!1;if(!a.length)return e.clearResults(),o('<div role="alert"> No Results Found </div>').appendTo(e.$elSearchResults),!1;n=o('<ul role="listbox"></ul>'),a.forEach(function(e,a,s){var r=o("<li></li>"),t=o("<a></a>").attr("href",e.permalink);o("<div></div>").text(e.post_title).appendTo(t),t.appendTo(r),r.appendTo(n)}),e.clearResults(),n.appendTo(e.$elSearchResults)},clearResults:function(){this.$elSearchResults.off().empty().html(),this.dataResponseObj={}}}.init()})}(jQuery);