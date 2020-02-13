const observer = lozad('.lozad', {
    rootMargin: '10px 0px',

    threshold: 0.9,
    load: function (el) {
        el.src = el.dataset.src;
    }

});

observer.observe(); // observes newly added elements as well

// $(".list_post_home p a").addClass("category_content_list_link");