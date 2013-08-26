
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>




                    <?php if(!is_null($_CONTROL->strName)){ ?>
                        <div class="control-group">
                            <label class="control-label" for="name">Session Name</label>
                            <div class="controls">
                                <?php $_CONTROL->strName->Render(); ?>
                            </div>
                        </div>

                    <?php } ?>



                    <?php if(!is_null($_CONTROL->dttStartDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Start</label>

                             <?php $_CONTROL->dttStartDate->Render(); ?>

                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->dttEndDate)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">End</label>

                             <?php $_CONTROL->dttEndDate->Render(); ?>

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
                



            
                
                    <?php if(!is_null($_CONTROL->strNotes)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Notes</label>
                          <div class="controls">
                             <?php $_CONTROL->strNotes->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strData)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>

                    <?php if(!is_null($_CONTROL->lstEventSelector)){ ?>
                        <div class="control-group">
                            <label class="control-label" for="name">Events</label>
                            <div class="controls">
                                <?php $_CONTROL->lstEventSelector->Render(); ?>
                            </div>
                        </div>

                    <?php } ?>

            
                
                    <?php if(!is_null($_CONTROL->strEquipmentSet)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">Equipment Set</label>
                          <div class="controls">
                             <?php $_CONTROL->strEquipmentSet->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strEventData)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">eventData</label>
                          <div class="controls">
                             <?php $_CONTROL->strEventData->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

