<div class="accordion" id="accordion2">
    <?php foreach($_CONTROL->arrLinks as $intIdSession => $lnkSession){ ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <?php $lnkSession->Render(); ?>
                </div>
                <div data-id-session='<?php echo $intIdSession; ?>' class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="stats">

                            <div class="stat">
                                <span class="stat-value"><?php echo $_CONTROL->arrStats[$intIdSession]['spaces_left']; ?></span>
                                Spots Left
                            </div> <!-- /stat -->

                            <div class="stat">
                                <span class="stat-value"><?php echo $_CONTROL->arrStats[$intIdSession]['org_ct']; ?></span>
                                Teams
                            </div> <!-- /stat -->

                            <div class="stat">
                                <span class="stat-value">
                                    <?php echo $_CONTROL->arrStats[$intIdSession]['athelete_ct']; ?>
                                </span>
                                Athletes
                            </div> <!-- /stat -->

                        </div>
                        <hr />

                        <?php $_CONTROL->arrViewAllLinks[$intIdSession]->Render(); ?>
                    </div>
                </div>
            </div>
    <?php } ?>
</div>