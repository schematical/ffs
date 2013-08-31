<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthRollManageForm extends AuthRollManageFormBase
*/
class AuthRollManageForm extends AuthRollManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthRolls = $this->Query();
        $objAuthRoll = null;
        if (count($arrAuthRolls) == 1) {
            $objAuthRoll = $arrAuthRolls[0];
        }
        $this->InitEditPanel($objAuthRoll);
        $this->InitList($arrAuthRolls);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthRolls');
    }
}
AuthRollManageForm::Run('AuthRollManageForm');
