<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search Orgs</span>
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
                            
                                <?php if (!is_null($_CONTROL->intIdDevice)) { ?>
                                    <div class='controls'>
                                        <!--label> Device</label-->
                                        <?php $_CONTROL->intIdDevice->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strName)) { ?>
                                    <div class='controls'>
                                        <!--label> Name</label-->
                                        <?php $_CONTROL->strName->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strToken)) { ?>
                                    <div class='controls'>
                                        <!--label> Token</label-->
                                        <?php $_CONTROL->strToken->Render(); ?>
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
                            
                                <?php if (!is_null($_CONTROL->intIdOrg)) { ?>
                                    <div class='controls'>
                                        <!--label> Org</label-->
                                        <?php $_CONTROL->intIdOrg->Render(); ?>
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