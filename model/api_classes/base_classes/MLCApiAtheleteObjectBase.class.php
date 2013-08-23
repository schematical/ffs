<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiAtheleteObjectBase extends MLCApiObjectBase
*/
class MLCApiAtheleteObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Athelete';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Athelete'):
                //Load
                $objOrg = $this->GetEntity()->IdOrg;
                return new MLCApiOrgObject($objIdOrg);
            break;
            case ('results'):
                $arrResults = Result::LoadCollByIdAthelete($this->GetEntity()->idAthelete)->GetCollection();
                return new MLCApiResponse($arrResults);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
