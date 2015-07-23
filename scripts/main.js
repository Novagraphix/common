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
        $('#preloader').delay(1000).fadeOut(800, function() { 
            $(this).remove(); 
            $('body').addClass('loaded');
         });
        //
        $(window).trigger("resize");
    });

    $(window).on("orientationchange", function() {
        $(window).trigger("resize");
    });


    if( $('.btn_modal').length > 0 ) {

        var modals = $('.btn_modal');
        var cont = $('<div id="modals"></div>').appendTo('body');
        $.each(modals, function(n){
            var id = $(this).data('rel').substr(1);
            var tpl = 'templates/elements/' + id + '.html';
            var jqxhr = $.ajax({
                dataType: 'text',
                url: tpl
            }).done(function( html ) {
                cont.append( html )
            })
            .fail(function() {
                trace('"' + tpl + '" failed to load ' )
            });
        })

        $('a.btn_modal').on('click', function(ev){
            ev.preventDefault();
            var rel = $(this).data('rel');
            $(rel).fadeIn();
            $(rel + ' .modal_bg, ' + rel + ' .close').off().on('click', function(ev){
                ev.preventDefault();
                $(rel).fadeOut();
            });
        });
    }

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
