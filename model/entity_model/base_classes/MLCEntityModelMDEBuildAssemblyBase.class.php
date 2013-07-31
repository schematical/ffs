<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEBuildAssemblyBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEBuildAssemblyBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEBuildAssembly';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEBuildAssembly = new MDEBuildAssembly();
        } else {
            $objMDEBuildAssembly = MDEBuildAssembly::LoadById($strName);
        }
        if (!is_null($objMDEBuildAssembly)) {
            return new MLCEntityModelMDEBuildAssemblyObject($objMDEBuildAssembly);
        } else {
            throw new MLCEntityModelException("No MDEBuildAssembly found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEBuildAssembly::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEBuildAssembly';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>