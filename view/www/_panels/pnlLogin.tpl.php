<h1>Create Your Account</h1>



<div class="login-fields">

    <p>Create your free account:</p>
    <div id='<?php echo $_CONTROL->txtEmail->ControlId; ?>_holder'  class="field">
        <label for="email">Email Address:</label>
        <?php $_CONTROL->txtEmail->Render(); ?>
    </div> <!-- /field -->

    <div id='<?php echo $_CONTROL->txtPass->ControlId; ?>_holder' class="field">
        <label for="password">Password:</label>
        <?php $_CONTROL->txtPass->Render(); ?>
    </div> <!-- /field -->

    <!--div class="field">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login"/>
    </div> <!-- /field -->

</div> <!-- /login-fields -->

<div class="login-actions">
    <?php $_CONTROL->btnSubmit->Render(); ?>
</div> <!-- .actions -->