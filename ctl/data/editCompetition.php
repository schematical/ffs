<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - CompetitionManageForm extends CompetitionManageFormBase
*/
class CompetitionManageForm extends CompetitionManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrCompetitions = $this->Query();
        $objCompetition = null;
        if (count($arrCompetitions) == 1) {
            $objCompetition = $arrCompetitions[0];
        }
        $this->InitEditPanel($objCompetition);
        $this->InitList($arrCompetitions);
    }
}
CompetitionManageForm::Run('CompetitionManageForm');
