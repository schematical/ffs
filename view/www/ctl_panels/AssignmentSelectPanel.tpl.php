<div class=''>
    <?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
$_CONTROL->txtSearch->Render(); ?>
</div>
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
                            
                                <?php if (!is_null($_CONTROL->intIdAssignment)) { ?>
                                    <div class='controls'>
                                        <label> Id Assignment</label>
                                        <?php $_CONTROL->intIdAssignment->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdDevice)) { ?>
                                    <div class='controls'>
                                        <label> Id Device</label>
                                        <?php $_CONTROL->intIdDevice->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdSession)) { ?>
                                    <div class='controls'>
                                        <label> Id Session</label>
                                        <?php $_CONTROL->intIdSession->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strEvent)) { ?>
                                    <div class='controls'>
                                        <label> Event</label>
                                        <?php $_CONTROL->strEvent->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strApartatus)) { ?>
                                    <div class='controls'>
                                        <label> Apartatus</label>
                                        <?php $_CONTROL->strApartatus->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> Revoke Date Start</label>
                                <?php if (!is_null($_CONTROL->txtRevokeDate_StartDate)) {
    $_CONTROL->txtRevokeDate_StartDate->Render();
} ?>
                                <label> Revoke Date End</label>
                                 <?php if (!is_null($_CONTROL->txtRevokeDate_EndDate)) {
    $_CONTROL->txtRevokeDate_EndDate->Render();
} ?>
                             
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>