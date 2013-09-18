<div class='ffs-feed-name'>

    <?php
        if(!is_null($_CONTROL->mixExtraData)){
            echo $_CONTROL->mixExtraData->__toString();
        }
    ?>
</div>
<hr/>
<div class='ffs-result-feed-event'>
    <?php echo $_CONTROL->objEntity->Event; ?>
</div>
<div class='ffs-result-feed-score'>
    <?php echo $_CONTROL->objEntity->Score; ?>

</div>
<div class='pull-left'>
    <i>
        <?php echo date('h:i:s',strtotime($_CONTROL->objEntity->CreDate)); ?>
    </i>
</div>
<div class='clear'></div>
<?php if(
    (!is_null($_CONTROL->mixExtraData)) &&
    ($_CONTROL->mixExtraData->Length() > 1)
){ ?>
    <hr>
    <div class=''>
    <?php foreach($_CONTROL->mixExtraData as $objResult){ ?>
        <div style='font-weight:bold; float:right; width:<?php echo 100/($_CONTROL->mixExtraData->Length() + 1); ?>%'>
            <?php echo $objResult->Event; ?> - <?php echo $objResult->Score; ?>
            <br/>
            <?php if((!$objResult->Sanctioned) && (strlen($objResult->NSPlace > 0))) { ?>
                Place: <?php echo $objResult->NSPlace; ?>
                <?php if($objResult->NSTied){ ?>
(tie)
                <?php }; ?>
            <?php } ?>
        </div>


    <?php } ?>
        <div style='font-weight:bold; float:right; width:<?php echo 100/($_CONTROL->mixExtraData->Length() + 1); ?>%'>
            AA - <?php echo $_CONTROL->mixExtraData->Total; ?>


        </div>
        <div class='clear'></div>
    </div>

<?php } ?>

<hr />
<?php require(__MJAX_FEED_CORE_VIEW__ . '/_MJaxFeedDisplayPanel_footer.tpl.php'); ?>

