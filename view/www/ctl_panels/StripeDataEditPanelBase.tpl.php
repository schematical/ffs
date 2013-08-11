
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>
            
                

            
                
                    <?php if(!is_null($_CONTROL->strData)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">data</label>
                          <div class="controls">
                             <?php $_CONTROL->strData->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strObject)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">object</label>
                          <div class="controls">
                             <?php $_CONTROL->strObject->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->intIdAuthUser)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idAuthUser</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdAuthUser->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                

            
                
                    <?php if(!is_null($_CONTROL->intIdParentStripeData)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">idParentStripeData</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdParentStripeData->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strMode)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">mode</label>
                          <div class="controls">
                             <?php $_CONTROL->strMode->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strInstance_url)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">instance_url</label>
                          <div class="controls">
                             <?php $_CONTROL->strInstance_url->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            
                
                    <?php if(!is_null($_CONTROL->strStripeId)){ ?>
                        <div class="control-group">
                          <label class="control-label" for="name">stripeId</label>
                          <div class="controls">
                             <?php $_CONTROL->strStripeId->Render(); ?>
                          </div>
                        </div>

                    <?php } ?>
                

            

            <div class="form-actions">
                <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
                <?php $_CONTROL->btnDelete->Render(); ?>
            </div>
        </fieldset>
    </form>

