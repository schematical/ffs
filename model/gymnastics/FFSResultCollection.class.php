<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user1a
 * Date: 9/9/13
 * Time: 2:57 PM
 * To change this template use File | Settings | File Templates.
 */
class FFSResultCollection extends MLCBaseEntityCollection{
    protected $strToStringField = 'Athelete';
    protected $objSession = null;
    protected $objCompetition = null;
    protected $objAthelete = null;
    public function GetMaxDate($strField = 'CreDate'){
        $arrOrder = FFSApplication::SortChronologically($this->arrCollection, $strField);
        if(count($arrOrder) == 0){
            return null;
        }
        $arrKeys = array_keys($arrOrder);
        return $arrOrder[$arrKeys[0]];
    }
    public function GetMinDate($strField = 'CreDate'){
        $arrOrder = FFSApplication::SortChronologically($this->arrCollection, $strField);
        if(count($arrOrder) == 0){
            return null;
        }
        $arrKeys = array_keys($arrOrder);
        return $arrOrder[$arrKeys[count($arrOrder) - 1]];
    }
    public function GetAtheletes(){
        //Should return null if none

        //Should return an array if many

        //Returns 1 if only one
    }
    public function GetTotal(){
        $arrEventResults = array();
        $fltTotal = 0;
        foreach($this->arrCollection as $objResult){
            if(!array_key_exists($objResult->Event, $arrEventResults)){
                $arrEventResults[$objResult->Event] = array();
            }
            $arrEventResults[$objResult->Event][] = $objResult;
        }
        foreach($arrEventResults as $strEvent => $arrEventData){
            if(count($arrEventData) == 0){
                throw new Exception($strEvent);
            }
            $fltTotal += FFSApplication::AvgResults($arrEventData);
        }
        return $fltTotal;
    }
    public function GetScoreByEvent($strEvent, $strJudge = null){
        $arrReturn =  array();
        foreach($this->arrCollection as $intIndex => $objResult){
            if(
                ($objResult->Event == $strEvent) &&
                (
                    (is_null($strJudge)) ||
                    ($objResult->Judge == $strJudge)
                )
            ){
                $arrReturn[] = $objResult;
            }
        }
        if(count($arrReturn) == 0){
            return null;
        }
        return FFSApplication::AvgResults($arrReturn);
    }
    public function IsSanctioned(){
        //RETURN FALSE IF EVEN ONE RESULT IS NOT SANCTIONED
        foreach($this->arrCollection as $objResult){
            if(!$objResult->Sanctioned){
                return false;
            }
        }
        return true;
    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "LatestResultDate":
                return $this->GetMaxDate();
            case "Athelete":
                return $this->objAthelete;
            case "Session":
                return $this->objSession;
            case "Competition":
                return $this->objCompetition;
            case "Sanctioned":
                return $this->IsSanctioned();
            case "Total":
                return $this->GetTotal();
            case "CreDate":
                return $this->GetMaxDate()->__get('CreDate');
                //return $this->GetAtheletes();
            default:
                $fltResult = $this->GetScoreByEvent($strName);
                if(!is_null($fltResult)){
                    return $fltResult;
                }
                //return parent::__get($strName);
            throw new MLCMissingPropertyException( $this, $strName);
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {
            case "ToStringField":
                return $this->strToStringField = $mixValue;
            case "Athelete":
                return $this->objAthelete = $mixValue;
            case "Session":
                return $this->objSession = $mixValue;
            case "Competition":
                return $this->objCompetition = $mixValue;
           ;
            default:
                //return parent::__set($strName, $mixValue);
                throw new MLCMissingPropertyException( $this, $strName);
        }
    }
    public function __toString(){
        $strReturn = $this->__get(
            $this->strToStringField
        )->__toString();
        return $strReturn;
    }

}