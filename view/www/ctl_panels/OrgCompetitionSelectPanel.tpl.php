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
                            
                                <?php if (!is_null($_CONTROL->intIdOrgCompetition)) { ?>
                                    <div class='controls'>
                                        <!--label> Org Competition</label-->
                                        <?php $_CONTROL->intIdOrgCompetition->Render(); ?>
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
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdCompetition)) { ?>
                                    <div class='controls'>
                                        <!--label> Competition</label-->
                                        <?php $_CONTROL->intIdCompetition->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>