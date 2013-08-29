
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdOrg)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idOrg</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdOrg->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strFirstName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">firstName</label>
                          <div class="controls">
                             <?php $_CONTROL->strFirstName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strLastName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">lastName</label>
                          <div class="controls">
                             <?php $_CONTROL->strLastName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttBirthDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">birthDate</label>
                          <div class="controls">
                             <?php $_CONTROL->dttBirthDate->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

