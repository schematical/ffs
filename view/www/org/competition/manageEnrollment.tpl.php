<div class='container'>
    <div class='row'>
        <div class='span8'>
            <h1>Athletes:</h1>
            <?php $this->tblAtheletes->Render(); ?>
        </div>
        <div class='span4'>
            <div data-spy="affix" data-offset-top="0" class='well span4' style=' height:400Px; overflow-y: scroll;'>
                <?php $this->pnlSessions->Render(); ?>
            </div>
        </div>
    </div>
</div>