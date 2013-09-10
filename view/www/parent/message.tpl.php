<div class='container'>
    <?php if($this->intAvailMessages == 0){ ?>
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
    <?php }else{ ?>
        <div class='row margin-bottom-25'>
            <div class='span6 offset3'>
                <div class='alert alert-info'>
                    <h4>You have <?php echo $this->intAvailMessages; ?> Shout Outs to use</h4>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class='row margin-bottom-25'>
        <div class='span6 offset3'>
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
    <div class='row margin-bottom-25'>
        <div id='ffs-parent-message-packages' class="pricing-header">
            <h1>Support your Athlete when they need it most!</h1>

            <h2>How many Shout Outs you would like to send?</h2>
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
                            <li><strong>1</strong> Shout Out</li>
                            <li><strong>Invite</strong> family and friends</li>
                            <li><strong>Instant</strong> use</li>
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
                            <li><strong>5</strong> Shout Outs</li>
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
                            Team Package
                        </div>
                        <!-- /plan-title -->

                        <div class="plan-price">
                            <span class="note">$</span>20<span class="term"></span>
                        </div>
                        <!-- /plan-price -->

                    </div>
                    <!-- /plan-header -->

                    <div class="plan-features">
                            <ul>
                                <li><strong>25</strong> Shout Outs</li>
                                <li><strong>Invite</strong> the whole team</li>
                                <li><strong>Rollover</strong> for whole season</li>
                            </ul>
                    </div>

                    <!-- /plan-features -->

                    <div class="plan-actions">
                       <?php $this->lnkTeam->Render(); ?>
                    </div>
                    <!-- /plan-actions -->

                </div>
                <!-- /plan -->
            </div>
            <!-- /plan-container -->

        </div>
    </div>
    <div class='row margin-bottom-25'>
        <?php if(!is_null($this->pnlSignup)){ ?>
            <div class='span5 offset1'>
                <div class='well'>
                    <?php $this->pnlSignup->Render(); ?>
                </div>
            </div>
        <?php }else{ ?>
            <div class='span4 offset1'>
                    <div class='alert alert-info'>
                        You are currently logged in with your the account associated with the following email address:
                        <b><?php echo MLCAuthDriver::User()->Email; ?></b>
                    </div>
            </div>
        <?php } ?>
        <div class='span6'>
            <div class='well'>
                <?php if($this->intMessageCt == 0){ ?>
                    <div id='divPleaseSelectPackage' class='alert'>
                        Please select a package above before proceeding
                    </div>
                <?php }else{ ?>
                    <div class='alert alert-info'>
                        You are about to purchase
                        <b><?php echo $this->intMessageCt; ?></b> for <b>$<?php echo $this->intCost; ?></b>
                    </div>
                <?php } ?>
                <?php $this->pnlStripe->Render(); ?>
            </div>
        </div>
    </div>

</div>