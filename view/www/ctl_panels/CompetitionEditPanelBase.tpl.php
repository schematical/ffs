
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>

            <legend>Competition Info:</legend>
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strLongDesc)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Long Desc</label>
                          <div class="controls">
                             <?php $_CONTROL->strLongDesc->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->dttStartDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label"  for="name"> Start Date</label>

                             <?php $_CONTROL->dttStartDate->Render(); ?>

                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttEndDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> End Date</label>

                             <?php $_CONTROL->dttEndDate->Render(); ?>

                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdOrg)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Org</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdOrg->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strNamespace)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Namespace</label>
                          <div class="controls">
                             <?php $_CONTROL->strNamespace->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttSignupCutOffDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Signup Cut Off Date</label>

                             <?php $_CONTROL->dttSignupCutOffDate->Render(); ?>

                        </div>
                    <?php
} ?>
                
            
        </fieldset>
        <div class="form-actions">
            <?php if(!is_null($_CONTROL->btnSave)){ $_CONTROL->btnSave->Render(); }; ?>&nbsp;&nbsp;
            <?php  if(!is_null($_CONTROL->btnDelete)){ $_CONTROL->btnDelete->Render(); } ?>
            <?php  if(!is_null($_CONTROL->btnContinue)){ $_CONTROL->btnContinue->Render(); } ?>

        </div>
    </form>
