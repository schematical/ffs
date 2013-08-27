
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAthelete)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Athlete</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAthelete->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdCompetition)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idCompetition</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdCompetition->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdSession)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idSession</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdSession->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strFlight)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Flight</label>
                          <div class="controls">
                             <?php $_CONTROL->strFlight->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strDivision)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Division</label>
                          <div class="controls">
                             <?php $_CONTROL->strDivision->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strAgeGroup)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Age Group</label>
                          <div class="controls">
                             <?php $_CONTROL->strAgeGroup->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php /* if(!is_null($_CONTROL->strMisc1)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">misc1</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc1->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strMisc2)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">misc2</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc2->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strMisc3)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">misc3</label>
                          <div class="controls">
                             <?php $_CONTROL->strMisc3->Render(); ?>
                          </div>
                        </div>

                    <?php } */ ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

