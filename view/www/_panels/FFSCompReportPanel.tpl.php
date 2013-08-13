<link href="<?php echo __MJAX_WADMIN_THEME_ASSET_URL__ . '/css'; ?>/pages/reports.css" rel="stylesheet">
<div id="big_stats" class="cf">
    <div class="stat">
        <h4>Messages Sent</h4>
        <span class="value">
            <?php echo $_CONTROL->intMessagesSent; ?>
        </span>
    </div> <!-- .stat -->

    <div class="stat">
        <h4>Your Earnings</h4>
        <span class="value">
            <?php echo $_CONTROL->fltDollarsRaised; ?>
        </span>
    </div> <!-- .stat -->
</div>