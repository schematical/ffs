
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAuthUser)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idAuthUser</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAuthUser->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdEntity)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idEntity</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdEntity->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->strEntityType)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">entityType</label>
                          <div class="controls">
                             <?php $_CONTROL->strEntityType->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strRollType)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">rollType</label>
                          <div class="controls">
                             <?php $_CONTROL->strRollType->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strData)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

