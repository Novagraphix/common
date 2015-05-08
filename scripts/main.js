$(function() {
    var trace = function(o){ console.log(o); };
    //
    var docElem = window.document.documentElement,
        win = { width : getViewport('x'), height : getViewport('y') };

    /* Window Scroll Events */
    $(window).scroll(function(){
    });

    /* Window Resize Events */
    $(window).resize(function() {
        win.width = getViewport('x');
        win.height = getViewport('y');
        if(win.width < win.height) {
            if(!$('body').hasClass('portrait')) {
                $('body').addClass('portrait');
            }
            if($('body').hasClass('landscape')) {
                $('body').removeClass('landscape');
            }
        } else {
            if($('body').hasClass('portrait')) {
                $('body').removeClass('portrait');
            }
            if(!$('body').hasClass('landscape')) {
                $('body').addClass('landscape');
            }
        }

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
        //trace($('html').data('config'))
        $('#preloader').delay(500).fadeOut(500, function() { $(this).remove(); });
        //
        $(window).trigger("resize");
    });

    $(window).on("orientationchange", function() {
        $(window).trigger("resize");
    });

    /*
    $('#kinofinder, #filmwecker').click(function(event) {
        event.preventDefault();
    });

    $('#kinofinder').hover(
        function() {
            $(this).text("DEMNÄCHST");
        }, function() {
            $(this).text("KINOFINDER");
    });

    $('#filmwecker').hover(
        function() {
            $(this).text("DEMNÄCHST");
        }, function() {
            $(this).text("Filmwecker");
    });
    */

});
