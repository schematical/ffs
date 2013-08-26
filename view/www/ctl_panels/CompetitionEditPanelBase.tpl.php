
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->strName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>


            <?php if(!is_null($_CONTROL->strNamespace)){ ?>
                <div class="control-group">
                    <label class="control-label" for="name">Namespace</label>
                    <div class="controls">
                        <?php $_CONTROL->strNamespace->Render(); ?>
                    </div>
                </div>

            <?php } ?>


            <?php if(!is_null($_CONTROL->dttStartDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Start</label>
                           <?php $_CONTROL->dttStartDate->Render(); ?>

                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttEndDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">End</label>

                             <?php $_CONTROL->dttEndDate->Render(); ?>

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
                <?php } ?>
                <?php if(!is_null($_CONTROL->btnDelete)){ ?>
                    <?php $_CONTROL->btnDelete->Render(); ?>
                <?php } ?>
            </div>
        </fieldset>
    </form>

