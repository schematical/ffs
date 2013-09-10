<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Parent Message</span>
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
                            
                                <?php if (!is_null($_CONTROL->intIdParentMessage)) { ?>
                                    <div class='controls'>
                                        <!--label> Parent Message</label-->
                                        <?php $_CONTROL->intIdParentMessage->Render(); ?>
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
                            
                                <?php if (!is_null($_CONTROL->strAtheleteName)) { ?>
                                    <div class='controls'>
                                        <!--label> Athelete Name</label-->
                                        <?php $_CONTROL->strAtheleteName->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strFromName)) { ?>
                                    <div class='controls'>
                                        <!--label> From Name</label-->
                                        <?php $_CONTROL->strFromName->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMessage)) { ?>
                                    <div class='controls'>
                                        <!--label> Message</label-->
                                        <?php $_CONTROL->strMessage->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
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
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> Que Date Start</label>
                                <?php if (!is_null($_CONTROL->txtQueDate_StartDate)) {
        $_CONTROL->txtQueDate_StartDate->Render();
    } ?>
                                <label> Que Date End</label>
                                 <?php if (!is_null($_CONTROL->txtQueDate_EndDate)) {
        $_CONTROL->txtQueDate_EndDate->Render();
    } ?>
                             
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strInviteType)) { ?>
                                    <div class='controls'>
                                        <!--label> Invite Type</label-->
                                        <?php $_CONTROL->strInviteType->Render(); ?>
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
                            
                            
                                <label> Invite View Date Start</label>
                                <?php if (!is_null($_CONTROL->txtInviteViewDate_StartDate)) {
        $_CONTROL->txtInviteViewDate_StartDate->Render();
    } ?>
                                <label> Invite View Date End</label>
                                 <?php if (!is_null($_CONTROL->txtInviteViewDate_EndDate)) {
        $_CONTROL->txtInviteViewDate_EndDate->Render();
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
                            
                            
                                <label> Approve Date Start</label>
                                <?php if (!is_null($_CONTROL->txtApproveDate_StartDate)) {
        $_CONTROL->txtApproveDate_StartDate->Render();
    } ?>
                                <label> Approve Date End</label>
                                 <?php if (!is_null($_CONTROL->txtApproveDate_EndDate)) {
        $_CONTROL->txtApproveDate_EndDate->Render();
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