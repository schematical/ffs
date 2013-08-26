<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#input_scores" data-toggle="tab">Input Scores</a>
        </li>
        <li>
            <a href="#output_scores" data-toggle="tab">Display Scores</a>
        </li>
    </ul>

    <br>

    <div class="tab-content">
        <div class="tab-pane active" id="input_scores">
            <div class='row'>
                <div class='span3 offset1'>
                    <label>
                        Session
                    </label>
                    <?php $_CONTROL->lstSession->Render(); ?>
                </div>
                <div class='span2'>
                    <label>
                        Event
                    </label>
                    <?php $_CONTROL->lstEvent->Render(); ?>
                </div>
                <div class='span3'>
                    <label>
                        Device
                    </label>
                    <?php $_CONTROL->txtDeviceName->Render(); ?>
                </div>
                <div class='span2'>
                    <label>
                        &nbsp;
                    </label>
                    <?php $_CONTROL->lnkAddInput->Render(); ?>
                </div>
            </div>


        </div>

        <div class="tab-pane" id="output_scores">

Output
        </div>
    </div>
</div>