$(function() {

    var docElem = window.document.documentElement,
        win = { width : getViewport('x'), height : getViewport('y') };

    /* Window Scroll Events */
    $(window).scroll(function(){
    });

    /* Window Resize Events */
    $(window).resize(function() {
        win.width = getViewport('x');
        win.height = getViewport('y');


    }).trigger('resize');

    function getViewport(axis) {
        var client, inner;
        if( axis === 'x' ) {
            client = docElem['clientWidth'];
            inner = window['innerWidth'];
        }
        else if( axis === 'y' ) {
            client = docElem['clientHeight'];
            inner = window['innerHeight'];
        }

        return client < inner ? inner : client;
    }

    $(window).load(function() {
        $('#sitePreloader').delay(200).fadeOut(100, function() {
            $(this).remove();
        });

        $(window).trigger("resize");
    });

    $(window).on("orientationchange", function() {
        $(window).trigger("resize");
        //window.location.href = "index.html";
    });

    /*$('#kinofinder').hover(
        function() {
            $(this).text("DEMNÄCHST");
        }, function() {
            $(this).text("KINOFINDER");
    });*/

    /*$('#mobile-menu-button').sidr({
      name: 'sidr-main',
      source: '#menu'
    });*/

});
