<style>
    #ffs-score-input{
        padding-top: 20Px;
        padding-bottom: 20Px;
        font-size: 18Pt;
        width: 50%;
    }
    .ffs-number-pad{
        width:32%;
        display:inline-block;
    }
    .ffs-number-pad a{
        width:57%;
        height:45Px;
        font-size:22Pt;
        padding-top:25Px;
    }
    #myTab >li>a{
        font-size: 18Pt
    }
    .tab-pane .row-fluid{
        margin-bottom:10Px;
    }
    .ffs-score-notes{
        width:
    }
    #ffs-special-notes > .btn{
        padding-top: 10Px;
        padding-bottom: 10Px;
        font-size: 13Pt;
    }
</style>
<div class='container'>
    <?php if(count($_CONTROL->lstAtheletes->arrOptions) > 0){ ?>
    <div class='row margin-bottom-25'>
        <div class='span12'>
            <?php $_CONTROL->lstAtheletes->Render(); ?>
        </div>
    </div>
    <?php } ?>
    <div class='row'>
        <div class='span12'>
            <div class='well'>
                <div class='pull-left'>
                    <h3><?php echo $_CONTROL->objSelAthelete->__toString(); ?></h3>

                </div>
                <div class='pull-right'>
                    <h3>AA</h3>
                    <div style='font-size:30Pt'>
                        33.525
                    </div>
                </div>
                <div style='clear:both'></div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='span12'>
            <div class="" style='margin-top:60Px;'>
                <ul id="myTab" class="nav nav-tabs">
                    <?php foreach($_CONTROL->arrTabs as $lnkTab){ ?>
                        <li class="<?php echo (($_CONTROL->strSelEvent == $lnkTab->ActionParameter)?'active':''); ?>">
                            <?php $lnkTab->Render(); ?>
                        </li>
                    <?php } ?>
                </ul>
                <div id="myTabContent" class="tab-content" style='overflow: hidden'>
                    <div class="tab-pane fade in active" id="<?php echo $_CONTROL->ControlId; ?>_tab-content">
                        <div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>

                                    <div class='input-append'>
                                        <?php $_CONTROL->txtScore->Render(); ?>
                                        <?php $_CONTROL->lstSpecialNotes->Render(); ?>

                                    </div>
                                </div>
                            </div>

                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                1
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                2
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                3
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                4
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                5
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                6
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                7
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                8
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                9
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                <i class=' icon-arrow-lef'></i>
                                                <i class=' icon-remove'></i>
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                0
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                Enter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span4'>
                                    <label>Start Value:</label>
                                    <?php $_CONTROL->txtStartValue->Render(); ?>
                                </div>
                                <div class='span4'>
                                    <label>Place:</label>
                                    <div class='alert alert-info'>
                                        <?php $_CONTROL->lstPlace->Render(); ?>
&nbsp;&nbsp;&nbsp;
                                        <span>
                                            Tie:
                                        </span>
                                        <?php $_CONTROL->chkTied->Render(); ?>
                                    </div>
                                </div>

                            </div>
                            <div class='row-fluid'>
                                <?php $_CONTROL->txtNotes->Render(); ?>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>