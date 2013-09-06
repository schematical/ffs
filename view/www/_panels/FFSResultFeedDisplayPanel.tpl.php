<div class='ffs-feed-name'>
    <?php echo $_CONTROL->strAtheleteName; ?>
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
<?php if(count($_CONTROL->mixExtraData) > 1){ ?>
    <hr>
    <div class=''>
    <?php foreach($_CONTROL->mixExtraData as $objResult){ ?>
        <div style='font-weight:bold; float:right; width:<?php echo 100/count($_CONTROL->mixExtraData); ?>%'>
            <?php echo $objResult->Event; ?> - <?php echo $objResult->Score; ?>
        </div>

    <?php } ?>
        <div class='clear'></div>
    </div>

<?php } ?>

<hr />
<?php require(__VIEW_ACTIVE_APP_DIR__ . '/www/_panels/_FFSFeedDisplayPanel_footer.tpl.php'); ?>

