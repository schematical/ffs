
<div class='row margin-bottom-25'>
    <div class='span6'>

        <form action="/" id="validation-form" class="form-horizontal">
            <!--<legend>Competition Search:</legend>-->
            <div class='alert alert-info'>
                Tell us which competition you are at so you can start entering scores
            </div>
            <fieldset>
                <div id='ffs-competition-select' class="control-group pull-left">
                    <label class="control-label" for="name">Competition Name:</label>
                    <div class="controls">
                        <?php $_CONTROL->txtComp->Render(); ?>
                    </div>
                </div>


            </fieldset>
        </form>

    </div>
