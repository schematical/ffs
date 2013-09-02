
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdAthelete)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Athelete</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAthelete->Render(); ?>
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
                
            
                
                    <?php if (!is_null($_CONTROL->intIdSession)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Session</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strFlight)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Flight</label>
                          <div class="controls">
                             <?php $_CONTROL->strFlight->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strDivision)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Division</label>
                          <div class="controls">
                             <?php $_CONTROL->strDivision->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strAgeGroup)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Age Group</label>
                          <div class="controls">
                             <?php $_CONTROL->strAgeGroup->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMisc1)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Misc 1</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc1->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMisc2)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Misc 2</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc2->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMisc3)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Misc 3</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc3->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMisc4)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Misc 4</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc4->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMisc5)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Misc 5</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc5->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php if (!is_null($_CONTROL->strLevel)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Level</label>
                          <div class="controls">
                             <?php $_CONTROL->strLevel->Render(); ?>
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
