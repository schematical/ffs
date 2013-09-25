
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strJobName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Job Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strJobName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strReport)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Report</label>
                          <div class="controls">
                             <?php $_CONTROL->strReport->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdBatchStatus)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Batch Status</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdBatchStatus->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
        </fieldset>
        <div class="form-actions">
            <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
            <?php $_CONTROL->btnDelete->Render(); ?>
        </div>
    </form>
