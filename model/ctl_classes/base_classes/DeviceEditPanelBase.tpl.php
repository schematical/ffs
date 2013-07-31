
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strName->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strToken->Render(); ?>
                      </div>
                    </div>
                

            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strInviteEmail->Render(); ?>
                      </div>
                    </div>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

