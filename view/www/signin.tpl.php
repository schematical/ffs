<link href="<?php echo __MJAX_WADMIN_THEME_ASSET_URL__; ?>/css/pages/signin.css" rel="stylesheet">
<div class="navbar navbar-inverse navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <i class="icon-cog"></i>
            </a>

            <a class="brand" href="./index.html">
                Base Admin <sup>2.0</sup>
            </a>

            <div class="nav-collapse">
                <ul class="nav pull-right">

                    <li class="">
                        <a href="./" class="">
                            <i class="icon-chevron-left"></i>
                            Back to Homepage
                        </a>

                    </li>
                </ul>

            </div><!--/.nav-collapse -->

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<div class="account-container register stacked">

    <div class="content clearfix">

        <form action="./index.html" method="post">
            <?php $this->pnlLogin->Render(); ?>
            <?php /* <h1>Create Your Account</h1>



            <div class="login-fields">

                <p>Create your free account:</p>

                <div class="field">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" value="" placeholder="First Name" class="login" />
                </div> <!-- /field -->

                <div class="field">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" value="" placeholder="Last Name" class="login" />
                </div> <!-- /field -->


                <div class="field">
                    <label for="email">Email Address:</label>
                    <input type="text" id="email" name="email" value="" placeholder="Email" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login"/>
                </div> <!-- /field -->

            </div> <!-- /login-fields -->

            <div class="login-actions">

				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">I have read and agree with the Terms of Use.</label>
				</span>

                <button class="button btn btn-primary btn-large">Register</button>

            </div> <!-- .actions --> */ ?>

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
    Already have an account? <a href="./login.html">Login</a>
</div> <!-- /login-extra -->




<!--script src="./js/signin.js"></script-->