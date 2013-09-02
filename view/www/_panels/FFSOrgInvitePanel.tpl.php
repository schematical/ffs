<div class='row'>
    <?php $_CONTROL->pnlSelect->Render(); ?>
    <?php if(is_null($_CONTROL->strUserEmails)){
        $_CONTROL->pnlInvite->Render();
    }else{ ?>
        <div class='span6'>
            <p>
                An invite will be sent to the accounts that manage this gym at the following email addresses: <b><?php echo $_CONTROL->strUserEmails; ?></b>
            </p>
            <?php $_CONTROL->btnInvite->Render(); ?>
        </div>
    <?php } ?>
</div>