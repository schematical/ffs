
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>

            <legend>Competition Info:</legend>

            <?php if(!is_null($_CONTROL->txtOrgName)){ ?>
                <div class="control-group pull-left">
                    <label class="control-label" for="name"> Your Club's Name</label>
                    <div class="controls">
                        <?php $_CONTROL->txtOrgName->Render(); ?>
                    </div>
                </div>
                <hr />
            <?php } ?>
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->strName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name">Competition Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strLongDesc)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Public Description</label>
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
                
            

            
                
                    <?php if (!is_null($_CONTROL->strNamespace)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name">TumbleScore.com URL</label>
                          <div class="controls">
                             <?php $_CONTROL->strNamespace->Render(); ?>
                          </div>
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
