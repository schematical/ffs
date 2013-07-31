
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdAthelete->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdCompetition->Render(); ?>
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
                         <?php $_CONTROL->strFlight->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strDivision->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strAgeGroup->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strMisc1->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strMisc2->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">Your Name</label>
                      <div class="controls">
                         <?php $_CONTROL->strMisc3->Render(); ?>
                      </div>
                    </div>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

