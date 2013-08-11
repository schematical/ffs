<?php $_CONTROL->pnlParentMessage->Render(); ?>

<?php if(!is_null($_CONTROL->lnkInviteFamily)){
    $_CONTROL->lnkInviteFamily->Render();
} ?>
<?php if(!is_null($_CONTROL->pnlParentMessageInvite)){ ?>
    <?php $_CONTROL->pnlParentMessageInvite->Render();
} ?>
