<div class='row margin-bottom-25'>
    <div class='span4'>
        1
    </div>
    <div class='span4'>
       2
    </div>
    <div class='span4'>
       3
    </div>
</div>
<?php if(!is_null($this->lnkUseTokens)){ ?>
    <div class='row margin-bottom-25'>
        <?php $this->lnkUseTokens->Render(); ?>
    </div>
<?php } ?>
<div class='row margin-bottom-25'>
    <?php $this->lnkIndividual->Render(); ?>
</div>
<div class='row margin-bottom-25'>
    <?php $this->lnkFamily->Render(); ?>
</div>
<div class='row margin-bottom-25'>
    <?php $this->pnlMaster->Render(); ?>
</div>
<?php $this->pnlSignup->Render(); ?>
<?php $this->pnlStripe->Render(); ?>
