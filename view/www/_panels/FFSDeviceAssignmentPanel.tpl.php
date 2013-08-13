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
            <?php $_CONTROL->lstSession->Render(); ?>
            <?php $_CONTROL->lstEvent->Render(); ?>
            <?php $_CONTROL->txtDeviceName->Render(); ?>
            <?php $_CONTROL->lnkAddInput->Render(); ?>

        </div>

        <div class="tab-pane" id="output_scores">

Output
        </div>
    </div>
</div>