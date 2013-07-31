
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">name</label>
                      <div class="controls">
                         <?php $_CONTROL->strName->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">longDesc</label>
                      <div class="controls">
                         <?php $_CONTROL->strLongDesc->Render(); ?>
                      </div>
                    </div>
                

            
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">startDate</label>
                      <div class="controls">
                         <?php $_CONTROL->dttStartDate->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">endDate</label>
                      <div class="controls">
                         <?php $_CONTROL->dttEndDate->Render(); ?>
                      </div>
                    </div>
                

            
                
                    <div class="control-group">
                      <label class="control-label" for="name">idOrg</label>
                      <div class="controls">
                         <?php $_CONTROL->intIdOrg->Render(); ?>
                      </div>
                    </div>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

