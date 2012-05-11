/*
    Index script.
    By: ConciseTony liuxiaolong[at]apehills.com
    Requires: jQUery 1.7.1
*/

var DEBUG = document.ontouchstart === undefined;

var START_EVENT = DEBUG ? 'mousedown' : 'touchstart',
    MOVE_EVENT = DEBUG ? 'mousemove' : 'touchmove',
    END_EVENT = DEBUG ? 'mouseup' : 'touchend';


(function(){
    //global
    var $refWrap,
        $refSlider,
        $refSliderIn,
        $refViewer,
        $refViewerIn;

    //base init
    window.scroll( 0, 0 );
    $( 'html' ).css( 'zoom', $(window).height() / 960.0 );
    $( 'html' ).bind( 'touchmove', function(e){
        e.preventDefault();
    });

    $(function(){
        //cache ref
        $refWrap = $( '#wrap' );
        $refSlider = $( '#slider' );
        $refSliderIn =$( '#sliderIn' );
        $refViewer = $( '#viewer' );
        $refViewerIn = $( '#viewerIn' );

        // tmp
        $( '.btn-close' ).click(function(){
            window.close();
        });

        $imgs = $( 'img' );
        $as = $( 'a' );

        $imgs.bind( START_EVENT, function(e){
            e.preventDefault();
        });
        $as.bind( 'click', function(e){
            e.preventDefault();
        });

        $as.bind( START_EVENT, function(e){
            var $src, clientX;

            e.preventDefault();

            $src = $( this );

            clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;

            $src.data( '_touched', true );
            $src.data( '_touch_start_x', clientX );

            $( document ).bind( END_EVENT, function(e){
                $src.data( '_touched', false );

                $src.removeData( '_touch_start_x' );
                $src.removeData( '_touch_previous_x' );

                $( document ).unbind( e );
            });
        });

        $as.bind( MOVE_EVENT, function(e){
            var $src, clientX;

            $src = $( this );


            if( $src.data('_touched') ) {
                clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;
                $src.data( '_touch_previous_x', clientX );
            }
        });

        $as.bind( END_EVENT, function(e){
            var $src, 
                start,  //start touch position of src
                pre,    //previous touch position of src
                moved;  //eventually figure out whether the src has been moved or not

            $src = $( this );

            start = $src.data( '_touch_start_x' );
            pre = $src.data( '_touch_previous_x' );

            moved = typeof pre != 'undefined'
                        && typeof start != 'undefined'
                        && Math.abs( pre - start ) > 2;

            if( $src.data('_touched') && !moved && $src.attr('href').indexOf('javascript:void') < 0 )
                window.open( $src.attr('href') );
        });



        //init slider
        var slider = new AH.Slider( $refSlider ); 
        slider.start();


        //init viewer
        var viewer = new AH.Viewer( $refViewer );


        $( '#loading' ).fadeOut( 'slow' );
    });
})();
