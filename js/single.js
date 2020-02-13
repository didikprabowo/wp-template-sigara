    const observer = lozad('.lozad', {
        threshold: 0.9,
        load: function (el) {
            el.src = el.dataset.src;
        }
    });
    observer.observe(); // observes newly added elements as well

    window.onscroll = function () {
        var doc = document.documentElement;
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
        if (top <= 99) {
            document.getElementsByName("left-sticky-detail").style.display = 'none';
        } else {
            document.getElementsByName("left-sticky-detail").style.display = "block";
        }
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
            document.getElementsByName("left-sticky-detail").style.display = 'none';
        }
    }