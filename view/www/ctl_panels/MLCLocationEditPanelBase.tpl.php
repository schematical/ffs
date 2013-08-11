
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->strShortDesc)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">shortDesc</label>
                          <div class="controls">
                             <?php $_CONTROL->strShortDesc->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strAddress1)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">address1</label>
                          <div class="controls">
                             <?php $_CONTROL->strAddress1->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strAddress2)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">address2</label>
                          <div class="controls">
                             <?php $_CONTROL->strAddress2->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strCity)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">city</label>
                          <div class="controls">
                             <?php $_CONTROL->strCity->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strState)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">state</label>
                          <div class="controls">
                             <?php $_CONTROL->strState->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strZip)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">zip</label>
                          <div class="controls">
                             <?php $_CONTROL->strZip->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strCountry)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">country</label>
                          <div class="controls">
                             <?php $_CONTROL->strCountry->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->fltLat)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">lat</label>
                          <div class="controls">
                             <?php $_CONTROL->fltLat->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->fltLng)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">lng</label>
                          <div class="controls">
                             <?php $_CONTROL->fltLng->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAccount)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idAccount</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAccount->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

