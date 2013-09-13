<div class="accordion" id="accordion2">
    <?php foreach($_CONTROL->arrLinks as $intIdSession => $lnkSession){ ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <?php $lnkSession->Render(); ?>
                </div>
                <div data-id-session='<?php echo $intIdSession; ?>' class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php echo $lnkSession->ActionParameter->Name; ?>
                    </div>
                </div>
            </div>
    <?php } ?>
</div>