
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strShortDesc)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Short Desc</label>
                          <div class="controls">
                             <?php $_CONTROL->strShortDesc->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strAddress1)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Address 1</label>
                          <div class="controls">
                             <?php $_CONTROL->strAddress1->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strAddress2)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Address 2</label>
                          <div class="controls">
                             <?php $_CONTROL->strAddress2->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strCity)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> City</label>
                          <div class="controls">
                             <?php $_CONTROL->strCity->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strState)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> State</label>
                          <div class="controls">
                             <?php $_CONTROL->strState->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strZip)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Zip</label>
                          <div class="controls">
                             <?php $_CONTROL->strZip->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strCountry)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Country</label>
                          <div class="controls">
                             <?php $_CONTROL->strCountry->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->fltLat)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Lat</label>
                          <div class="controls">
                             <?php $_CONTROL->fltLat->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->fltLng)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Lng</label>
                          <div class="controls">
                             <?php $_CONTROL->fltLng->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdAccount)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Account</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccount->Render(); ?>
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
