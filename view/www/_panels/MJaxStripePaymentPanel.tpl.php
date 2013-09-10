<form action="/" id="validation-form" class="form-horizontal">

    <fieldset>
        <!--<legend>&nbsp;&nbsp;&nbsp;Invite Family and Friends:</legend>
        <p style='padding-left:10Px;padding-right:10Px;'>
            Enter in the email of a loved one. We will send them a link that will allow them to post a supportive message to your athlete.
        </p>
        <hr/>-->
        <div class="control-group pull-left">

            <div class="control-group pull-left">
                <label class="control-label" for="name">Card Number</label>
                <div class="controls">


                <?php $_CONTROL->txtCardNum->Render(); ?>
                </div>
            </div>
            <div class="control-group pull-left">
                <label class="control-label" for="name">CVC</label>
                <div class="controls">
                    <?php $_CONTROL->txtCvc->Render(); ?>
                </div>
            </div>
            <div class="control-group pull-left">
                <label class="control-label" for="name">Exp Month</label>
                <div class="controls">
                    <?php $_CONTROL->lstExpMonth->Render(); ?>
                </div>
            </div>
            <div class="control-group pull-left">
                <label class="control-label" for="name">Exp Year</label>
                <div class="controls">
                    <?php $_CONTROL->lstExpYear->Render(); ?>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-actions">
        <?php $_CONTROL->lnkSubmit->Render(); ?>
    </div>
</form>




