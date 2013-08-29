<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - ResultManageForm extends ResultManageFormBase
*/
class ResultManageForm extends ResultManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrResults = $this->Query();
        $objResult = null;
        if (count($arrResults) == 1) {
            $objResult = $arrResults[0];
        }
        $this->InitEditPanel($objResult);
        $this->InitList($arrResults);
    }
}
ResultManageForm::Run('ResultManageForm');
