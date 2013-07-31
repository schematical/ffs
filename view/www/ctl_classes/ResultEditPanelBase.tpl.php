
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdSession->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdAthelete->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strScore->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strJudge->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intFlag->Render(); ?>
                      </div>
                    </div>
                

            
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

