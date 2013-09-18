<div class='row-fluid'>
    <div class='span4'>
        <h4>Share via social network:</h4>
    </div>
    <div class='span4'>
        <?php $_CONTROL->lnkTwitter->Render(); ?>
    </div>
    <div class='span4'>
        <?php $_CONTROL->lnkFacebook->Render(); ?>
    </div>
</div>
<hr/>
<div class='row-fluid'>
    <div class='span4'>
        <h4>Share Via Email:</h4>
    </div>
    <div class='span6'>
        <?php $_CONTROL->txtEmail->Render(); ?>
    </div>
    <div class='span2'>
        <?php $_CONTROL->lnkEmail->Render(); ?>
    </div>
</div>
<hr/>
<div class='row-fluid'>
    <div class='span4'>
        <h4>Copy HTML into a web page</h4>
    </div>
    <!--<div class='span8'>-->
       <?php $_CONTROL->txtEmbed->Render(); ?>
    <!--</div>-->
</div>
