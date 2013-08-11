
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAccountTypeCd)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idAccountTypeCd</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccountTypeCd->Render(); ?>
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
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->strShortDesc)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">shortDesc</label>
                          <div class="controls">
                             <?php $_CONTROL->strShortDesc->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

