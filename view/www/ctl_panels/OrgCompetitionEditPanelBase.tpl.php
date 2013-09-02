
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdOrg)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Org</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdOrg->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdCompetition)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Competition</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdCompetition->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->intIdAuthUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Auth User</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAuthUser->Render(); ?>
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
