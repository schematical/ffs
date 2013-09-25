
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strObject)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Object</label>
                          <div class="controls">
                             <?php $_CONTROL->strObject->Render(); ?>
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
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->intIdParentStripeData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Parent Stripe Data</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdParentStripeData->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMode)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Mode</label>
                          <div class="controls">
                             <?php $_CONTROL->strMode->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInstance_url)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Instance _url</label>
                          <div class="controls">
                             <?php $_CONTROL->strInstance_url->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strStripeId)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Stripe Id</label>
                          <div class="controls">
                             <?php $_CONTROL->strStripeId->Render(); ?>
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
