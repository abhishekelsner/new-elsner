jQuery(document).ready(function($) {

    console.log("Hello World");

    var currentPage   = 1;
    var maxPages      = 1;
    var currentFilter = 'all';
    var isLoading     = false;
    var svgArrow = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';

    // ── Fetch max_pages for "all" on page load ─────────────────


    console.log("Hello World")
    $.ajax({
        url:  ajax_object.ajax_url,
        type: 'POST',
        data: {
            action:   'filter_news_by_category',
            category: 'all',
            paged:    1,
            nonce:    ajax_object.nonce
        },
        success: function(response) {
            if (response.success) {
                maxPages = parseInt(response.data.max_pages, 10);

                $('#all-sections-view .news-hub-section__cta').show();
            }
        }
    });

    // ── Tab click ──────────────────────────────────────────────
    $('.news-hub-tabs__item').on('click', function() {

        $('.news-hub-tabs__item').removeClass('is-active');
        $(this).addClass('is-active');

        var selectedFilter = $(this).data('filter');
        currentFilter      = selectedFilter;
        currentPage        = 1;
        maxPages           = 1;

        // Reset message
        $('#no-more-post-message').hide();

        $('#news-hub-main').removeClass('announcement latest-update');
        if (selectedFilter !== 'all') $('#news-hub-main').addClass(selectedFilter);

        if (selectedFilter === 'all') {
            $('#all-sections-view').addClass('sections-view--active');
            $('#filtered-view').removeClass('sections-view--active');

            $('#all-sections-view .btn-view-all')
                .html('Load More ' + svgArrow)
                .css({ 'pointer-events': '', 'opacity': '', 'cursor': '' });

            // Re-fetch max_pages
            $.ajax({
                url:  ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action:   'filter_news_by_category',
                    category: 'all',
                    paged:    1,
                    nonce:    ajax_object.nonce
                },
                success: function(response) {
                    if (response.success) {
                        maxPages = parseInt(response.data.max_pages, 10);

                        $('#all-sections-view .news-hub-section__cta').show();
                    }
                }
            });

            return;
        }

        // Switch to filtered view
        $('#all-sections-view').removeClass('sections-view--active');
        $('#filtered-view').addClass('sections-view--active');

        $('#filtered-view .btn-view-all')
            .html('Load More ' + svgArrow)
            .css({ 'pointer-events': '', 'opacity': '', 'cursor': '' });

        $('#filtered-title').text($(this).text().trim());
        $('#filtered-view .btn-view-all').data('category', selectedFilter);

        $('#filtered-content').html('<div class="loading-message">Loading...</div>');

        loadPosts(selectedFilter, 1, false);
    });

    // ── Load More button ───────────────────────────────────────
    $(document).on('click', '.btn-view-all', function(e) {
        e.preventDefault();

        if (isLoading) return;

        currentPage++;
        loadPosts(currentFilter, currentPage, true);
    });

    // ── Core AJAX function ─────────────────────────────────────
    function loadPosts(category, page, append) {
        if (isLoading) return;
        isLoading = true;

        var isAllTab = (category === 'all');
        var $content = isAllTab ? $('#all-sections-view .news-hub-all__grid') : $('#filtered-content');
        var $btn     = isAllTab ? $('#all-sections-view .btn-view-all') : $('#filtered-view .btn-view-all');
        var $btnWrap = isAllTab ? $('#all-sections-view .news-hub-section__cta') : $('#filtered-view .news-hub-section__cta');

        $btn.addClass('is-loading').html('Loading...');

        $.ajax({
            url:  ajax_object.ajax_url,
            type: 'POST',
            data: {
                action:   'filter_news_by_category',
                category: category,
                paged:    page,
                nonce:    ajax_object.nonce
            },
            success: function(response) {
                if (!response.success) {
                    if (!append && !isAllTab) {
                    var label = currentFilter.charAt(0).toUpperCase() + currentFilter.slice(1);
                    $content.html('<div class="no-posts-message"><p>No ' + label + ' Found.</p></div>');
                    }
                    $btnWrap.hide();
                    return;
                }

                var html     = response.data.html;
                maxPages     = parseInt(response.data.max_pages, 10);
                var newCount = parseInt(response.data.post_count, 10);

                if (append) {
                    $content.append(html);
                } else {
                    $content.html(html);
                }

                // ✅ FINAL LOGIC
                if (newCount === 0) {
                    $btnWrap.hide();
                    if (append) {
                        $('#no-more-post-message').fadeIn();
                    } else {
                        $('#no-more-post-message').hide();
                    }
                } else {
                    $('#no-more-post-message').hide();

            $btnWrap.show();
            $btn.removeClass('is-loading')
                .css({ 'pointer-events': '', 'opacity': '', 'cursor': '' })
                .html('Load More ' + svgArrow)
                        }
                    },
                    error: function() {
                        if (!append){
                        var label = currentFilter.charAt(0).toUpperCase() + currentFilter.slice(1);
                        $content.html('<div class="no-posts-message"><p>No ' + label + ' Found.</p></div>');
                        }
                        $btnWrap.hide();
                    },
                    complete: function() {
                        isLoading = false;
                    }
                });
            }

});