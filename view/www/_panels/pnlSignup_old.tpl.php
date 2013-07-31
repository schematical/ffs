<div class="wrapper">


    <div class="block-dark sign-block">

        <h3>Sign up</h3>

        <form data-validate="parsley" action="index.html" id="signup-form" class="form-dark">
            <div id='txtUsername_holder' class="input-prepend">
                <span class="add-dark"><i class="icon-user"></i></span>
\
                <!--input type="text" name="fullname" data-required="true" placeholder="Username"-->
                <?php $_CONTROL->txtUsername->Render(); ?>
            </div>
            <div id='txtEmail_holder' class="input-prepend">
                <span class="add-dark"><i class="icon-envelope"></i></span>
                <!--input type="email" name="email" data-trigger="change" data-required="true" data-type="email" placeholder="Email"-->
                <?php $_CONTROL->txtEmail->Render(); ?>
            </div>
            <div id='txtPassword1_holder' class="input-prepend">
                <span class="add-dark"><i class="icon-lock"></i></span>
                <!--input type="password" id="eqalToModel" data-required="true" data-equalto="#eqalToModel" placeholder="Password"-->
                <?php $_CONTROL->txtPassword1->Render(); ?>
            </div>
            <div id='txtPassword2_holder' class="input-prepend">
                <span class="add-dark"><i class="icon-ok"></i></span>
                <!--input type="password" id="eqalToModel" data-required="true" data-equalto="#eqalToModel" placeholder="Confirm password"-->
                <?php $_CONTROL->txtPassword2->Render(); ?>
            </div>
            <div id='txtCompanyname_holder'  class="input-prepend">
                <span class="add-dark"><i class="icon-briefcase"></i></span>
                <!--input type="password" id="eqalToModel" data-required="true" data-equalto="#eqalToModel" placeholder="Confirm password"-->
                <?php $_CONTROL->txtCompanyname->Render(); ?>
            </div>
              <span id="signup-form-valid"><!-- onclick="javascript:$('#signup-form').parsley('validate');"-->
                <?php $_CONTROL->lnkSignup->Render(); ?>
              </span>
        </form>

        <!--form action="#">
            <div class="agree">
                <input type="checkbox"><span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
            </div>

        </form-->


        <div class="clearfix"></div>

        <hr class="hr-dark">

        <p class="para-account">Already have an account? <a href="signin"> Sign in</a></p>

    </div>

</div>