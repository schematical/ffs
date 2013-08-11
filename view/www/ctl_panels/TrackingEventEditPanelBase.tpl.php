
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->strName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strValue)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">value</label>
                          <div class="controls">
                             <?php $_CONTROL->strValue->Render(); ?>
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
                

            
                
                    <?php if(!is_null($_CONTROL->intIdSession)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idSession</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdApplication)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idApplication</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdApplication->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strApp)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">app</label>
                          <div class="controls">
                             <?php $_CONTROL->strApp->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

