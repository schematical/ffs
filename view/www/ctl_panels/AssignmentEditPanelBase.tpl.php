
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdDevice)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idDevice</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdDevice->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdSession)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idSession</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strEvent)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">event</label>
                          <div class="controls">
                             <?php $_CONTROL->strEvent->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strApartatus)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">apartatus</label>
                          <div class="controls">
                             <?php $_CONTROL->strApartatus->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdUser)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idUser</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUser->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttRevokeDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">revokeDate</label>
                          <div class="controls">
                             <?php $_CONTROL->dttRevokeDate->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

