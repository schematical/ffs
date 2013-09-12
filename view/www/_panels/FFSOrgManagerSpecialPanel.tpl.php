
<div class='row-fluid'>
    <div class='span6 offset3'>
        <div class='alert'>
            There are a couple more things you should fill out before inviting other gyms to your competition
        </div>
    </div>
</div>
<div class='row-fluid border-right'>
    <div class=' span4 '>
        <div class="control-group">
            <label class="control-label" for="name">
                Your Club Type
                <a href='#' data-toggle="popover" title="" data-content="Don't see your club type here? Feel free to let us know and we will add it." data-original-title="Club Type">
                    <i class='icon-question-sign'></i>
                </a>
            </label>
            <div class="controls">
                <?php $_CONTROL->lstClubType->Render(); ?>
            </div>
            <p>
                We need to know what governing body your organization is associated with so we can find the right clubs, gyms, and athletes to invite to your competition
            </p>
        </div>
    </div><div class=' span4'>
        <div class="control-group">
            <label class="control-label" for="name">
                Club Number

            </label>
            <div class="controls">
                <?php $_CONTROL->txtClubNum->Render(); ?>
            </div>
            <p>
                Knowing your club's number will allow us to ensure we have accurate information for your competition
            </p>
        </div>
    </div><div class=' span4'>
        <div class="control-group">
            <label class="control-label" for="name">
                Signup Cut Off Date

            </label>

            <?php $_CONTROL->dttCutOffDate->Render(); ?>
            <p>
                This is really important. You need to chose a cut off date when your gyms that enter your meet can no longer enter new athletes with out consulting you first.
            </p>
        </div>
    </div>
</div>
<div class='row-fluid'>
    <div class="span2 offset10">
        <?php $_CONTROL->lnkSave->Render(); ?>
    </div>
</div>
