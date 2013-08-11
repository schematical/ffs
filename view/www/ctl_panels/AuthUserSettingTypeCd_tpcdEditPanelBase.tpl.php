
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
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

