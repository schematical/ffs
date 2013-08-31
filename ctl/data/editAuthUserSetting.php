<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* Classes list:
* - AuthUserSettingManageForm extends AuthUserSettingManageFormBase
*/
class AuthUserSettingManageForm extends AuthUserSettingManageFormBase {
    protected $blnInlineEdit = false;
    public function Form_Create() {
        parent::Form_Create();
        $this->InitSelectPanel();
        $arrAuthUserSettings = $this->Query();
        $objAuthUserSetting = null;
        if (count($arrAuthUserSettings) == 1) {
            $objAuthUserSetting = $arrAuthUserSettings[0];
        }
        $this->InitEditPanel($objAuthUserSetting);
        $this->InitList($arrAuthUserSettings);
        $this->pnlBreadcrumb->AddCrumb('Manage AuthUserSettings');
    }
}
AuthUserSettingManageForm::Run('AuthUserSettingManageForm');
