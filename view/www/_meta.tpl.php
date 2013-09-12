<?php if($this instanceof MJaxWAdminForm){ ?>
    <?php require(__MJAX_WADMIN_THEME_CORE_VIEW__ . '/_meta.tpl.php'); ?>
    <link href="<?php echo __MJAX_WADMIN_THEME_ASSET_URL__ . '/css'; ?>/pages/pricing.css" rel="stylesheet">
    <link href="<?php echo __MJAX_WADMIN_THEME_ASSET_URL__ . '/css'; ?>/pages/plans.css" rel="stylesheet">

    <style>
        .margin-bottom-25{
            margin-bottom: 25Px;
        }
        .row-fluid input, .row-fluid textarea{
            padding: 20Px;
            font-size: 16Pt;
            line-height: 30Px;
            width:90%;
        }
        .row-fluid select{

            font-size: 16Pt;
            line-height: 30Px;
            width:90%;
            height: 38Px
        }

        .row-fluid .input-prepend .add-on:first-child{
            padding: 20Px;
            font-size: 14Pt;
        }
        .row-fluid label{
            font-size: 17Pt;
            margin-top: 14Px;
        }
        .ffs-header-img-holder{
            border:thin grey solid;
            margin-bottom:10Px;
            position: relative;

            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            border-radius: 12px;
            overflow:hidden;
        }
        .ffs-header-img-holder img{
            width:100%;
        }

        .ffs-header-info-holder{
            width:100%;
            height:100%;
            position: absolute;
            top:-450Px;
            left:0Px;
            background-color: rgba(0, 0, 0, 0.9);
            color:white;
            padding:10Px;
        }
        .ffs-header-info-holder p{
            font-size:14Pt;
            margin-right:17Px;
        }
        .ffs-feed-name{
            font-size: 30Pt;
        }
        .ffs-result-feed-event{
            font-size: 22Pt;
            color:#777;
        }
        .ffs-result-feed-score{
            font-size:36Pt;
            float:right;
        }
        .ffs-parent-message-feed p{
            max-width: 90%;
            overflow: hidden;
        }
        .tabbable{
            padding-top: 8px;
            padding-bottom: 8px;
            line-height: 20px;
            border: 1px solid #ddd;
            -webkit-border-radius: 4px 4px 0 0;
            -moz-border-radius: 4px 4px 0 0;
            border-radius: 4px 4px 0 0;
            background-color: white;
            margin-top: 20Px;
        }
        .nav-tabs{
            margin-top: -46Px;
            margin-left: -1Px;
        }
        @media (min-width: 1200px) {
            .ParentMessageEditPanel_btnSave{
                margin-top:-10Px;
                padding:7Px;
            }
            .ffs-header-img-holder{
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
<script src='<?php echo __ASSETS_JS__; ?>/FFS.js'></script>
<script>
    $(function(){
        FFS.InitHeaderImgs();
    });
</script>

<script type="text/javascript">
    setTimeout(function(){var a=document.createElement("script");
        var b=document.getElementsByTagName("script")[0];
        a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0017/1061.js?"+Math.floor(new Date().getTime()/3600000);
        a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>
