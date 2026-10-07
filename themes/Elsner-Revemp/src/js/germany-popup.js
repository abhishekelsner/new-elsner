/*window.onload = function() {
    jQuery(document).ready(function($) {
        // Make an AJAX request to check if the visitor is from Germany
        $.ajax({
            type: 'POST',
            url: germany_popup_ajax.germany_ajaxurl, 
            data: {
                action: 'check_germany_visitor',
            },
            success: function(response) {
                console.log(response, "testhello");
                if (response === 'true') {
                    $('#germany-popup').modal('show');
                }
            },
        });
    });
};
*/

jQuery(window).on('load', function(){
    if( jQuery("#germany-popup").length || jQuery("#elsner-popup").length ){
        jQuery.ajax({
            type: 'POST',
            url: germany_popup_ajax.germany_ajaxurl, 
            data: {
                action: 'check_germany_visitor',
            },
            success: function(response) {
                console.log(response);
                if( response == 'true' ){
                    jQuery(document).ready(function(){setTimeout(function(){jQuery("#germany-popup").modal("show")},12e3)});
                }else if( response == 'false' ){
                    jQuery(document).ready(function(){setTimeout(function(){jQuery("#elsner-popup").modal("show")},12e3)});
                }
            },
        });
    }
});