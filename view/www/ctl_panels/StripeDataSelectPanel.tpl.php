<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Stripe Data</span>
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
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strObject)) { ?>
                                    <div class='controls'>
                                        <!--label> Object</label-->
                                        <?php $_CONTROL->strObject->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
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
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strMode)) { ?>
                                    <div class='controls'>
                                        <!--label> Mode</label-->
                                        <?php $_CONTROL->strMode->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strInstance_url)) { ?>
                                    <div class='controls'>
                                        <!--label> Instance _url</label-->
                                        <?php $_CONTROL->strInstance_url->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strStripeId)) { ?>
                                    <div class='controls'>
                                        <!--label> Stripe Id</label-->
                                        <?php $_CONTROL->strStripeId->Render(); ?>
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