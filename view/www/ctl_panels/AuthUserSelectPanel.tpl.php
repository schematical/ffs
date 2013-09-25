<div class=''>
    <div class='controls input-prepend '>
        <span class='add-on'>Search  Auth User</span>
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
                            
                                <?php if (!is_null($_CONTROL->strEmail)) { ?>
                                    <div class='controls'>
                                        <!--label> Email</label-->
                                        <?php $_CONTROL->strEmail->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strPassword)) { ?>
                                    <div class='controls'>
                                        <!--label> Password</label-->
                                        <?php $_CONTROL->strPassword->Render(); ?>
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
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdUserTypeCd)) { ?>
                                    <div class='controls'>
                                        <!--label> User Type Cd</label-->
                                        <?php $_CONTROL->intIdUserTypeCd->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strUsername)) { ?>
                                    <div class='controls'>
                                        <!--label> Username</label-->
                                        <?php $_CONTROL->strUsername->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strPassResetCode)) { ?>
                                    <div class='controls'>
                                        <!--label> Pass Reset Code</label-->
                                        <?php $_CONTROL->strPassResetCode->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strFbuid)) { ?>
                                    <div class='controls'>
                                        <!--label> Fbuid</label-->
                                        <?php $_CONTROL->strFbuid->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strFbAccessToken)) { ?>
                                    <div class='controls'>
                                        <!--label> Fb Access Token</label-->
                                        <?php $_CONTROL->strFbAccessToken->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intActive)) { ?>
                                    <div class='controls'>
                                        <!--label> Active</label-->
                                        <?php $_CONTROL->intActive->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strFriendsIds)) { ?>
                                    <div class='controls'>
                                        <!--label> Friends Ids</label-->
                                        <?php $_CONTROL->strFriendsIds->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->dttFriendsUpdated)) { ?>
                                    <div class='controls'>
                                        <!--label> Friends Updated</label-->
                                        <?php $_CONTROL->dttFriendsUpdated->Render(); ?>
                                     </div>
                                 <?php
    } ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intFbAccessTokenExpires)) { ?>
                                    <div class='controls'>
                                        <!--label> Fb Access Token Expires</label-->
                                        <?php $_CONTROL->intFbAccessTokenExpires->Render(); ?>
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