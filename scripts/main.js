require(['jquery', 'jquery.cycle.lite'], function($) {
    $(function() {

        /**
         * Mobile Detection
         * @type {Object}
         */
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };

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

        $('#kinofinder').hover(
            function() {
                $(this).text("DEMNÄCHST");
            }, function() {
                $(this).text("KINOFINDER");
        });

        /**
         * Kinostartautomatismus
         */
        if(Math.floor(new Date().getTime()/1000)>1373493660) {
            $('#kinostart h1').text("Jetzt im Kino!")
        }

    });

});
