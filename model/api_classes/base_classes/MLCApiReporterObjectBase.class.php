<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiReporterObjectBase extends MLCApiObjectBase
*/
class MLCApiReporterObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Reporter';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('editorialquerys'):
                $arrEditorialQuerys = EditorialQuery::LoadCollByIdReporter($this->GetEntity()->idReporter)->GetCollection();
                return new MLCApiResponse($arrEditorialQuerys);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
