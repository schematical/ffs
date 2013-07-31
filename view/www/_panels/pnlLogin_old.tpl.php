<div class="block-dark sign-block">

    <h3>Login to Schematical</h3>

    <hr class="hr-dark">

    <!--div class="row-fluid">
        <div class="span12 open-id">
            <a href="index.html" class="modern sign-facebook"><span class="mordern-id">Facebook</span></a>
            <a href="index.html" class="modern sign-google"><span class="mordern-id">Google +</span></a>
        </div>
    </div>

    <hr class="hr-dark"-->

    <form data-validate="parsley" action="index.html" id="sign-form" class="form-dark">
        <div id='<?php echo $_CONTROL->txtEmail->ControlId; ?>_holder' class="input-prepend">
            <span class="add-dark"><i class="icon-user"></i></span>
            <!--input type="text" name="fullname" data-required="true" placeholder="Username" class="parsley-validated"-->
            <?php $_CONTROL->txtEmail->Render(); ?>
        </div>
        <div id='<?php echo $_CONTROL->txtPass->ControlId; ?>_holder'  class="input-prepend">
            <span class="add-dark"><i class="icon-lock"></i></span>
            <!--input type="password" data-required="true" placeholder="Password" class="parsley-validated"-->
            <?php $_CONTROL->txtPass->Render(); ?>
        </div>

          <span id="sign-form-valid"><!-- onclick="javascript:$('#sign-form').parsley('validate');"-->
            <!--input type="submit" class="btn btn-inverse pull-right" value="Log In"-->
            <?php $_CONTROL->btnSubmit->Render(); ?>
          </span>

    </form>

    <div class="clearfix"></div>

    <hr class="hr-dark">

    <!--p><a href="password.html">Forgot your password?</a></p-->

    <p class="para-account">Don't have an account yet ?<a href="signup"> Create an account</a></p>




</div>