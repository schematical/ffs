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
                            
                                <?php if (!is_null($_CONTROL->intIdLocation)) { ?>
                                    <div class='controls'>
                                        <!--label> Location</label-->
                                        <?php $_CONTROL->intIdLocation->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strShortDesc)) { ?>
                                    <div class='controls'>
                                        <!--label> Short Desc</label-->
                                        <?php $_CONTROL->strShortDesc->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strAddress1)) { ?>
                                    <div class='controls'>
                                        <!--label> Address 1</label-->
                                        <?php $_CONTROL->strAddress1->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strAddress2)) { ?>
                                    <div class='controls'>
                                        <!--label> Address 2</label-->
                                        <?php $_CONTROL->strAddress2->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strCity)) { ?>
                                    <div class='controls'>
                                        <!--label> City</label-->
                                        <?php $_CONTROL->strCity->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strState)) { ?>
                                    <div class='controls'>
                                        <!--label> State</label-->
                                        <?php $_CONTROL->strState->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strZip)) { ?>
                                    <div class='controls'>
                                        <!--label> Zip</label-->
                                        <?php $_CONTROL->strZip->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strCountry)) { ?>
                                    <div class='controls'>
                                        <!--label> Country</label-->
                                        <?php $_CONTROL->strCountry->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->fltLat)) { ?>
                                    <div class='controls'>
                                        <!--label> Lat</label-->
                                        <?php $_CONTROL->fltLat->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->fltLng)) { ?>
                                    <div class='controls'>
                                        <!--label> Lng</label-->
                                        <?php $_CONTROL->fltLng->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdAccount)) { ?>
                                    <div class='controls'>
                                        <!--label> Account</label-->
                                        <?php $_CONTROL->intIdAccount->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>