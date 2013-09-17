<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Athelete</span>
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
                            
                                <?php if (!is_null($_CONTROL->intIdAthelete)) { ?>
                                    <div class='controls'>
                                        <!--label> Athelete</label-->
                                        <?php $_CONTROL->intIdAthelete->Render(); ?>
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
                            
                                <?php if (!is_null($_CONTROL->strFirstName)) { ?>
                                    <div class='controls'>
                                        <!--label> First Name</label-->
                                        <?php $_CONTROL->strFirstName->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strLastName)) { ?>
                                    <div class='controls'>
                                        <!--label> Last Name</label-->
                                        <?php $_CONTROL->strLastName->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> Birth Date Start</label>
                                <?php if (!is_null($_CONTROL->txtBirthDate_StartDate)) {
        $_CONTROL->txtBirthDate_StartDate->Render();
    } ?>
                                <label> Birth Date End</label>
                                 <?php if (!is_null($_CONTROL->txtBirthDate_EndDate)) {
        $_CONTROL->txtBirthDate_EndDate->Render();
    } ?>
                             
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMemType)) { ?>
                                    <div class='controls'>
                                        <!--label> Mem Type</label-->
                                        <?php $_CONTROL->strMemType->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMemId)) { ?>
                                    <div class='controls'>
                                        <!--label> Mem Id</label-->
                                        <?php $_CONTROL->strMemId->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strLevel)) { ?>
                                    <div class='controls'>
                                        <!--label> Level</label-->
                                        <?php $_CONTROL->strLevel->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strEvent_default)) { ?>
                                    <div class='controls'>
                                        <!--label> Event _default</label-->
                                        <?php $_CONTROL->strEvent_default->Render(); ?>
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