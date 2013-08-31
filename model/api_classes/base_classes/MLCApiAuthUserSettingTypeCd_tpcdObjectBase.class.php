<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAuthUserSettingTypeCd_tpcdObjectBase extends MLCApiObjectBase
*/
class MLCApiAuthUserSettingTypeCd_tpcdObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'AuthUserSettingTypeCd_tpcd';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('authusersettings'):
                $arrAuthUserSettings = AuthUserSetting::LoadCollByIdUserSettingTypeCd($this->GetEntity()->idUserSettingTypeCd)->GetCollection();
                return new MLCApiResponse($arrAuthUserSettings);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
