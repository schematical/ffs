<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEBuildBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEBuildBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEBuild';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEBuild = new MDEBuild();
        } else {
            $objMDEBuild = MDEBuild::LoadById($strName);
        }
        if (!is_null($objMDEBuild)) {
            return new MLCEntityModelMDEBuildObject($objMDEBuild);
        } else {
            throw new MLCEntityModelException("No MDEBuild found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEBuild::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEBuild';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>