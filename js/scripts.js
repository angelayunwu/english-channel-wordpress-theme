/**
 * English Channel Scripts
 *
 */

function loadTwitter(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = "//platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
    }
}

function removeTwitter(id) {
    jQuery('script[id=' + id + ']').remove(); // Remove the included js file
    jQuery('iframe.twitter-timeline').remove(); // Remove the timeline iframe
}

function addTwitter(options) {
    var linkStr = '<a class="twitter-timeline"';
    linkStr += (options.width) ? ' width="' + options.width + '"' : '';
    linkStr += (options.height) ? ' height="' + options.height + '"' : '';
    linkStr += (options.color) ? ' data-link-color="' + options.color + '"' : '';
    linkStr += (options.theme) ? ' data-theme="' + options.theme + '"' : '';
    linkStr += ' href="https://twitter.com/NYUEngChannel/english-channel-list" data-widget-id="431507761684164608">&nbsp;</a>';
    jQuery(linkStr).appendTo(options.element);
}

function showTwitter(id, options) {
    removeTwitter(id);
    addTwitter(options);
    loadTwitter(document, 'script', id);
}

jQuery(window).load(function() {

    jQuery('.dynamic-grid').masonry({
        itemSelector: '.brick',
        isAnimated: true,
        columnWidth: 1
    });
    if (jQuery(document).width() > 980) {
        showTwitter('twitter-wjs', {
            width: 320,
            height: jQuery(".home-top-left").height(),
            element: '.twitter-widget'
        });
    }

});


jQuery(document).ready(function() {
    jQuery(".entry-content").fitVids();

    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 200) {
            jQuery('.back-to-top').fadeIn(200);
        } else {
            jQuery('.back-to-top').fadeOut(200);
        }
    });
    jQuery('.back-to-top').click(function() {
        event.preventDefault();
        jQuery('body').animate({
            scrollTop: 0
        }, 300);
    });
    jQuery('.flexslider').flexslider({
        animation: "fade",
        directionNav: false
    });
    var nav = responsiveNav(".menu-top-navigation-container", {
        insert: "before"
    });
    jQuery('.searchB').click(function(event) {
        event.preventDefault();
        if (jQuery('input.field').hasClass('open')) {
            jQuery('input.field').removeClass('open');
            // jQuery('.site-description').fadeIn();
            // chose this over fadeIn so as to not disrupt layout
            jQuery('.site-description').animate({
                opacity: 1
            });
            console.log("case a");
            jQuery('.modal_underlay').remove();
        } else {
            jQuery('input.field').addClass('open');

            jQuery('input.field').focus();
            // Modal blocker
            if (jQuery(this).css("position") == "absolute") {
                var modal_underlay = jQuery('<div class="modal_underlay"></div>');

                jQuery(modal_underlay).prependTo('.header-r-hold');
                jQuery(modal_underlay).css({
                    // "position": "absolute",
                    // "width": "100%",
                    "height": jQuery(document).height(),
                    // "z-index": "10",
                    // "top": "-8px",
                    // "background-color": "rgba(20,20,20,.8)",


                });
                // jQuery(modal_underlay).animate({
                //     opacity: 0.5
                // }, 5000);

            }

            //
            jQuery('.site-description').animate({
                opacity: 0
            });
            console.log("case b");
        }
    });

    if (jQuery('body').hasClass('events-gridview')) {
        jQuery(tribe_ev.events).on("tribe_ev_ajaxSuccess", function() {
            jQuery('.page-title').html(jQuery('.tribe-events-page-title').html());

        });
    }


    // jQuery(window).resize(_.debounce(function() {

    //     console.log("debounce");
    //      jQuery('.flexslider').flexslider({
    //     animation: "slide",
    //     directionNav: false, 
    //      width: 200,
    //     after: function(){
    //         jQuery('.flexslider').data('flexslider').resize();
    //     }
    // });
    //     //  
    // }, 1000));


});