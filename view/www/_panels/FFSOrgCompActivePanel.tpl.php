<div class='shortcuts '>
    <a href="<?php echo $_CONTROL->objCompetition->Namespace; ?>/org/fullScreen.php" class="shortcut">
        <i class="shortcut-icon icon-fullscreen"></i>
        <span class="shortcut-label">Full Screen Mode</span>
    </a>
    <a href="javascript:MJax.BS.Alert('Coming Soon');" class="shortcut">
        <i class="shortcut-icon icon-list-ol "></i>
        <span class="shortcut-label">Setup Wizzard</span>
    </a>
    <a href="javascript:MJax.BS.Alert('Coming Soon');" class="shortcut">
        <i class="shortcut-icon icon-wrench "></i>
        <span class="shortcut-label">Settings</span>
    </a>
    <a href="javascript:MJax.BS.Alert('Coming Soon');" class="shortcut">
        <i class="shortcut-icon icon-bar-chart "></i>
        <span class="shortcut-label">Reports</span>
    </a>
</div>
<h3>Messages:</h3>
<?php $_CONTROL->pnlMessages->Render(); ?>