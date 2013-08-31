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
                            
                                <?php if (!is_null($_CONTROL->intIdBatch)) { ?>
                                    <div class='controls'>
                                        <!--label> Batch</label-->
                                        <?php $_CONTROL->intIdBatch->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strJobName)) { ?>
                                    <div class='controls'>
                                        <!--label> Job Name</label-->
                                        <?php $_CONTROL->strJobName->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strReport)) { ?>
                                    <div class='controls'>
                                        <!--label> Report</label-->
                                        <?php $_CONTROL->strReport->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdBatchStatus)) { ?>
                                    <div class='controls'>
                                        <!--label> Batch Status</label-->
                                        <?php $_CONTROL->intIdBatchStatus->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>