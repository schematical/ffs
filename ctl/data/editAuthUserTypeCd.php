<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserTypeCdManageForm extends AuthUserTypeCdManageFormBase
*/
class AuthUserTypeCdManageForm extends AuthUserTypeCdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUserTypeCds = $this->Query();
        $objAuthUserTypeCd = null;
        if (count($arrAuthUserTypeCds) == 1) {
            $objAuthUserTypeCd = $arrAuthUserTypeCds[0];
        }
        $this->InitEditPanel($objAuthUserTypeCd);
        $this->InitList($arrAuthUserTypeCds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUserTypeCds');
    }
}
AuthUserTypeCdManageForm::Run('AuthUserTypeCdManageForm');
