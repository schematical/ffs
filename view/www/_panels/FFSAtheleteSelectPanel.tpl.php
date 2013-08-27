<div class=''>
    <?php $_CONTROL->txtSearch->Render(); ?>
</div>
<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Advanced Options
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php $_CONTROL->txtAdvStartDate->Render(); ?>
                <?php $_CONTROL->txtAdvEndDate->Render(); ?>
            </div>
        </div>
    </div>
</div>
<div>
    <?php $_CONTROL->tblAtheletes->Render(); ?>
</div>