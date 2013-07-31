<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - FinalAction()
* - Query()
* Classes list:
* - MLCEntityModelMDEThoughtBase extends MLCEntityModelClassBase
*/
class MLCEntityModelMDEThoughtBase extends MLCEntityModelClassBase {
    protected $strClassName = 'MDEThought';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if ($strName == 'new') {
            $objMDEThought = new MDEThought();
        } else {
            $objMDEThought = MDEThought::LoadById($strName);
        }
        if (!is_null($objMDEThought)) {
            return new MLCEntityModelMDEThoughtObject($objMDEThought);
        } else {
            throw new MLCEntityModelException("No MDEThought found with the data you submitted");
        }
    }
    public function FinalAction($arrPostData) {
        $objResponse = new MLCEntityModelResponse(MDEThought::LoadAll()->GetCollection());
        $objResponse->BodyType = 'MDEThought';
        return $objResponse;
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>