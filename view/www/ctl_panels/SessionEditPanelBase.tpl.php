
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->dttStartDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Start Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttStartDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttEndDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> End Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttEndDate->Render(); ?>
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
                
            
                
                    <?php if (!is_null($_CONTROL->strName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strNotes)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Notes</label>
                          <div class="controls">
                             <?php $_CONTROL->strNotes->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strEquipmentSet)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Equipment Set</label>
                          <div class="controls">
                             <?php $_CONTROL->strEquipmentSet->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strEventData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Event Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strEventData->Render(); ?>
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
