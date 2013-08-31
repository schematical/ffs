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
                            
                                <?php if (!is_null($_CONTROL->intIdNotification)) { ?>
                                    <div class='controls'>
                                        <!--label> Notification</label-->
                                        <?php $_CONTROL->intIdNotification->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strClassName)) { ?>
                                    <div class='controls'>
                                        <!--label> Class Name</label-->
                                        <?php $_CONTROL->strClassName->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intViewed)) { ?>
                                    <div class='controls'>
                                        <!--label> Viewed</label-->
                                        <?php $_CONTROL->intViewed->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>