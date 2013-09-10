
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
                
            
                
                    <?php if (!is_null($_CONTROL->strAtheleteName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Athelete Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strAtheleteName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strMessage)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Message</label>
                          <div class="controls">
                             <?php $_CONTROL->strMessage->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
            
                
                    <?php /* if (!is_null($_CONTROL->dttDispDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Disp Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttDispDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdUser)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> User</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdUser->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttQueDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Que Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttQueDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInviteData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite Data</label>
                          <div class="controls">
                             <?php $_CONTROL->strInviteData->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInviteType)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite Type</label>
                          <div class="controls">
                             <?php $_CONTROL->strInviteType->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->strInviteToken)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite Token</label>
                          <div class="controls">
                             <?php $_CONTROL->strInviteToken->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->dttInviteViewDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Invite View Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttInviteViewDate->Render(); ?>
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
                
            
                
                    <?php if (!is_null($_CONTROL->dttApproveDate)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Approve Date</label>
                          <div class="controls">
                             <?php $_CONTROL->dttApproveDate->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                
                    <?php if (!is_null($_CONTROL->intIdStripeData)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Stripe Data</label>
                          <div class="controls">
                             <?php $_CONTROL->intIdStripeData->Render(); ?>
                          </div>
                        </div>
                    <?php
} */ ?>

            
        </fieldset>
        <div class="form-actions">
            <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
            <?php $_CONTROL->btnDelete->Render(); ?>
        </div>
    </form>
