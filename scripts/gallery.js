$(function() {
    var trace = function(o){ console.log(o); };
    var createGallery = function(sel) {
        $(sel).addClass('active');
        $('body').addClass('no-scroll').addClass('gallery');
        // return 
        if( !$(sel).hasClass('created') ) {
            $(sel).addClass('created');
            //
            var gallery = $('#gallery .big-picture');
            // 
            gallery.owlCarousel({
                // slideSpeed : 1000,
                items:1,
                nav:true,
                navText:false,
                navRewind : false,
                pagination:false,
                // pullDrag:false,
                // freeDrag:false,
                lazyLoad:true,
                dots:false,
                loop:true,
                callbacks:true,
                onInitialized: function(event){
                    // return
                    var items = $('#gallery .owl-item');
                    var cnt_rl = 0;
                    var html = '';
                    var itemcount = items.length-4;
                    for(var n = 0; n < items.length; n++) {
                        var item = items[n];
                        if(n===0) {
                            html = '<div class="cnt">' + (itemcount-1) + ' von ' + itemcount + '</div>';
                        }
                        else if (n===1) {
                            html = '<div class="cnt">' + itemcount + ' von ' + itemcount + '</div>';
                        }
                        else if (n===items.length-2) {
                            html = '<div class="cnt">' + 1 + ' von ' + itemcount + '</div>';
                        }
                        else if (n===items.length-1) {
                            html = '<div class="cnt">' + 2 + ' von ' + itemcount + '</div>';
                        }
                        else {
                            html = '<div class="cnt">' + (n-1) + ' von ' + itemcount + '</div>';
                        }
                        $(html).appendTo(item);
                        $(item).height($(document).height());
                        $('img', item).hide();
                        $(item).css({
                            backgroundImage:'url(' + $('img', item).data('src') + ')',
                            backgroundPosition:'center center',
                            backgroundRepeat:'no-repeat',
                            backgroundSize:'contain'
                        });
                    }
                    //;
                    if( $('html').hasClass('small') )
                        skel.plugins.layers.hide('navPanel');
                    // 
                    setTimeout(function(){
                        $(window).trigger("resize");
                    }, 500);
                    $(window).trigger("resize");
                },
                onDrag:function(e) {

                }
            });
            // gallery.on('load.owl.lazy', function(ev){
            //     trace(ev)
            //     trace('lazy load')
            // })
            gallery.on('loaded.owl.lazy', function(ev){
                // trace(ev)
                $('#gallery .big-picture').removeClass('loading').addClass('loaded');
            })
        }
    }
    // 

    $('.popup, #navPanel a').on('click', function(ev){
        ev.preventDefault();
        if($(this).data('rel') != undefined) {
            createGallery($(this).data('rel'));
        }
    });
    $('#gallery .close, #navPanel .scroll').on('click', function(ev){
        ev.preventDefault();
        $('#gallery').removeClass('active');
        $('body').removeClass('no-scroll').removeClass('gallery');
    });
    $(document).keyup(function(e) {
        if($('body').hasClass('gallery')) {
            if (e.keyCode === 27) {// escape key maps to keycode `27`
                $('#gallery .close').trigger('click')
            }
            if(e.keyCode === 32 || e.keyCode === 39) {
                $('#gallery .big-picture').trigger('next.owl.carousel');
            }
            if(e.keyCode === 37) {
                $('#gallery .big-picture').trigger('prev.owl.carousel');
            }
            // 32 = space
            // 39 = right
            // 37 = left
        }
    })

});