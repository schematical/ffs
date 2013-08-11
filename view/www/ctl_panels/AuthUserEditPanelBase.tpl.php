
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->strEmail)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">email</label>
                          <div class="controls">
                             <?php $_CONTROL->strEmail->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strPassword)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">password</label>
                          <div class="controls">
                             <?php $_CONTROL->strPassword->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAccount)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idAccount</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccount->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdUserTypeCd)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idUserTypeCd</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUserTypeCd->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strUsername)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">username</label>
                          <div class="controls">
                             <?php $_CONTROL->strUsername->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strPassResetCode)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">passResetCode</label>
                          <div class="controls">
                             <?php $_CONTROL->strPassResetCode->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strFbuid)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">fbuid</label>
                          <div class="controls">
                             <?php $_CONTROL->strFbuid->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strFbAccessToken)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">fbAccessToken</label>
                          <div class="controls">
                             <?php $_CONTROL->strFbAccessToken->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intActive)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">active</label>
                          <div class="controls">
                             <?php $_CONTROL->intActive->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strFriendsIds)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">friendsIds</label>
                          <div class="controls">
                             <?php $_CONTROL->strFriendsIds->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttFriendsUpdated)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">friendsUpdated</label>
                          <div class="controls">
                             <?php $_CONTROL->dttFriendsUpdated->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intFbAccessTokenExpires)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">fbAccessTokenExpires</label>
                          <div class="controls">
                             <?php $_CONTROL->intFbAccessTokenExpires->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

