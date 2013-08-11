
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->strJobName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">jobName</label>
                          <div class="controls">
                             <?php $_CONTROL->strJobName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strReport)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">report</label>
                          <div class="controls">
                             <?php $_CONTROL->strReport->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdBatchStatus)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idBatchStatus</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdBatchStatus->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

