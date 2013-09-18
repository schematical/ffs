<div class='container'>
    <div class='row-fluid margin-bottom-25'>

        <div class='span10 offset1'>
           <h1>Track your team's competition scores</h1>
            <h2>like the pros</h2>
        </div>
    </div>


        <div class='row margin-bottom-25'>
            <div class='span6'>
                <div class='well'>
                    <form action="/" id="validation-form" class="form-horizontal">
                        <legend>Team Info:</legend>
                        <fieldset>
                            <div id='ffs-org-select' class="control-group pull-left">
                                <label class="control-label" for="name">Your Gym Name:</label>
                                <div class="controls">
                                    <?php $this->pnlOrg->Render(); ?>
                                </div>
                            </div>
                        </fieldset>
                        <legend>Add An Athlete:</legend>
                        <fieldset>
                            <div id='ffs-athelete-select'  class="control-group pull-left">
                                <label class="control-label" for="name">
                                    Athlete's Name:
                                    <a href="#" data-toggle="popover" title="" data-content="You can enter in your athlete's name here or you can enter in your athlete's after you have completed signup" data-original-title="Athlete Name">
                                        <i class="icon-question-sign"></i>
                                    </a>
                                </label>
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
