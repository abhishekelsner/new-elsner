jQuery(document).ready(function($) {
    var postsPerPage = 3;
    var page = 1;
    var currentCategory = 'all';

    // First load
    loadPosts();

    // Filter click
    $(document).on('click', '.category-filter', function(e) {
        e.preventDefault();
        $('.category-filter').removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).data('slug');
        page = 1;

        $('#posts-container').html('<div class="loading">Loading...</div>');
        loadPosts();
    });

    // Load more
    $(document).on('click', '#load-more', function(e) {
        e.preventDefault();
        page++;
        loadPosts();
    });

    function loadPosts() {
        $.ajax({
            url: portfolio_ajax.ajax_url, // ✅ comes from wp_localize_script
            type: 'POST',
            data: {
                action: 'filter_portfolio_case_study',
                term: currentCategory,
                page: page,
                posts_per_page: postsPerPage
            },
            success: function(response) {
                if (page === 1) {
                    $('#posts-container').html(response);
                } else {
                    $('#posts-container').append(response);
                }

                if ($.trim(response) === '') {
                    $('#load-more').hide();
                } else {
                    $('#load-more').show();
                }
            }
        });
    }

});
