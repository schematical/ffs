<!--<h3><?php /*echo $_CONTROL->objSession->Name; */?></h3>-->

<div class="shortcuts ">

    <a data-mlc-scroll='.ffs-enrollment-list' href="javascript:;" class="shortcut">
        <i class="shortcut-icon icon-list "></i>
        <span class="shortcut-label">Session Enrollment</span>
    </a>
    <a data-mlc-scroll='.ffs-result-list' href="#" class="shortcut">
        <i class="shortcut-icon icon-trophy"></i>
        <span class="shortcut-label">Session<br/>Results</span>
    </a>
    <!--<a data-mlc-scroll='.ffs-assignment-list' href="#" class="shortcut">
        <i class="shortcut-icon icon-tablet "></i>
        <span class="shortcut-label">Session Assignments</span>
    </a>-->



</div>
<hr>
<div class='row-fluid'>
    <div class='span4'>
        <div class='alert alert-info'>
            <b>Start:</b>
            <?php echo date('D h:i p\m', strtotime($_CONTROL->objSession->StartDate)); ?>
        </div>
    </div>
    <div class='span4'>
        <div class='alert alert-info'>
            <b>End:</b>
            <?php echo date('D h:i p\m', strtotime($_CONTROL->objSession->EndDate)); ?>
        </div>
    </div>
    <div class='span4'>
        <?php $_CONTROL->lnkToggleState->Render(); ?>
    </div>
</div>
