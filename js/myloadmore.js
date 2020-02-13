jQuery(function ($) {
    var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
        bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

    $(window).scroll(function () {
        var data = {
            'action': 'loadmore',
            'query': misha_loadmore_params.posts,
            'page': misha_loadmore_params.current_page
        };
        if ($(document).scrollTop() > ($(document).height() - bottomOffset) && canBeLoaded == true) {

            $.ajax({
                url: misha_loadmore_params.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    canBeLoaded = false;
                },
                success: function (data) {
                    if (data) {
                        $('.list_post_home').append(data) // where to insert posts
                        canBeLoaded = true; // the ajax is completed, now we can run it again
                        misha_loadmore_params.current_page++;
                        const observer = lozad('.lozad', {
                            rootMargin: '10px 0px',
                            threshold: 0.9,
                            load: function (el) {
                                el.src = el.dataset.src;
                            }
                        });

                        observer.observe(); // observes newly added elements as well
                    }
                }
            });
        }
    });
});