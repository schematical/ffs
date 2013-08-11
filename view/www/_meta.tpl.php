<?php if($this instanceof MJaxWAdminForm){ ?>
    <?php require(__MJAX_WADMIN_THEME_CORE_VIEW__ . '/_meta.tpl.php'); ?>
    <style>
        .margin-bottom-25{
            margin-bottom: 25Px;
        }
        .row-fluid input, .row-fluid select{
            padding: 20Px;
            font-size: 16Pt;
            line-height: 30Px;
            width:90%;
        }
        @media (min-width: 1200px) {
            .ParentMessageEditPanel_btnSave{
                margin-top:-10Px;
                padding:7Px;
            }
        }
    </style>
<?php }else{ ?>
    <?php require(__MJAX_GENTA_THEME_CORE_VIEW__ . '/_meta.tpl.php'); ?>
    <style>
        #divMessage{
            font-weight: bold;
            font-size: 23Pt;
            padding-top: 3Px;
        }
        #pnlMessage h5{
            font-size:20Pt;
            float:left;
            margin-right:15Px;
        }
        #pnlMessage p{
            font-size:20Pt;
            float:left;
            margin-top:10Px;
            line-height: 1.5;
        }
    </style>
    <script>
        MJax.fullscreenNavTimeout = null;
        MJax.HideFullscreenNav = function(){
            if(MJax.fullscreenNavTimeout == null){
                clearInterval(MJax.fullscreenNavTimeout);

                MJax.fullscreenNavTimeout = setTimeout(
                    function(){

                        var jFooter = $('#divFooter');
                        jFooter.attr('data-height', jFooter.height());
                        jFooter.animate({'height':'0Px'});
                        MJax.fullscreenNavTimeout = null;
                    },
                    5000
                );
            }
        }
        $(function(){
            $('body').on('mousemove',
                function(e){
                    //alert("HIT");
                    if(MJax.fullscreenNavTimeout == null){
                        var jFooter = $('#divFooter');
                        jFooter.animate({'height':jFooter.attr('data-height')});
                        MJax.HideFullscreenNav();
                    }
                }

            );
            MJax.HideFullscreenNav();
        });
    </script>
<?php } ?>