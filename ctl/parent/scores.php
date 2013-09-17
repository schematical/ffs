<?php
class scores extends FFSForm{

    public $pnlScore = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/scores.tpl.php';
        $objCompetition = null;
        $intIdCompetiton = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if(!is_null($intIdCompetiton)){
            $objCompetition = Competition::Query(
                sprintf(
                    'WHERE Competition.idCompetition = %s AND Competition.sanctioned = 0',
                    $intIdCompetiton
                ),
                true
            );
        }
        $this->pnlScore = new FFSMobileScoreInputPanel($this, null, $objCompetition);
        $arrAtheletes = FFSApplication::GetAtheletesByParent();
        $this->pnlScore->SetAtheletes($arrAtheletes);
    }
}
scores::Run('scores');