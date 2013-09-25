<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Auth Roll</span>
        <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
$_CONTROL->txtSearch->Render(); ?>
    </div>
</div>
<?php if ($_CONTROL->DisplayAdvOptions) { ?>
<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Advanced Options
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse">
            <div class="accordion-inner">
                <div class='row'>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdAuthRoll)) { ?>
                                    <div class='controls'>
                                        <!--label> Auth Roll</label-->
                                        <?php $_CONTROL->intIdAuthRoll->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdAuthUser)) { ?>
                                    <div class='controls'>
                                        <!--label> Auth User</label-->
                                        <?php $_CONTROL->intIdAuthUser->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdEntity)) { ?>
                                    <div class='controls'>
                                        <!--label> Entity</label-->
                                        <?php $_CONTROL->intIdEntity->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strEntityType)) { ?>
                                    <div class='controls'>
                                        <!--label> Entity Type</label-->
                                        <?php $_CONTROL->strEntityType->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strRollType)) { ?>
                                    <div class='controls'>
                                        <!--label> Roll Type</label-->
                                        <?php $_CONTROL->strRollType->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strInviteEmail)) { ?>
                                    <div class='controls'>
                                        <!--label> Invite Email</label-->
                                        <?php $_CONTROL->strInviteEmail->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strInviteToken)) { ?>
                                    <div class='controls'>
                                        <!--label> Invite Token</label-->
                                        <?php $_CONTROL->strInviteToken->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strIdInviteUser)) { ?>
                                    <div class='controls'>
                                        <!--label> Invite User</label-->
                                        <?php $_CONTROL->strIdInviteUser->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>