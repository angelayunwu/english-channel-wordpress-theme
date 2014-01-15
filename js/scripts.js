/**
 * English Channel Scripts
 *
 */

jQuery(window).load(function(){
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

jQuery(document).ready(function(){
    jQuery(".entry-content").fitVids();

    jQuery(window).scroll(function() {
        if( jQuery(this).scrollTop() > 200 ) {
            jQuery('.back-to-top').fadeIn(200);
        }
        else {
            jQuery('.back-to-top').fadeOut(200);
        }
    });
    jQuery('.back-to-top').click(function() {
        event.preventDefault();
        jQuery('body').animate({scrollTop: 0}, 300);
    });
    jQuery('.flexslider').flexslider({
        animation: "slide",
        directionNav: false
    });
    var nav = responsiveNav(".menu-top-navigation-container",
        {
            insert: "before"
        });

});