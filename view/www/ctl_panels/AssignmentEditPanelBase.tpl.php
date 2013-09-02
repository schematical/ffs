
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdDevice)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Device</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdDevice->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdSession)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Session</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strEvent)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Event</label>
                          <div class="controls">
                             <?php $_CONTROL->strEvent->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strApartatus)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Apartatus</label>
                          <div class="controls">
                             <?php $_CONTROL->strApartatus->Render(); ?>
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
                
            
                
                    <?php if (!is_null($_CONTROL->dttRevokeDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Revoke Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttRevokeDate->Render(); ?>
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
