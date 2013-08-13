
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>


                    <?php if(!is_null($_CONTROL->txtOrgName)){ ?>
                        <div class="control-group">
                            <label class="control-label" for="name">Host Gym Name</label>
                            <div class="controls">
                                <?php $_CONTROL->txtOrgName->Render(); ?>
                            </div>
                        </div>

                    <?php } ?>

            
                
                    <?php if(!is_null($_CONTROL->strName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Meet Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>


                        <div class="control-group">
                            <div class="controls input-prepend">
                                <span class="add-on mde-field-label">
                                    http://<?php echo $_SERVER['SERVER_NAME']; ?>/
                                </span>
                                <?php $_CONTROL->strNamespace->Render(); ?>
                            </div>
                        </div>


            
                
                    <?php if(!is_null($_CONTROL->strLongDesc)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Notes</label>
                          <div class="controls">
                             <?php $_CONTROL->strLongDesc->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->dttStartDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Start</label>
                          <div class="controls">
                             <?php $_CONTROL->dttStartDate->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttEndDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">End</label>
                          <div class="controls">
                             <?php $_CONTROL->dttEndDate->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdOrg)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idOrg</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdOrg->Render(); ?>
                          </div>
                        </div>
                    <?php } ?>
                

            
                

                

            

            <div class="form-actions">
                <?php if(!is_null($_CONTROL->btnSave)){ ?>
                    <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                    <?php $_CONTROL->btnDelete->Render(); ?>
                <?php } ?>
                <?php if(!is_null($_CONTROL->btnContinue)){ ?>
                    <?php $_CONTROL->btnContinue->Render(); ?>
                <?php } ?>
            </div>


        </fieldset>
    </form>

