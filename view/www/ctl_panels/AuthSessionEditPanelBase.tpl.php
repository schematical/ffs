
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->dttStartDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Start Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttStartDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttEndDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> End Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttEndDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> User</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUser->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strSessionKey)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Session Key</label>
                          <div class="controls">
                             <?php $_CONTROL->strSessionKey->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strIpAddress)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Ip Address</label>
                          <div class="controls">
                             <?php $_CONTROL->strIpAddress->Render(); ?>
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
