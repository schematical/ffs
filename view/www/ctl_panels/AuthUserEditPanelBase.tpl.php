
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strEmail)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Email</label>
                          <div class="controls">
                             <?php $_CONTROL->strEmail->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strPassword)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Password</label>
                          <div class="controls">
                             <?php $_CONTROL->strPassword->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdAccount)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Account</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccount->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdUserTypeCd)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> User Type Cd</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUserTypeCd->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strUsername)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Username</label>
                          <div class="controls">
                             <?php $_CONTROL->strUsername->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strPassResetCode)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Pass Reset Code</label>
                          <div class="controls">
                             <?php $_CONTROL->strPassResetCode->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strFbuid)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Fbuid</label>
                          <div class="controls">
                             <?php $_CONTROL->strFbuid->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strFbAccessToken)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Fb Access Token</label>
                          <div class="controls">
                             <?php $_CONTROL->strFbAccessToken->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intActive)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Active</label>
                          <div class="controls">
                             <?php $_CONTROL->intActive->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strFriendsIds)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Friends Ids</label>
                          <div class="controls">
                             <?php $_CONTROL->strFriendsIds->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttFriendsUpdated)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Friends Updated</label>
                          <div class="controls">
                             <?php $_CONTROL->dttFriendsUpdated->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intFbAccessTokenExpires)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Fb Access Token Expires</label>
                          <div class="controls">
                             <?php $_CONTROL->intFbAccessTokenExpires->Render(); ?>
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
