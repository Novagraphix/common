require(['jquery', 'jquery.cycle.lite'], function($) {
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
