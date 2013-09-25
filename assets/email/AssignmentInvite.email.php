<?php require_once(__ASSETS_ACTIVE_APP_DIR__ . '/email/_header.email.php'); ?>
    <p style="color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;">
        <b>Event:</b><?php
        echo $ASSIGNMENT->Event;
        ?></p>
    <p style="color: #c6c6c6; font: normal 12px Helvetica, Arial, sans-serif; margin: 0; padding: 0; line-height: 18px;">
        <b>Session:</b><?php
        echo $ASSIGNMENT->IdSessionObject->Name;
        ?></p>

<?php require_once(__ASSETS_ACTIVE_APP_DIR__ . '/email/_footer.email.php'); ?>