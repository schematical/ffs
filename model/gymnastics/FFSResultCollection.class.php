<?php
/**
 * Created by JetBrains PhpStorm.
 * User: user1a
 * Date: 9/9/13
 * Time: 2:57 PM
 * To change this template use File | Settings | File Templates.
 */
class FFSResultCollection extends BaseEntityCollection{
    protected $objSession = null;
    protected $objCompetition = null;
    protected $objAthelete = null;
    public function GetMaxDate($strField = 'CreDate'){
        $arrOrder = FFSApplication::SortChronologically($this->arrCollection, $strField);
        return $arrOrder[0];
    }
    public function GetMinDate($strField = 'CreDate'){
        $arrOrder = FFSApplication::SortChronologically($this->arrCollection, $strField);
        return $arrOrder[count($arrOrder) - 1];
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
            case "Total":
                return $this->GetTotal();
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

            case "Athelete":
                return $this->objAthelete = $mixValue;
            case "Session":
                return $this->objSession = $mixValue;
            default:
                //return parent::__set($strName, $mixValue);
                throw new MLCMissingPropertyException( $this, $strName);
        }
    }

}