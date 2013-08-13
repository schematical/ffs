<div class='row margin-bottom-25'>

    <div class='span3 offset1 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/parent1.png'/>
        <div class='ffs-header-info-holder'>
            <h3>
                Want to cheer your athlete?
            </h3>
            <p>
                Tired of your support for your athlete being drowned out by the crowd?
            </p>
        </div>
    </div>
    <div class='span3 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/parent2.png'/>
        <div class='ffs-header-info-holder'>
            <h3>
                Send a message
            </h3>
            <p>
                Use tumblescore.com to cheer on your athlete from the bleachers using your smart phone
            </p>
        </div>
    </div>
    <div class='span3 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/org2.png'/>
        <div class='ffs-header-info-holder'>
            <h3>
                Let everyone see
            </h3>
            <p>
                Your message will show up on the score board to give your athlete the boost they need
            </p>
        </div>
    </div>
</div>
<?php if(!is_null($this->lnkUseTokens)){ ?>
    <div class='row-fluid margin-bottom-25'>
        <?php $this->lnkUseTokens->Render(); ?>
    </div>
<?php } ?>
<div class='row-fluid margin-bottom-25'>
    <?php $this->lnkIndividual->Render(); ?>
</div>
<div class='row-fluid margin-bottom-25'>
    <?php $this->lnkFamily->Render(); ?>
</div>
<div class='row-fluid margin-bottom-25'>
    <?php $this->pnlMaster->Render(); ?>
</div>
<!--<div id='ffs-info' class='row-fluid margin-bottom-25  mjax-bs-animate-hiden'>
    <div class='span10 offset1'>

    </div>
</div>-->
<?php $this->pnlSignup->Render(); ?>
<?php $this->pnlStripe->Render(); ?>
