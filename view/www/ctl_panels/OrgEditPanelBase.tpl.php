
    <form action="/" id="validation-form" class="form-horizontal">
        <fieldset>


            
                
                    <?php
                if (!is_null($_CONTROL->strName)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Name</label>
                          <div class="controls">
                             <?php $_CONTROL->strName->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
                
            
                

                
                    <?php if (!is_null($_CONTROL->strClubNum)) { ?>
                        <div class="control-group pull-left">
                          <label class="control-label" for="name"> Club Num</label>
                          <div class="controls">
                             <?php $_CONTROL->strClubNum->Render(); ?>
                          </div>
                        </div>
                    <?php
} ?>
            <?php if (!is_null($_CONTROL->strClubType)) { ?>
                <div class="control-group pull-left">
                    <label class="control-label" for="name">
                        Club Type
                        <a href='#' data-toggle="popover" title="" data-content="Don't see your club type here? Feel free to let us know and we will add it." data-original-title="Club Type">
                            <i class='icon-question-sign'></i>
                        </a>
                    </label>
                    <div class="controls">
                        <?php $_CONTROL->strClubType->Render(); ?>
                    </div>
                </div>
            <?php
            } ?>

            
        </fieldset>
        <div class="form-actions">
            <?php $_CONTROL->btnSave->Render(); ?>&nbsp;&nbsp;
            <?php $_CONTROL->btnDelete->Render(); ?>
        </div>
    </form>
