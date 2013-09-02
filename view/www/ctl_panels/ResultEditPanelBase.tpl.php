
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdSession)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Session</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdAthelete)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Athelete</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAthelete->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strScore)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Score</label>
                          <div class="controls">
                             <?php $_CONTROL->strScore->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strJudge)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Judge</label>
                          <div class="controls">
                             <?php $_CONTROL->strJudge->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intFlag)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Flag</label>
                          <div class="controls">
                             <?php $_CONTROL->intFlag->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->strEvent)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Event</label>
                          <div class="controls">
                             <?php $_CONTROL->strEvent->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttDispDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Disp Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttDispDate->Render(); ?>
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
