<div class='container'>
    <div class='row-fluid margin-bottom-25'>

        <div class='span10 offset1'>
           <h1>Follow your Athlete's progress with pride</h1>
        </div>
    </div>


        <div class='row margin-bottom-25'>
            <div class='span6'>
                <div class='well'>
                    <form action="/" id="validation-form" class="form-horizontal">
                        <legend>Basic Info:</legend>
                        <fieldset>
                            <div id='ffs-org-select' class="control-group pull-left">
                                <label class="control-label" for="name">Your Gym Name:</label>
                                <div class="controls">
                                    <?php $this->pnlOrg->Render(); ?>
                                </div>
                            </div>

                            <div id='ffs-athelete-select'  class="control-group pull-left">
                                <label class="control-label" for="name">Your Athlete's Name:</label>
                                <div class="controls">
                                    <?php $this->pnlAthelete->Render(); ?>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class='span6'>
                <?php $this->pnlSignup->Render(); ?>
            </div>
        </div>
        <div class='row margin-bottom-25'>

        </div>


</div>
