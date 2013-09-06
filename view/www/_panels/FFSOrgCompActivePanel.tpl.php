<link href="<?php echo __MJAX_WADMIN_THEME_ASSET_URL__ . '/css'; ?>/pages/reports.css" rel="stylesheet">

<div class='shortcuts '>

    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/competition/manageSessions?<?php echo FFSQS::UseWizzard; ?>=1" class="shortcut">
        <i class="shortcut-icon icon-list-ol "></i>
        <span class="shortcut-label">Setup Wizzard</span>
    </a>

    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/competition/manageSessions" class="shortcut">
        <i class="shortcut-icon icon-bar-chart "></i>
        <span class="shortcut-label">Sessions</span>
    </a>
    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/competition/manageGyms" class="shortcut">
        <i class="shortcut-icon icon-building "></i>
        <span class="shortcut-label">Gyms</span>
    </a>
    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/competition/manageAthletes" class="shortcut">
        <i class="shortcut-icon icon-group "></i>
        <span class="shortcut-label">Atheletes</span>
    </a>



    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/deviceManager" class="shortcut">
        <i class="shortcut-icon icon-tablet "></i>
        <span class="shortcut-label">Manage Devices</span>
    </a>
    <a href="javascript:MJax.BS.Alert('Coming Soon');" class="shortcut">
        <i class="shortcut-icon icon-wrench "></i>
        <span class="shortcut-label">Settings</span>
    </a>
    <a href="javascript:MJax.BS.Alert('Coming Soon');" class="shortcut">
        <i class="shortcut-icon icon-bar-chart "></i>
        <span class="shortcut-label">Reports</span>
    </a>
    <a href="/<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/fullScreen.php" class="shortcut">
        <i class="shortcut-icon icon-fullscreen"></i>
        <span class="shortcut-label">Full Screen Mode</span>
    </a>
</div>
<hr>
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
            $<?php echo $_CONTROL->fltDollarsRaised; ?>
        </span>
    </div> <!-- .stat -->
</div>
<hr/>
<h3>Messages:</h3>
<?php $_CONTROL->pnlMessages->Render(); ?>