<?php
class FFSOrgCompActivePanel extends MJaxPanel{
    public $objCompetition = null;
    public $pnlMessages = null;
    public $intMessagesSent = 0;
    public $fltDollarsRaised = 0;
    public function __construct($objParentControl, $objCompetition = null){
        parent::__construct($objParentControl);

        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';
        $this->objCompetition = $objCompetition;

        $this->intMessagesSent = count(ParentMessage::LoadCollByIdCompetition($objCompetition->IdCompetition)->getCollection());
        $this->fltDollarsRaised = FFSApplication::GetCompetitionIncomeForOrg($objCompetition);





        $arrParentMessages = ParentMessage::Query(
            sprintf(
                'WHERE idCompetition = %s AND queDate IS NOT NULL',
                $this->objCompetition->IdCompetition
            )
        );

        $this->pnlMessages = new ParentMessageListPanel($this, $arrParentMessages);
        //$this->InitWizzard();
    }

    
}