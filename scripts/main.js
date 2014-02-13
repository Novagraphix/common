$(function() {

    $('#cites').cycle({
        speed: 750
    });

    /* Window Scroll Events */
    $(window).scroll(function(){
    });

    /* Window Resize Events */
    $(window).resize(function() {
      //changeSize();
    });

    /*$('#kinofinder').hover(
        function() {
            $(this).text("DEMNÄCHST");
        }, function() {
            $(this).text("KINOFINDER");
    });*/

    $('#mobile-menu-button').sidr({
      name: 'sidr-main',
      source: '#menu'
    });

});
