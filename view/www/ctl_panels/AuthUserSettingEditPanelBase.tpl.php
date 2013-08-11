
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdUser)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idUser</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUser->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdUserSettingTypeCd)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idUserSettingTypeCd</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUserSettingTypeCd->Render(); ?>
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
                

            
                
                    <?php if(!is_null($_CONTROL->strNamespace)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">namespace</label>
                          <div class="controls">
                             <?php $_CONTROL->strNamespace->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

