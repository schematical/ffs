<?php
class scores extends FFSForm{

    public $pnlScore = null;


    public function Form_Create(){
        parent::Form_Create();
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/parent/scores.tpl.php';
        $this->pnlScore = new FFSMobileScoreInputPanel($this);
        $arrAtheletes = FFSApplication::GetAtheletesByParent();
        $this->pnlScore->SetAtheletes($arrAtheletes);
    }
}
scores::Run('scores');