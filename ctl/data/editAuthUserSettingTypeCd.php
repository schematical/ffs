<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserSettingTypeCdManageForm extends AuthUserSettingTypeCdManageFormBase
*/
class AuthUserSettingTypeCdManageForm extends AuthUserSettingTypeCdManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUserSettingTypeCds = $this->Query();
        $objAuthUserSettingTypeCd = null;
        if (count($arrAuthUserSettingTypeCds) == 1) {
            $objAuthUserSettingTypeCd = $arrAuthUserSettingTypeCds[0];
        }
        $this->InitEditPanel($objAuthUserSettingTypeCd);
        $this->InitList($arrAuthUserSettingTypeCds);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUserSettingTypeCds');
    }
}
AuthUserSettingTypeCdManageForm::Run('AuthUserSettingTypeCdManageForm');
