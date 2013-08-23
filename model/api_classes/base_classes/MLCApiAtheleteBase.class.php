<?php
/**
* Class and Function List:
* Function list:
* - __call()
* - Query()
* Classes list:
* - MLCApiAtheleteBase extends MLCApiClassBase
*/
class MLCApiAtheleteBase extends MLCApiClassBase {
    protected $strClassName = 'Athelete';
    public function __call($strName, $arrArguments) {
        $arrReturn = array();
        if (is_numeric($strName) {
            $objAthelete = Athelete::LoadById($strName);
        } else {
            $objAthelete = null;
        }
        if (!is_null($objAthelete)) {
            return new MLCApiAtheleteObject($objAthelete);
        } else {
            throw new MLCApiException("No Athelete found with the data you submitted");
        }
    }
    public function Query() {
        //Will need to accept QS Pramaeters of facebook, twitter, google
        
    }
}
?>