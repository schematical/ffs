<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - SessionManageForm extends SessionManageFormBase
*/
class SessionManageForm extends SessionManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrSessions = $this->Query();
        $objSession = null;
        if (count($arrSessions) == 1) {
            $objSession = $arrSessions[0];
        }
        $this->InitEditPanel($objSession);
        $this->InitList($arrSessions);
    }
}
SessionManageForm::Run('SessionManageForm');
