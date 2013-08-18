<div class='row margin-bottom-25'>

    <div class='span3 offset1 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/parent1.png'/>

        <div class='ffs-header-info-holder'>
            <h3>
                Want to cheer your athlete?
            </h3>

            <p>
                Tired of your support for your athlete being drowned out by the crowd?
            </p>
        </div>
    </div>
    <div class='span3 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/parent2.png'/>

        <div class='ffs-header-info-holder'>
            <h3>
                Send a message
            </h3>

            <p>
                Use tumblescore.com to cheer on your athlete from the bleachers using your smart phone
            </p>
        </div>
    </div>
    <div class='span3 ffs-header-img-holder'>
        <img class='' src='<?php echo __ASSETS_IMG__; ?>/org2.png'/>

        <div class='ffs-header-info-holder'>
            <h3>
                Let everyone see
            </h3>

            <p>
                Your message will show up on the score board to give your athlete the boost they need
            </p>
        </div>
    </div>
</div>
<div class='row-fluid margin-bottom-25'>
    <div class='span10 offset1'>
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#sent_message" data-toggle="tab">Shout your own message</a>
                </li>
                <li>
                    <a href="#invite_family" data-toggle="tab">Invite family and friends to shout</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="sent_message">
                    <?php $this->pnlParentMessage->Render(); ?>
                </div>
                <div class="tab-pane" id="invite_family">
                    <?php $this->pnlParentMessageInvite->Render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='row-fluid margin-bottom-25'>
    <div id='ffs-parent-message-packages' class="pricing-header">
        <h1>How many shout outs you would like to send?</h1>

        <h2>No hidden fees. Cancel at anytime. No risk.</h2>
    </div>
    <!-- /.pricing-header -->

    <div class="pricing-plans plans-3">

        <div class="plan-container">
            <div class="plan stacked">
                <div class="plan-header">

                    <div class="plan-title">
                        Single Shout
                    </div>
                    <!-- /plan-title -->

                    <div class="plan-price">
                        <span class="note">$</span>2<span class="term"></span>
                    </div>
                    <!-- /plan-price -->

                </div>
                <!-- /plan-header -->

                <div class="plan-features">
                    <ul>
                        <li><strong>1</strong> Shout</li>
                        <li><strong>Invite</strong> family and friends</li>
                    </ul>
                </div>
                <!-- /plan-features -->

                <div class="plan-actions">
                    <?php $this->lnkIndividual->Render(); ?>
                </div>
                <!-- /plan-actions -->

            </div>
            <!-- /plan -->
        </div>
        <!-- /plan-container -->


        <div class="plan-container">
            <div class="plan stacked orange">
                <div class="plan-header">

                    <div class="plan-title">
                        Family Package
                    </div>
                    <!-- /plan-title -->

                    <div class="plan-price">
                        <span class="note">$</span>5<span class="term"></span>
                    </div>
                    <!-- /plan-price -->

                </div>
                <!-- /plan-header -->

                <div class="plan-features">
                    <ul>
                        <li><strong>5</strong> Shouts</li>
                        <li><strong>Invite</strong> family and friends</li>
                        <li><strong>Rollover</strong> for next competition</li>
                    </ul>
                </div>
                <!-- /plan-features -->

                <div class="plan-actions">
                    <?php $this->lnkFamily->Render(); ?>
                </div>
                <!-- /plan-actions -->

            </div>
            <!-- /plan -->
        </div>
        <!-- /plan-container -->

        <div class="plan-container">
            <div class="plan stacked">
                <div class="plan-header">

                    <div class="plan-title">
                        Season Pass
                    </div>
                    <!-- /plan-title -->

                    <div class="plan-price">
                        <span class="note">$</span>20<span class="term">Per Month</span>
                    </div>
                    <!-- /plan-price -->

                </div>
                <!-- /plan-header -->

                <div class="plan-features">
                    <ul>
                        <li><strong>5</strong> Shouts Per Competition</li>
                        <li><strong>Invite</strong> family and friends</li>
                        <li><strong>Track</strong> stats</li>
                        <li><strong>Follow</strong> individual athletes</li>
                    </ul>
                </div>
                <!-- /plan-features -->

                <div class="plan-actions">
                    <a href="javascript:;" class="btn">Coming Soon</a>
                </div>
                <!-- /plan-actions -->

            </div>
            <!-- /plan -->
        </div>
        <!-- /plan-container -->

    </div>
</div>
<!--<div id='ffs-info' class='row-fluid margin-bottom-25  mjax-bs-animate-hiden'>
    <div class='span10 offset1'>

    </div>
</div>-->
<?php if(!is_null($this->pnlSignup)){ $this->pnlSignup->Render(); } ?>
<?php $this->pnlStripe->Render(); ?>
