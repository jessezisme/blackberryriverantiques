"use strict";!function(o){window.berry_util.rootURL,o(document).ready(function(){o("[data-js='header-mob_btn']").click(function(e){o("[data-js='header-mob_flyout']").toggleClass("is-open").hasClass("is-open")?o(this).attr("aria-expanded","true"):o(this).attr("aria-expanded","false")});var e={searchRoute:window.berry_util.rootURL,isOpen:!1,searchTimeout:null,searchTerm:"",dataResponseObj:{},$elOverlay:o("[data-js='search-overlay']"),$elSearchForm:o("[data-js='search-overlay_form']"),$elSearchInput:o("[data-js='search-overlay_input']"),$elSearchBtn:o("[data-js='search_btn']"),$elSearchBtnClose:o("[data-js='search_btn_close']"),$elSearchResults:o("#search-overlay_results"),classOverflowHidden:"base-overflow_hidden",init:function(){var s=this;this.$elSearchBtn.click(function(){s.openSearch()}),this.$elSearchBtnClose.click(function(){s.closeSearch()}),this.$elSearchForm.on("submit",function(e){return e.preventDefault(),!1}),this.$elSearchInput.on("input",function(e){s.searchTerm=o.trim(o(this).val().toLowerCase()),s.searchTerm.length||s.clearResults(),s.searchTimeout&&window.clearTimeout(s.searchTimeout),s.searchTimeout=window.setTimeout(function(){s.runRequest()},1500)}),this.$elOverlay.on("focusout",function(e){window.setTimeout(function(){s.isOpen&&0===s.$elOverlay.find("*:focus").length&&s.$elOverlay.find("a, button").first().trigger("focus")},25)})},openSearch:function(){this.isOpen=!0,this.$elOverlay.removeClass("is-hidden"),o("body").addClass(this.classOverflowHidden),this.$elSearchInput.trigger("focus")},closeSearch:function(){this.isOpen=!1,this.dataResponseObj={},this.$elOverlay.addClass("is-hidden"),o("body").removeClass(this.classOverflowHidden),this.clearResults(),this.searchTerm="",this.$elSearchInput.val(""),this.$elSearchBtn.trigger("focus")},runRequest:function(){var s=this,a=s.searchTerm;function e(e){s.dataResponseObj={searchTerm:a,response:e},s.updateResults()}function t(){s.$elOverlay.removeClass("is-loading")}a&&s.dataResponseObj.searchTerm!==a&&(s.$elOverlay.addClass("is-loading"),o.ajax({url:window.berry_util.rootURL+"/wp-json/berry/v1/search?term="+encodeURIComponent(a),type:"GET"}).done(e).always(t))},updateResults:function(){var n,e=this,s=(e.dataResponseObj.searchTerm,e.dataResponseObj.response||[]);return e.dataResponseObj.searchTerm===e.searchTerm&&(s.length?(n=o('<ul role="listbox"></ul>'),s.forEach(function(e,s,a){var t=o("<li></li>"),r=o("<a></a>").attr("href",e.permalink);o("<div></div>").text(e.post_title).appendTo(r),r.appendTo(t),t.appendTo(n)}),e.clearResults(),void n.appendTo(e.$elSearchResults)):(e.clearResults(),o('<div role="alert"> No Results Found </div>').appendTo(e.$elSearchResults),!1))},clearResults:function(){this.$elSearchResults.off().empty().html(),this.dataResponseObj={}}};e.init(),window.moduleSearch=e})}(jQuery),function(o){window.berry_util.rootURL;o(document).ready(function(){o("[data-js='header-mob_btn']").click(function(e){o("[data-js='header-mob_flyout']").toggleClass("is-open").hasClass("is-open")?o(this).attr("aria-expanded","true"):o(this).attr("aria-expanded","false")});var e={searchRoute:window.berry_util.rootURL,isOpen:!1,searchTimeout:null,searchTerm:"",dataResponseObj:{},$elOverlay:o("[data-js='search-overlay']"),$elSearchForm:o("[data-js='search-overlay_form']"),$elSearchInput:o("[data-js='search-overlay_input']"),$elSearchBtn:o("[data-js='search_btn']"),$elSearchBtnClose:o("[data-js='search_btn_close']"),$elSearchResults:o("#search-overlay_results"),classOverflowHidden:"base-overflow_hidden",init:function(){var s=this;this.$elSearchBtn.click(function(){s.openSearch()}),this.$elSearchBtnClose.click(function(){s.closeSearch()}),this.$elSearchForm.on("submit",function(e){return e.preventDefault(),!1}),this.$elSearchInput.on("input",function(e){s.searchTerm=o.trim(o(this).val().toLowerCase()),s.searchTerm.length||s.clearResults(),s.searchTimeout&&window.clearTimeout(s.searchTimeout),s.searchTimeout=window.setTimeout(function(){s.runRequest()},1500)}),this.$elOverlay.on("focusout",function(e){window.setTimeout(function(){s.isOpen&&0===s.$elOverlay.find("*:focus").length&&s.$elOverlay.find("a, button").first().trigger("focus")},25)})},openSearch:function(){var e=this;e.isOpen=!0,e.$elOverlay.removeClass("is-hidden"),o("body").addClass(e.classOverflowHidden),e.$elSearchInput.trigger("focus")},closeSearch:function(){var e=this;e.isOpen=!1,e.dataResponseObj={},e.$elOverlay.addClass("is-hidden"),o("body").removeClass(e.classOverflowHidden),e.clearResults(),e.searchTerm="",e.$elSearchInput.val(""),e.$elSearchBtn.trigger("focus")},runRequest:function(){var s=this,a=s.searchTerm;function e(e){s.dataResponseObj={searchTerm:a,response:e},s.updateResults()}function t(){s.$elOverlay.removeClass("is-loading")}function r(){s.$elOverlay.addClass("is-loading"),o.ajax({url:window.berry_util.rootURL+"/wp-json/berry/v1/search?term="+encodeURIComponent(a),type:"GET"}).done(e).always(t)}a&&s.dataResponseObj.searchTerm!==a&&r()},updateResults:function(){var n,e=this,s=(e.dataResponseObj.searchTerm,e.dataResponseObj.response||[]);if(e.dataResponseObj.searchTerm!==e.searchTerm)return!1;if(!s.length)return e.clearResults(),o('<div role="alert"> No Results Found </div>').appendTo(e.$elSearchResults),!1;n=o('<ul role="listbox"></ul>'),s.forEach(function(e,s,a){var t=o("<li></li>"),r=o("<a></a>").attr("href",e.permalink);o("<div></div>").text(e.post_title).appendTo(r),r.appendTo(t),t.appendTo(n)}),e.clearResults(),n.appendTo(e.$elSearchResults)},clearResults:function(){this.$elSearchResults.off().empty().html(),this.dataResponseObj={}}};e.init(),window.moduleSearch=e})}(jQuery);