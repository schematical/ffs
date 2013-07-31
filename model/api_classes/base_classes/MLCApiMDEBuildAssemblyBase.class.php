<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiMDEBuildAssemblyBase extends MLCApiClassBase
*/
class MLCApiMDEBuildAssemblyBase extends MLCApiClassBase {
    protected $strClassName = 'MDEBuildAssembly';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName)) {
            $objMDEBuildAssembly = MDEBuildAssembly::LoadById($strName);
        } else {
            $objMDEBuildAssembly = null;
        }
        if (!is_null($objMDEBuildAssembly)) {
            return new MLCApiMDEBuildAssemblyObject($objMDEBuildAssembly);
        } else {
            throw new MLCApiException("No MDEBuildAssembly found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>