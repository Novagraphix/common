/**
 * ytOverlay jQuery Plugin
 *
 */
;( function( $, window ) {

  $.fn.ytOverlay = function( options ) {

    var $this = $(this),
        docElem = window.document.documentElement,
        win = { width : getViewport('x'), height : getViewport('y') };

    // Settings
    var settings = $.extend({
        youtubeID : '',
        trigger : 'trailer',
        top : '100',
        right : '100',
        bottom : '100',
        left : '100',
        overlayAlpha : '0.7',
        overlayColor : '0,0,0'
    }, options );

    var url = '//www.youtube.com/embed/'+settings.youtubeID+'?rel=0',
        url_autoplay = '//www.youtube.com/embed/'+settings.youtubeID+'?rel=0&autoplay=1';

    function init() {
      $('body').append('<div id="overlay_'+settings.trigger+'"><iframe id="ytvideo_'+settings.trigger+'" src="'+url+'" frameborder="0" allowfullscreen></iframe><div id="close_'+settings.trigger+'"><img src="images/cross.png" alt=""></div>');
      var overlay_styles = {
        "display" : "none",
        "position" : "fixed",
        "top" : "0",
        "left" : "0",
        "width" : "100%",
        "height" : "100%",
        "background-color" : "rgba("+settings.overlayColor+","+settings.overlayAlpha+")",
        "z-index" : "1000"
      }
      $('#overlay_'+settings.trigger).css(overlay_styles);
      var close_styles = {
        "cursor" : "pointer",
        "position" : "absolute",
        "top" : "15px",
        "right" : "15px"
      }
      $('#close_'+settings.trigger).css(close_styles);
    }

    init();

    /* Window Resize Events */
    $(window).resize(function() {
        win.width = getViewport('x');
        win.height = getViewport('y');
        $('#ytvideo_'+settings.trigger).height(win.height-settings.top-settings.bottom).width(win.width-settings.right-settings.left).css({'marginLeft' : settings.left+'px', 'marginTop' : settings.top+'px', 'marginRight' : settings.right+'px', 'marginBottom' : settings.bottom+'px'});
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

    $('#'+settings.trigger).click(function(event) {
        event.preventDefault();
        $('#overlay_'+settings.trigger).fadeIn();
        $('#ytvideo_'+settings.trigger).attr({
            src: url_autoplay
        });
    });

    $('#close_'+settings.trigger).click(function(event) {
        event.preventDefault();
        $('#overlay_'+settings.trigger).fadeOut();
        $('#ytvideo_'+settings.trigger).attr({
            src: url
        });
    });


  };
}( jQuery, window, undefined ));