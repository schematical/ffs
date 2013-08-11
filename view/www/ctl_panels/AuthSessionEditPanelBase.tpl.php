
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->dttStartDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">startDate</label>
                          <div class="controls">
                             <?php $_CONTROL->dttStartDate->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttEndDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">endDate</label>
                          <div class="controls">
                             <?php $_CONTROL->dttEndDate->Render(); ?>
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
                

            
                
                    <?php if(!is_null($_CONTROL->strSessionKey)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">sessionKey</label>
                          <div class="controls">
                             <?php $_CONTROL->strSessionKey->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strIpAddress)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">ipAddress</label>
                          <div class="controls">
                             <?php $_CONTROL->strIpAddress->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

