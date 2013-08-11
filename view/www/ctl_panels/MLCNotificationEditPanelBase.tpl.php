
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
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->strClassName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">className</label>
                          <div class="controls">
                             <?php $_CONTROL->strClassName->Render(); ?>
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
                

            
                
                    <?php if(!is_null($_CONTROL->intViewed)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">viewed</label>
                          <div class="controls">
                             <?php $_CONTROL->intViewed->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

