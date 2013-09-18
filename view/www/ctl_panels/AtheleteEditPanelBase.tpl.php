
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                
            
                
                    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
if (!is_null($_CONTROL->intIdOrg)) {  $_CONTROL->intIdOrg->Render();
} ?>
                
            <hr>
                
                    <?php if (!is_null($_CONTROL->strFirstName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> First Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strFirstName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strLastName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Last Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strLastName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttBirthDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Birth Date</label>
                             <?php $_CONTROL->dttBirthDate->Render(); ?>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMemType)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name">
                              Competitive Association:
                              <a href="#" data-toggle="popover" title="" data-content="What body governs the competitions you attend? USAG? AAU? USTA? Let us know." data-original-title="Competitive Association">
                                  <i class="icon-question-sign"></i>
                              </a>
                          </label>
                          <div class="controls">
                             <?php $_CONTROL->strMemType->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMemId)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name">
                              Athlete Id:
                              <a href="#" data-toggle="popover" title="" data-content="What is the ID that your Competitive Association has assigned you?" data-original-title="Athlete Id">
                                  <i class="icon-question-sign"></i>
                              </a>
                          </label>
                          <div class="controls">
                             <?php $_CONTROL->strMemId->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strPsData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Ps Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strPsData->Render(); ?>
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
        <?php if(!is_null($_CONTROL->btnSave)){ ?>
            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        <?php } ?>
    </form>
