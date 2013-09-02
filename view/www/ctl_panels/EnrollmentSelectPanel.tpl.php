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
                            
                                <?php if (!is_null($_CONTROL->intIdEnrollment)) { ?>
                                    <div class='controls'>
                                        <!--label> Enrollment</label-->
                                        <?php $_CONTROL->intIdEnrollment->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
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
                            
                                <?php if (!is_null($_CONTROL->intIdCompetition)) { ?>
                                    <div class='controls'>
                                        <!--label> Competition</label-->
                                        <?php $_CONTROL->intIdCompetition->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdSession)) { ?>
                                    <div class='controls'>
                                        <!--label> Session</label-->
                                        <?php $_CONTROL->intIdSession->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strFlight)) { ?>
                                    <div class='controls'>
                                        <!--label> Flight</label-->
                                        <?php $_CONTROL->strFlight->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strDivision)) { ?>
                                    <div class='controls'>
                                        <!--label> Division</label-->
                                        <?php $_CONTROL->strDivision->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strAgeGroup)) { ?>
                                    <div class='controls'>
                                        <!--label> Age Group</label-->
                                        <?php $_CONTROL->strAgeGroup->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMisc1)) { ?>
                                    <div class='controls'>
                                        <!--label> Misc 1</label-->
                                        <?php $_CONTROL->strMisc1->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMisc2)) { ?>
                                    <div class='controls'>
                                        <!--label> Misc 2</label-->
                                        <?php $_CONTROL->strMisc2->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMisc3)) { ?>
                                    <div class='controls'>
                                        <!--label> Misc 3</label-->
                                        <?php $_CONTROL->strMisc3->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMisc4)) { ?>
                                    <div class='controls'>
                                        <!--label> Misc 4</label-->
                                        <?php $_CONTROL->strMisc4->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMisc5)) { ?>
                                    <div class='controls'>
                                        <!--label> Misc 5</label-->
                                        <?php $_CONTROL->strMisc5->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>