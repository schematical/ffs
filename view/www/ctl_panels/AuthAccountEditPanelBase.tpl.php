
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdAccountTypeCd)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Account Type Cd</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccountTypeCd->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> User</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUser->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->strShortDesc)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Short Desc</label>
                          <div class="controls">
                             <?php $_CONTROL->strShortDesc->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
        </fieldset>
        <div class="form-actions">
            <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
            <?php $_CONTROL->btnDelete->Render(); ?>
        </div>
    </form>
