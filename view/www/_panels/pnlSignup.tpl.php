<h1>Create Your Account</h1>

<!--div class="login-social">
    <p>Sign in using social network:</p>

    <div class="twitter">
        <a href="#" class="btn_1">Login with Twitter</a>
    </div>

    <div class="fb">
        <a href="#" class="btn_2">Login with Facebook</a>
    </div>
</div-->

<div class="login-fields">

    <p>Create your free account:</p>

    <div class="field">
        <label for="firstname">Name:</label>
        <?php $_CONTROL->txtUsername->Render(); ?>
    </div> <!-- /field -->


    <div class="field">
        <label for="email">Email Address:</label>
        <?php $_CONTROL->txtEmail->Render(); ?>
    </div> <!-- /field -->

    <div class="field">
        <label for="password">Password:</label>
        <?php $_CONTROL->txtPassword1->Render(); ?>
    </div> <!-- /field -->

    <div class="field">
        <label for="confirm_password">Confirm Password:</label>
        <?php $_CONTROL->txtPassword2->Render(); ?>
    </div>
    <div class="field">
        <label for="">Origination Name:</label>
        <?php $_CONTROL->txtCompanyname->Render(); ?>
    </div>

</div> <!-- /login-fields -->

<div class="login-actions">

				<!--span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">I have read and agree with the Terms of Use.</label>
				</span-->

    <!--button class="button btn btn-primary btn-large">Register</button-->
    <?php $_CONTROL->lnkSignup->Render(); ?>

</div> <!-- .actions -->