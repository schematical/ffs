<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/ResultBase.class.php");
class Result extends ResultBase {


    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case "IdInputUser":
                throw new Exception("Cannot set this property");
            default:
                return parent::__set($strName, $mixValue);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
    public function Save(){
        if(is_null($this->__get('IdInputUser'))){
            $this->arrDBFields['idInputUser'] = MLCAuthDriver::IdUser();
        }
        return parent::Save();
    }
    public static function GroupByAthelete($arrResults){
        $arrReturn = array();
        foreach($arrResults as $objResult){
            if(!array_key_exists($objResult->IdAthelete, $arrReturn)){
                $arrReturn[$objResult->IdAthelete] = new FFSResultCollection();
                $arrReturn[$objResult->IdAthelete]->Athelete = $objResult->IdAtheleteObject;
            }
            $arrReturn[$objResult->IdAthelete][$objResult->Event] = $objResult;
        }
        return $arrReturn;
    }
    public static function GroupByCompetition($arrResults){
        $arrReturn = array();
        foreach($arrResults as $objResult){
            if(!array_key_exists($objResult->IdCompetition, $arrReturn)){
                $arrReturn[$objResult->IdCompetition] = new FFSResultCollection();
                $arrReturn[$objResult->IdCompetition]->Athelete = $objResult->IdAtheleteObject;
                $arrReturn[$objResult->IdCompetition]->Competition = $objResult->IdCompetitionObject;
            }
            $arrReturn[$objResult->IdCompetition][$objResult->Event] = $objResult;
        }
        return $arrReturn;
    }

}


?>