
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>


            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strNamespace)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Namespace</label>
                          <div class="controls">
                             <?php $_CONTROL->strNamespace->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                

                
                    <?php if (!is_null($_CONTROL->strClubNum)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Club Num</label>
                          <div class="controls">
                             <?php $_CONTROL->strClubNum->Render(); ?>
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
