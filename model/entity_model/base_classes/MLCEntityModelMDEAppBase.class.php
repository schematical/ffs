<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEAppBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEAppBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEApp';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEApp = new MDEApp();
        } else {
            $objMDEApp = MDEApp::LoadById($strName);
        }
        if (!is_null($objMDEApp)) {
            return new MLCEntityModelMDEAppObject($objMDEApp);
        } else {
            throw new MLCEntityModelException("No MDEApp found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEApp::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEApp';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>