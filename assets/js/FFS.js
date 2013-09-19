(function(){
    var FFS = {
        InitHeaderImgs:function(){
            var jColl = $('.ffs-header-img-holder');
            jColl.each(
                function(){
                    $(this).on('mouseenter',
                        function(){
                            FFS.ShowActivateImg(this);
                        }
                    );
                }
            )
            var jEle = jColl[0];
            FFS.ShowActivateImg(jEle);

        },
        ShowActivateImg:function(jEle){
            jEle = $(jEle);
            var jInfo = jEle.find('.ffs-header-info-holder');

            jInfo.animate({top:'0Px'});


            var jActive = $('.ffs-header-active .ffs-header-info-holder');
            if(jActive.length > 0){
                jActive.animate({top:'-450Px'});
                jActive.parent().removeClass('ffs-header-active');
            }
            //Got to do this at the end or it gets picked up by the above lines
            jEle.addClass('ffs-header-active');
        },
        CtlSaveState:function(){
            //Load all ctls by css class
            FFS.Data = {
                Ctls:{},
                EntiyData:{}
            };
        },
        CtlSetEntityCollection:function(objData){
            //if local storage use local storage

            //if local storage use cookies
        },
        CtlLoadSaveState:function(){

        },
        InitCtlMemory:function(){
            $(document).on('mjax-load-start', function(){
                var jLoader = $('#ffs-loader');
                jLoader.css('display', 'block');
                var jBar = $(jLoader.find('.bar'));
                jBar.css('width','5%');
                jBar.removeClass('bar-danger');
                jBar.animate(
                    {
                        'width':'100%'
                    },
                    5000,
                    function(){
                        //This is not good

                    }
                );

            });
            $(document).on('mjax-page-load', function(){
                var jLoader = $('#ffs-loader');
                var jBar = $(jLoader.find('.bar'));
                jBar.addClass('bar-success');
                jBar.stop().animate(
                    {
                        'width':'100%'
                    },
                    500,
                    function(){
                        //This good
                        $('#ffs-loader').fadeOut();

                        jBar.removeClass('bar-success');

                    }
                );
            });
            $(document).on('mjax-load-error', function(){
                var jLoader = $('#ffs-loader');
                var jBar = jLoader.find('.bar');
                jBar.addClass('bar-danger');
                jBar.stop().animate(
                    {
                        'width':'100%'
                    },
                    1000,
                    function(){
                        $('#ffs-loader').fadeOut();
                    }
                );
            });
            $(window).unload(
                function(e){
                    //Get all ctl values with certain CSS CLASS
                }
            );

        },
        InitScreenRotation:function(){
            // Detect whether device supports orientationchange event, otherwise fall back to
            // the resize event.
            var supportsOrientationChange = "onorientationchange" in window,
                orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";

            window.addEventListener(orientationEvent, function() {
                FFS.TestScreenRotation();
            }, false);

            FFS.TestScreenRotation();
        },
        TestScreenRotation:function(){
            if(typeof(window.orientation) != 'undefined'){
                if(window.orientation != 90){
                    MJax.BS.Alert('This page is best viewed in the landscape orientation. Please rotate your mobile device 90 degrees');
                }else{
                    MJax.BS.HideAlert();
                }
            }
        }
    };

    window.FFS = FFS;
})(window);