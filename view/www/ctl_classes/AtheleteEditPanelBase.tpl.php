
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdOrg->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strFirstName->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strLastName->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->dttBirthDate->Render(); ?>
                      </div>
                    </div>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

