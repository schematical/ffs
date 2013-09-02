<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiOrgCompetitionObjectBase extends MLCApiObjectBase
*/
class MLCApiOrgCompetitionObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'OrgCompetition';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('OrgCompetition'):
                //Load
                $objOrg = $this->GetEntity()->IdOrg;
                return new MLCApiOrgObject($objIdOrg);
            break;
            case ('OrgCompetition'):
                //Load
                $objCompetition = $this->GetEntity()->IdCompetition;
                return new MLCApiCompetitionObject($objIdCompetition);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
