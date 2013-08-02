
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>




                
                    <?php if(!is_null($_CONTROL->strNamespace)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">namespace</label>
                          <div class="controls">
                             <?php $_CONTROL->strNamespace->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strName)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

