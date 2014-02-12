/**
 * English Channel Scripts
 *
 */

jQuery(window).load(function() {
    jQuery('.dynamic-grid').masonry({
        itemSelector: '.brick',
        isAnimated: true,
        // columnwidth: 10,
        // width: '.hentry' 
        // isFitWidth: true,
        // columnWidth: function( containerWidth ) {
        //  return containerWidth / 3;
        //   }
        columnWidth: 1
    });

    jQuery('.dynamic-grid').masonry({
        itemSelector: '.brick2',
        isAnimated: true,
        // columnwidth: 10,
        // width: '.hentry' 
        // isFitWidth: true,
        // columnWidth: function( containerWidth ) {
        //  return containerWidth / 3;
        //   }
        columnWidth: 1
    });


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
      //  , width: 200,
      //  after: function(){
       //     jQuery('.flexslider').width(jQuery( document ).width());
       //     jQuery('.flexslider').data('flexslider').resize(300);
       // }
    });
    var nav = responsiveNav(".menu-top-navigation-container", {
        insert: "before"
    });

    ///
    jQuery('.searchB').click(function() {
        event.preventDefault();
        if (jQuery('input.field').hasClass('open')) {
            jQuery('input.field').removeClass('open');
            jQuery('.site-description').fadeIn();
        } else {
            jQuery('input.field').addClass('open');
            jQuery('input.field').focus();
            jQuery('.site-description').fadeOut();

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