<?php
class FFSParentCoachMobileScoreForm extends FFSForm{

    public $pnlScore = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/scores.tpl.php';
        $objCompetition = null;
        $intIdCompetiton = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if(!is_null($intIdCompetiton)){
            $objCompetition = Competition::Query(
                sprintf(
                    'WHERE Competition.idCompetition = %s',
                    $intIdCompetiton
                ),
                true
            );
        }
        if(is_null($objCompetition)){
            $this->pnlScore = new MJaxPanel($this);
            $this->pnlScore->Alert("No competition exists with this information");
        }elseif($objCompetition->Sanctioned){
            $this->pnlScore = new MJaxPanel($this);
            $this->pnlScore->Alert("The hosts of this competition are tracking the scores on tumble score so you may not input your own scores. You can follow along on the competition progress and view scores at <a href='/" .  $objCompetition->Namespace . "'>https://" . $_SERVER['SERVER_NAME'] . '/' . $objCompetition->Namespace . "</a>", 'info');
        }else{
            $this->pnlScore = new FFSMobileScoreInputPanel($this, null, $objCompetition);
            $arrAtheletes = FFSApplication::GetAtheletesByParent();
            $this->pnlScore->SetAtheletes($arrAtheletes);
        }
    }
}
