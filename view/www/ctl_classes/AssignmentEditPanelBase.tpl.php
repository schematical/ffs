
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdDevice->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdSession->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strEvent->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strApartatus->Render(); ?>
                      </div>
                    </div>
                

            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdUser->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->dttRevokeDate->Render(); ?>
                      </div>
                    </div>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

