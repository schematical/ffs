<?php
/**
* Class and Function List:
* Function list:
* Classes list:
* - Enrollment extends EnrollmentRelBase
*/
require_once (__MODEL_APP_DATALAYER_DIR__ . "/base_classes/EnrollmentRelBase.class.php");
class Enrollment extends EnrollmentRelBase {

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {

            case "Flight":
            case "flight":
            case "Division":
            case "division":
            case "AgeGroup":
            case "ageGroup":
            //case "Level":
            //case "level":
            case "Misc1":
            case "misc1":
            case "Misc2":
            case "misc2":
            case "Misc3":
            case "misc3":
            case "Misc4":
            case "misc4":
            case "Misc5":
            case "misc5":
                if(is_null($this->IdSessionObject)){
                    throw new FFSUnregisteredDataException($strName, $mixValue);
                }

                $arrFlightData = $this->IdSessionObject->Data($strName . 's');
                if(
                    (is_null($arrFlightData)) ||
                    (!array_key_exists($mixValue, $arrFlightData))
                ){
                    throw new FFSUnregisteredDataException($strName, $mixValue);
                }
                return $this->arrDBFields[$strName] = $mixValue;
            default:
                parent::__set($strName, $mixValue);
            //throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
}
?>