<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Result</span>
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
                            
                                <?php if (!is_null($_CONTROL->intIdResult)) { ?>
                                    <div class='controls'>
                                        <!--label> Result</label-->
                                        <?php $_CONTROL->intIdResult->Render(); ?>
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
                            
                                <?php if (!is_null($_CONTROL->intIdAthelete)) { ?>
                                    <div class='controls'>
                                        <!--label> Athelete</label-->
                                        <?php $_CONTROL->intIdAthelete->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strScore)) { ?>
                                    <div class='controls'>
                                        <!--label> Score</label-->
                                        <?php $_CONTROL->strScore->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strJudge)) { ?>
                                    <div class='controls'>
                                        <!--label> Judge</label-->
                                        <?php $_CONTROL->strJudge->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intFlag)) { ?>
                                    <div class='controls'>
                                        <!--label> Flag</label-->
                                        <?php $_CONTROL->intFlag->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strEvent)) { ?>
                                    <div class='controls'>
                                        <!--label> Event</label-->
                                        <?php $_CONTROL->strEvent->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> Disp Date Start</label>
                                <?php if (!is_null($_CONTROL->txtDispDate_StartDate)) {
        $_CONTROL->txtDispDate_StartDate->Render();
    } ?>
                                <label> Disp Date End</label>
                                 <?php if (!is_null($_CONTROL->txtDispDate_EndDate)) {
        $_CONTROL->txtDispDate_EndDate->Render();
    } ?>
                             
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intSanctioned)) { ?>
                                    <div class='controls'>
                                        <!--label> Sanctioned</label-->
                                        <?php $_CONTROL->intSanctioned->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strNotes)) { ?>
                                    <div class='controls'>
                                        <!--label> Notes</label-->
                                        <?php $_CONTROL->strNotes->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strStartValue)) { ?>
                                    <div class='controls'>
                                        <!--label> Start Value</label-->
                                        <?php $_CONTROL->strStartValue->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
} ?>