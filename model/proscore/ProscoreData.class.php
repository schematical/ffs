<?php
class ProscoreData{
    protected $strHeader = null;
    protected $strId = null;
    protected $arrData = null;
    protected $objDataEntity = null;
    public function __construct($strHeader, $strId, $arrData){
        $this->strHeader = $strHeader;
        $this->strId = $strId;
        $this->arrData = $arrData;
    }

    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "Header":
                return $this->strHeader;
            case "Id":
                return $this->strId;
            case "Data":
                return $this->arrData;
            case "DataEntity":
                return $this->objDataEntity;

            default:
                if(array_key_exists($strName, $this->arrData)){
                    return $this->arrData[$strName];
                }
                throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {

            case('DataEntity'):
                return $this->objDataEntity = $mixValue;
            default:
                throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }
    public function __toJson(){
        $arrReturn = $this->arrData;
        $arrReturn['_header'] = $this->strId;
        $arrReturn['_id'] = $this->strId;
        return json_encode($arrReturn);
    }
}