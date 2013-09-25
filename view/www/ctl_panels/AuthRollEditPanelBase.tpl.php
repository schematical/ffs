
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdAuthUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Auth User</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAuthUser->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdEntity)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Entity</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdEntity->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->strEntityType)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Entity Type</label>
                          <div class="controls">
                             <?php $_CONTROL->strEntityType->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strRollType)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Roll Type</label>
                          <div class="controls">
                             <?php $_CONTROL->strRollType->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInviteEmail)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite Email</label>
                          <div class="controls">
                             <?php $_CONTROL->strInviteEmail->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInviteToken)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite Token</label>
                          <div class="controls">
                             <?php $_CONTROL->strInviteToken->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strIdInviteUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite User</label>
                          <div class="controls">
                             <?php $_CONTROL->strIdInviteUser->Render(); ?>
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
