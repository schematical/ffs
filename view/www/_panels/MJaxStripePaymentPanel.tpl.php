<div class='span12'>
    <div class='row-fluid'>
        <h3 class='span10 offset1'>
            Payment Info
        </h3>
    </div>
    <div class='row-fluid'>
        <?php $_CONTROL->txtCardNum->Render(); ?>
        <?php $_CONTROL->txtCvc->Render(); ?>

        <?php $_CONTROL->lstExpMonth->Render(); ?>
        <?php $_CONTROL->lstExpYear->Render(); ?>

    </div>
    <div class='row-fluid'>
        <?php $_CONTROL->lnkSubmit->Render(); ?>
    </div>
</div>





