/*
    Widgets using by AppHills Inc.
    by ConciseTony liuxiaolong[at]apehills.com
    Requires: jQuery 1.7.1
    Created Date: 2011.1.15 midnight.
    Update Date: ...
    Version: 0.0.1
*/
(function(){
    var Slider,
        Viewer; 
    

    if( !window.$ && !window.jQuery ) {
        if( window.console ) 
            console.log( 'jQuery 1.7.1 is needed.' );
        return;
    }


    /*  slider
     *  version: 0.1
     */
    Slider = function( src, interval ) {
        var $as, $imgs;

        if( !src )
            return;

        src = $( src );

        this.$src = src; 
        this.$src.data( 'sliderObj', this );

        this.$srcIn = $( '[ah-role=sliderIn]', src ); 
        this.$srcIn.data( 'sliderObj', this );

        this.$items = $( '[ah-role=sliderItem]', src );
        this.$items.data( 'sliderObj', this );

        $as = $( 'a', src );
        $imgs = $( 'img', src );

        this.length = this.$items.length;
        this.interval = interval || 3500;
        this.cur = 1;
        this.curTranslateX = 0;
        this.unit = this.$items.outerWidth(true);
        this.isPause = false;
        this.isAutoMoving = false;
        this.isBeingDraged = false;
        this.timeoutId = 0;
        this.dragStartX = null;
        this.dragPreviousX = null;
        this.$srcIn.bind( 'webkitTransitionEnd', 'to-setup-isAutoMoving', this.onTransitionEnd );
        this.$srcIn.bind( START_EVENT, this.onTouchStart );
        this.$srcIn.bind( MOVE_EVENT, this.onTouchMove );
        this.$srcIn.bind( END_EVENT, this.onTouchEnd );

        /* $imgs.bind( START_EVENT, function(e){
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

            if( $src.data('_touched') && !moved )
                window.open( $src.attr('href') );
        }); */
    };

    Slider.prototype = {
        ratioDragChange: 0.15, // dragDistance/itemWidth for changing item

        next: function() {
            if( this.isPause )
                return;

            this.cur = (this.cur === this.length) ? 1 : this.cur + 1;
            this.curTranslateX = -( (this.cur - 1) * this.unit );
            this.isAutoMoving = true;
            this.$srcIn.css( '-webkit-transform', 'translate3d(' + this.curTranslateX + 'px,0,0)' );
        },

        play: function(){
            if( this.isPause )
                return;

            var me = this;
            me.next.call(me);
            me.timeoutId = setTimeout( function(){ me.play.call(me); }, me.interval );
        },

        pause: function(){
            this.isPause = true;
        },

        start: function(){
            var me = this;
            me.timeoutId = setTimeout( function(){ me.play.call(me); }, me.interval );
        },

        restart: function(){
            
        },

        onTransitionEnd: function(e) {
            $( this ).data( 'sliderObj' ).isAutoMoving = false;
        }, 

        onTouchStart: function(e) {
            var sliderObj = $( this ).data( 'sliderObj' ); 
            if( !sliderObj || sliderObj.isAutoMoving )
                return;

            sliderObj.isPause = true;
            sliderObj.isBeingDraged = true;
            clearTimeout( sliderObj.timeoutId );

            sliderObj.$srcIn.removeClass( 'slider-in-auto-eff' );
            sliderObj.$srcIn.addClass( 'slider-in-drag-eff' );

            var clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;

            sliderObj.dragStartX = clientX;
            sliderObj.dragPreviousX = clientX;
        },

        onTouchMove: function(e) {
            var sliderObj = $( this ).data( 'sliderObj' );
            if( !sliderObj || !sliderObj.isBeingDraged )
                return;
            
            var clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;
            var diff = clientX - sliderObj.dragPreviousX;


            sliderObj.curTranslateX += diff;
            sliderObj.$srcIn.css( '-webkit-transform', 'translate3d(' + sliderObj.curTranslateX + 'px,0,0)' );

            sliderObj.dragPreviousX = clientX;
        }, 

        onTouchEnd: function(e) {
            var sliderObj = $( this ).data( 'sliderObj' );
            if( !sliderObj || !sliderObj.isBeingDraged ) 
                return;

            sliderObj.isBeingDraged = false;

            sliderObj.$srcIn.removeClass( 'slider-in-drag-eff' );
            sliderObj.$srcIn.addClass( 'slider-in-auto-eff' );

            var clientX = sliderObj.dragPreviousX;

            if( clientX === sliderObj.dragStartX ) {
                sliderObj.isPause = false;
                sliderObj.start();
            }
            else {
                var totalDiff = clientX - sliderObj.dragStartX;
                if( Math.abs(totalDiff) > (sliderObj.ratioDragChange * sliderObj.unit) ) {
                    //change by item 
                    if( totalDiff <= 0 )
                        //go righter
                        sliderObj.cur = (sliderObj.cur === sliderObj.length) ? 1 : sliderObj.cur + 1;
                    else
                        //go lefter
                        sliderObj.cur = ( sliderObj.cur === 1 ) ? sliderObj.length : sliderObj.cur - 1;
                }
                sliderObj.curTranslateX = -( (sliderObj.cur - 1) * sliderObj.unit );
                sliderObj.$srcIn.bind( 'webkitTransitionEnd', function(e){
                    $( this ).unbind( e );

                    var sliderObj = $( this ).data( 'sliderObj' );
                    if( !sliderObj )
                        return;

                    sliderObj.dragStartX = null;
                    sliderObj.dragPreviousX = null;
                    sliderObj.isPause = false;
                    sliderObj.start();
                });

                sliderObj.$srcIn.css( '-webkit-transform', 'translate3d(' + sliderObj.curTranslateX + 'px,0,0)' );
            }
        }
    };



    // viewer
    // version 0.1
    // #note:
    //      显示容器的宽度必须是item宽度的整数倍
    var Viewer = function( src ) {
        var $as, $imgs;

        if( !src )
            return;

        src = $( src );

        this.$src = src;
        this.$src.data( 'viewerObj', this );

        this.$srcIn = $( '>.viewer-in', src );
        this.$srcIn.data( 'viewerObj', this );

        this.$items = $( '>.viewer-item', this.$srcIn );
        this.$items.data( 'viewerObj', this );

        $as = $( 'a', src );
        $imgs = $( 'img', src );

        this.length = this.$items.length;
        this.perLength = Math.floor( this.$src.width() / this.$items.outerWidth() );
        this.unit = this.$items.outerWidth();

        this.cur = 1; // current first item index
        this.maxIndex = ( this.length > this.perLength ) ? this.length - this.perLength + 1 : 1; // first left item( ui ) index max
        this.curTransitionX = 0;

        this.dragStartX = null;
        this.dragPreviousX = null;

        this.isBeingDraged = false;
        this.isReleasing = false;

        this.$srcIn.bind( 'webkitTransitionEnd', this.onTransitionEnd );
        this.$srcIn.bind( START_EVENT, this.onTouchStart );
        this.$srcIn.bind( MOVE_EVENT, this.onTouchMove );
        this.$srcIn.bind( END_EVENT, this.onTouchEnd );

        /* $imgs.bind( START_EVENT, function(e){
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

            if( $src.data('_touched') && !moved )
                window.open( $src.attr('href') );
        }); */
    };

    Viewer.prototype = {
        ratioDragChange: 0.2,

        onTransitionEnd: function(e) {
            var viewerObj;

            viewerObj = $( this ).data( 'viewerObj' );
            if( !viewerObj )
                return;

            viewerObj.isReleasing = false;
        },

        onTouchStart: function(e) {
            var viewerObj, clientX;

            viewerObj = $( this ).data( 'viewerObj' );
            if( !viewerObj || viewerObj.isReleasing )
                return;

            viewerObj.isBeingDraged = true;

            clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;
            viewerObj.dragStartX = clientX;
            viewerObj.dragPreviousX = clientX;

            viewerObj.$srcIn.removeClass( 'viewer-in-release-eff' );
            viewerObj.$srcIn.addClass( 'viewer-in-drag-eff' );
        },

        onTouchMove: function( e ) {
            var viewerObj, clientX, diff;

            viewerObj = $( this ).data( 'viewerObj' );
            if( !viewerObj || !viewerObj.isBeingDraged )
                return;

            clientX = DEBUG ? e.clientX : e.originalEvent.targetTouches[0].clientX;
            diff = clientX - viewerObj.dragPreviousX;

            viewerObj.curTransitionX += diff;

            viewerObj.$srcIn.css( '-webkit-transform', 'translate3d(' + viewerObj.curTransitionX + 'px,0,0)' );

            viewerObj.dragPreviousX = clientX;
        },

        onTouchEnd: function( e ) {
            var viewerObj, totalDiff, indexDiff;

            viewerObj = $( this ).data( 'viewerObj' );

            if( !viewerObj || !viewerObj.isBeingDraged )
                return;

            viewerObj.isBeingDraged = false;
            viewerObj.$srcIn.removeClass( 'viewer-in-drag-eff' );

            totalDiff = viewerObj.dragPreviousX - viewerObj.dragStartX; 
            if( totalDiff == 0 ) {
                //stay
                return;
            }
            else {
                viewerObj.isReleasing = true;
                viewerObj.$srcIn.addClass( 'viewer-in-release-eff' );

                indexDiff = -Math.round( totalDiff / (viewerObj.unit * viewerObj.ratioDragChange) );

                if( indexDiff != 0 ) {
                    // change by item

                    //ui range check
                    if( Math.abs(indexDiff) > viewerObj.perLength )
                        indexDiff = indexDiff > 0 ? viewerObj.perLength : -viewerObj.perLength;

                    //index range check
                    if( indexDiff + viewerObj.cur > viewerObj.maxIndex )
                        viewerObj.cur = viewerObj.maxIndex;
                    else if( indexDiff + viewerObj.cur < 1 )
                        viewerObj.cur = 1;
                    else 
                        viewerObj.cur += indexDiff;
                }

                viewerObj.curTransitionX = - ( viewerObj.cur - 1 ) * viewerObj.unit;
                viewerObj.$srcIn.css( '-webkit-transform', 'translate3d(' + viewerObj.curTransitionX + 'px,0,0)' );
            }
        }
    };


    //expose
    window.AH = window.AH || {};
    window.AH[ 'Slider' ] = Slider;
    window.AH[ 'Viewer' ] = Viewer;
})();
