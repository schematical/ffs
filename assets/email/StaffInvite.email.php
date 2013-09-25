
<?php require_once(__ASSETS_ACTIVE_APP_DIR__ . '/email/_header.email.php'); ?>
    <h3>You have been invited to help manage the team at <?php echo $AUTH_ROLL->GetEntity()->Name; ?></h3>
    <p style="color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;">
        Welcome to TumbleScore online competition managment software
    </p>
    <p style="color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;">
        <a href='//<?php echo $_SERVER['SERVER_NAME']; ?>/org/landing.php?<?php echo MLCAuthQS::invite_token; ?>=<?php echo $AUTH_ROLL->InviteToken; ?>'>
            Click here to accept the invite
        </a>
    </p>

<?php require_once(__ASSETS_ACTIVE_APP_DIR__ . '/email/_footer.email.php'); ?>