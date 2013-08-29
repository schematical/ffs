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
                            
                                <?php if (!is_null($_CONTROL->intIdCompetition)) { ?>
                                    <div class='controls'>
                                        <label> Id Competition</label>
                                        <?php $_CONTROL->intIdCompetition->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strName)) { ?>
                                    <div class='controls'>
                                        <label> Name</label>
                                        <?php $_CONTROL->strName->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strLongDesc)) { ?>
                                    <div class='controls'>
                                        <label> Long Desc</label>
                                        <?php $_CONTROL->strLongDesc->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> Start Date Start</label>
                                <?php if (!is_null($_CONTROL->txtStartDate_StartDate)) {
    $_CONTROL->txtStartDate_StartDate->Render();
} ?>
                                <label> Start Date End</label>
                                 <?php if (!is_null($_CONTROL->txtStartDate_EndDate)) {
    $_CONTROL->txtStartDate_EndDate->Render();
} ?>
                             
                        </div>
                    
                        <div class='span3'>
                            
                            
                                <label> End Date Start</label>
                                <?php if (!is_null($_CONTROL->txtEndDate_StartDate)) {
    $_CONTROL->txtEndDate_StartDate->Render();
} ?>
                                <label> End Date End</label>
                                 <?php if (!is_null($_CONTROL->txtEndDate_EndDate)) {
    $_CONTROL->txtEndDate_EndDate->Render();
} ?>
                             
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdOrg)) { ?>
                                    <div class='controls'>
                                        <label> Id Org</label>
                                        <?php $_CONTROL->intIdOrg->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strNamespace)) { ?>
                                    <div class='controls'>
                                        <label> Namespace</label>
                                        <?php $_CONTROL->strNamespace->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>