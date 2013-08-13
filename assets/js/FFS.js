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
        }
    };

    window.FFS = FFS;
})(window);