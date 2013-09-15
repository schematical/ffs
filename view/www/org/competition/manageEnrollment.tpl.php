<div class='container'>
    <div class='row'>
        <div class='span8'>
            <div class='well' data-spy="affix" data-offset-top="200" style='top:10Px;'>

                <?php $this->pnlSearch->Render(); ?>

            </div>


            <h1>Athletes:</h1>
            <?php $this->tblEnrollment->Render(); ?>
            <hr/>
            <?php $this->pnlPagination->Render(); ?>
        </div>
        <div class='span4 '>
            <div data-spy="affix" data-offset-top="200" class='well'
                 style=' height:400Px; overflow-y: scroll; overflow-x:hidden; top:10Px'>
                    <div class='row'>
                        <div class='span4'>
                            <?php $this->pnlSessions->Render(); ?>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <div class='row'>

    </div>

</div>
<div class="navbar" data-spy="affix" data-offset-top="0" style='bottom:-20Px;width:100%;'>
    <div class="navbar-inner">
        <ul class="nav">
            <li>
                <?php $this->lnkAddAthelete->Render(); ?>
            </li>
            <li>
                <?php $this->lnkAddSession->Render(); ?>
            </li>
            <!--<li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>-->
        </ul>
    </div>
</div>