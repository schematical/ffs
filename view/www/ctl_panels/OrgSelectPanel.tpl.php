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
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->intIdImportAuthUser)) { ?>
                                    <div class='controls'>
                                        <label> Id Import Auth User</label>
                                        <?php $_CONTROL->intIdImportAuthUser->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                        <div class='span3'>
                            
                                <?php if (!is_null($_CONTROL->strClubNum)) { ?>
                                    <div class='controls'>
                                        <label> Club Num</label>
                                        <?php $_CONTROL->strClubNum->Render(); ?>
                                     </div>
                                 <?php
} ?>
                            
                            
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>