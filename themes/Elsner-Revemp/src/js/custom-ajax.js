jQuery(document).ready(function (t) {
	var e = 2,
		a = !1,
		o = "all";
	var offset = 0;
	function n(o, n) {
		if (!a) {
			a = !0;

			// ✅ Collect all currently displayed post IDs
			var excludedIDs = [];
			console.log("hello test");
			jQuery("#" + o + " .service-blog-wrapper .row .blog-card").each(function () {
				var id = jQuery(this).data("post-id");
				if (id) excludedIDs.push(id);
				console.log(id);
				console.log("hello test");
			});

			var r = {
				action: "load_more_blogs",
				page: e,
				nonce: elsner_ajax_data.nonce,
				termID: o,
				search: n,
				excluded_ids: excludedIDs, // ✅ send excluded post IDs
			};

			t.ajax({
				url: elsner_ajax_data.elsner_url,
				method: "POST",
				data: r,
				beforeSend: function () {
					t(".load-more-button")
						.text("Loading...")
						.attr("disabled", "disabled");
				},
				success: function (a) {
					console.log("✅ Load more success");
					t("#" + o + " .service-blog-wrapper .row:last").append(a);
					e += 1;
				},
				complete: function () {
					a = !1;
					t("#" + o + " .view-all .btn-primary").removeClass("loading");
					if (n !== "" && n !== undefined) {
						t(".load-more-button").text("View more blogs: " + n);
					} else {
						t(".load-more-button").text("View more blogs");
					}
					t(".load-more-button").removeAttr("disabled");
				},
			});
		}
	}

	t(".nav-link").on("shown.bs.tab", function () {
		"#all" === t(this).attr("href") ? t(".view-all-tab").show() : t(".view-all-tab").hide();
	}),
		t(".nav-link").on("click", function (a) {
			var r = t(this).data("tab-id"),
				l = t(this).data("search");
			o !== r && ((o = r), (e = 1), n(r, l));
		}),
		t(".load-more-button").on("click", function (e) {
			e.preventDefault();
			var a = t(this).data("search");
			n(t(this).data("term-id"), a);
		});
	var r = t(".search-form"),
		l = t(".me-2"),
		i = (t(".blog-page-list .row:first"), t(".loader"));
	t(".load-more-button"),
		r.on("submit", function (e) {
			e.preventDefault();
			// Extract the cleanedHref value
			const activeLink = jQuery(".blog-search-head > ul#search_query_selector > li > a.active");
			const href = activeLink.attr("href");
			const cleanedHref = href ? href.replace("#", "") : "";

			const activeLinkdrop = jQuery("ul#search_query_selector>li>div.dropdown-menu>a.active");

			// Get the 'href' value and remove the hash (#)
			const hrefdrop = activeLinkdrop.attr("href");
			const dropdown = hrefdrop ? hrefdrop.replace("#", "") : "";
			(function (e, a) {
				i.show();
				t.ajax({
					url: elsner_ajax_data.elsner_url,
					type: "POST",
					data: { action: "search_blog_posts", search: e, href: cleanedHref, hrefdrop: dropdown },
					beforeSend: function () {
						//t(".service-blog-wrapper .row").empty(), t(".latest-blog-box").empty();
					},
					success: function (o) {
						if (e != "" && o != '<div class="not_found">No posts found</div>') {
							jQuery(".service-blog-wrapper .latest-blog-box").slideUp();
						} else {
							jQuery(".service-blog-wrapper .latest-blog-box").slideDown();
						}
						i.hide(), t("#" + a + " .service-blog-wrapper .row:last").html(o), t("#" + a + " .load-more-button").attr("data-search", e), t("#" + a + " .load-more-button").html("View More Blogs" + e), t(o).hasClass("not_found") ? t("#" + a + " .load-more-button").hide() : t("#" + a + " .load-more-button").show();
					},
					error: function (t, e, a) {},
				});
			})(l.val(), t(".tab-content .tab-pane.active").attr("id"));
		});
	var s = 6;
	parseInt(elsner_ajax_data.totalPosts),
		parseInt(elsner_ajax_data.totalPostsClutch),
		t("#load-more-button").on("click", function (e) {
			e.preventDefault();
			var a = t(this),
				o = a.data("term"),
				n = a.data("posttype"),
				r = a.data("taxonomy"),
				l = t(".filter-content .row .col-md-6").length,
				i = { action: "load_more_posts", term_slug: o, post_type: n, taxonomy: r, offset: l };
			t.ajax({
				url: elsner_ajax_data.elsner_url,
				type: "POST",
				data: i,
				beforeSend: function () {
					a.text("Loading..."), a.attr("disabled", "disabled");
				},
				success: function (e) {
					var o = t(e);
					t(".filter-content .row").append(o), (l += 6), o.length < 6 && a.hide();
				},
				error: function () {
					a.text("Error");
				},
				complete: function () {
					a.text("Load More"), a.removeAttr("disabled");
				},
			});
		}),
		t(".load-more-event").on("click", function (e) {
			e.preventDefault();
			var a = t(this);
			if (a.hasClass("disabled")) {
				return; // Do nothing if the button is already disabled
			}
			var o = a.data("term"),
				n = a.data("posttype"),
				r = a.data("taxonomy"),
				l = t(".life_gallary .life-gallery-block").length,
				i = { action: "load_more_events", term_slug: o, post_type: n, taxonomy: r, offset: l };

			a.text("Loading...").addClass("disabled");

			t.ajax({
				url: elsner_ajax_data.elsner_url,
				type: "POST",
				data: i,
				beforeSend: function () {
					a.text("Loading...").addClass("disabled");
				},
				success: function (e) {
					var o = t(e);
					o.imagesLoaded(function () {
						t(".life_gallary").append(o).masonry("appended", o).masonry("layout");
						setTimeout(function () {
							GLightbox({
								loop: false,
								selector: ".glightbox",
								openEffect: "zoom",
								closeEffect: "fade",
								startAt: 0,
								closeOnOutsideClick: false,
								zoomable: true,
								height: "auto",
								icons: {
									close: '<i class="fa fa-times"></i>',
									zoom: '<i class="fa fa-search-plus"></i>',
									zoomOut: '<i class="fa fa-search-minus"></i>',
								},
							});
							a.text("Load More Events").removeClass("disabled");
						}, 100);
					});
					l += 6;
					if (o.length < 6) {
						a.hide();
					}
				},
				error: function () {
					a.text("Error");
				},
				complete: function () {},
			});
		}),
		t("#load-more-button-solution").on("click", function (e) {
			e.preventDefault();
			var a = t(this),
				o = a.data("term"),
				n = t(".filter-content .row .col-md-6").length,
				r = { action: "load_more_posts_solution", term_slug: o, offset: n };
			t.ajax({
				url: elsner_ajax_data.elsner_url,
				type: "POST",
				data: r,
				beforeSend: function () {
					a.text("Loading..."), a.attr("disabled", "disabled");
				},
				success: function (e) {
					var o = t(e);
					t(".filter-content .row").append(o), (n += 6), o.length < 6 && a.hide();
				},
				error: function () {
					a.text("Error");
				},
				complete: function () {
					a.text("Load More"), a.removeAttr("disabled");
				},
			});
		}),
		t(".load_testimonials").click(function (e) {
			e.preventDefault();

			var a = t(this),
				o = { action: "load_more_testimonials", offset: s };
			t.ajax({
				url: elsner_ajax_data.elsner_url,
				type: "POST",
				data: o,
				beforeSend: function () {
					a.text("Loading..."), a.attr("disabled", "disabled");
				},
				success: function (e) {
					var o = t(e);
					if (o.length === 0 || o.hasClass("not_found")) {
						t(".testimon_tab .grid-container2").after('<div class="not_found">No more testimonials found.</div>');
						a.hide();
					} else {
						o.imagesLoaded(function () {
							t(".testimon_tab .grid-container2").append(o).masonry("appended", o);
						});
						s += 6;
					}
				},
				error: function () {
					a.text("Error");
				},
				complete: function () {
					a.text("LOADING TESTIMONIALS"), a.removeAttr("disabled");
				},
			});
		}),
		t(".load_clutch_reviews").click(function (e) {
			e.preventDefault();
			var a = t(this),
				o = { action: "load_more_clutch_reviews", offset: s };
			t.ajax({
				url: elsner_ajax_data.elsner_url,
				type: "POST",
				data: o,
				beforeSend: function () {
					a.text("Loading..."), a.attr("disabled", "disabled");
				},
				success: function (e) {
					var $response = t(e);
					if ($response.length === 0) {
						t(".testimon_tab .clutch-review").after('<div class="not_found">No more reviews found.</div>');
						a.hide();
					} else {
						t(".testimon_tab .clutch-review").append($response);
						s += 6;
						if ($response.length < 6) {
							a.hide();
						}
					}
				},

				error: function () {
					a.text("Error");
				},
				complete: function () {
					a.text("LOADING REVIEWS"), a.removeAttr("disabled");
				},
			});
		});
});

jQuery(".blog-search-head .nav-tabs .nav-link, .blog-search-head .nav-tabs li.dropdown .dropdown-menu .dropdown-item").on("click", function () {
	jQuery(".tab-pane.active.show").hide();
	setTimeout(function () {
		jQuery("form.search-form").submit();
		jQuery(".tab-pane.active.show").show();
	}, 10);
});
