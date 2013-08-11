<h1>
    <?php echo FFSForm::$objCompetition->Name; ?>
</h1>

<div class="progress">
    <!--div class="bar" style="width: 0%;" data-percentage="100">
        <div>100%</div>
    </div-->
</div>

<div class="timer-container row-fluid">
    <div class="span2"></div>
   <!-- <div class="span8">
        <div class="timer">
            <span class="days"></span> DAYS
            <span class="hours"></span> HOURS
            <span class="minutes"></span> MINUTES
            <span class="seconds"></span> SECONDS
        </div>
        <p>We are currently in maintenance mode and will come back very soon with a new set of cool features.<br>
            Enter your email in the form below and we’ll notify you as soon as we’re ready.</p>
    </div>-->
    <?php $this->pnlScore->Render(); ?>
    <div class="span2"></div>
</div>

<div class="social-container row-fluid">
    <!--div class="span2"></div>
    <div class="tweets span6">
        <div class="show-tweets"></div>
    </div>
    <div class="social-links span2">
        <a class="facebook" href="#"></a>
        <a class="twitter" href="#"></a>
        <a class="dribbble" href="#"></a>
        <a class="pinterest" href="#"></a>
    </div>
    <div class="span2"></div-->
    <?php $this->pnlMessage->Render(); ?>
</div>
<div id='divFooter' class="navbar navbar-fixed-bottom">

    <div class="navbar-inner">

        <div class="container">
            <div class='row-fluid'>
                <div class='span12'>
                    <p>
                        Press <b> F11</b> to toggle full screen mode
                    </p>
                </div>
            </div>
            <div class='row-fluid'>
                <div class='span2'></div>
                <div class='span4'>

                        <a href="/" class="btn btn-large">
                            <i class="shortcut-icon icon-home"></i>
                            <span class="shortcut-label">Home</span>
                        </a>

                </div>
                <div class='span4'>
                    <?php $this->lstEvent->Render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--div class="subscription-form-container row-fluid">
    <h2>Subscribe</h2>
    <form class="form-inline" action="assets/sendmail.php" method="post">
        <input type="text" name="email" placeholder="enter your email...">
        <button type="submit" class="btn"></button>
    </form>
    <div class="success-message"></div>
    <div class="error-message"></div>
</div-->