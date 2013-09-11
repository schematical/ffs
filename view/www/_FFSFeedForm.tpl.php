<div class='container-fluid'>
    <div class='row-fluid'>
        <div class='span3 visible-desktop'>
        </div>
        <div class='span6'>
            <?php foreach($this->arrFeedEntities as $intIndex => $pnlFeedEntity){ ?>

            <?php
                $pnlFeedEntity->Render();
            } ?>

        </div>
        <div class='span3 visible-desktop'>
        </div>
    </div>
</div>