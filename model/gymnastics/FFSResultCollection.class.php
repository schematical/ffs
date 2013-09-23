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
    protected $strLevel = null;
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
    public function GetTopScores($strEvent){
        error_log('-------' . $strEvent);
        $arrReturn = array();
        foreach($this->arrCollection as $objResult){
            if($objResult->Event == $strEvent){
                error_log('XXX' . $objResult->Event . ' - ' . $objResult->IdAtheleteObject . ' - ' . $objResult->Score);
            }
        }
        foreach($this->arrCollection as $intIndex => $objResult){
            if($objResult->Event == $strEvent){
                if(!array_key_exists($objResult->Score, $arrReturn)){
                    $arrReturn[$objResult->Score] = array();
                }
                $arrReturn[$objResult->Score][] = $objResult;

            }
        }
        krsort($arrReturn);
        if($strEvent == 'Beam'){
           // _dv($arrReturn);
        }
        return $arrReturn;
    }
    public function TotalTopScoresByEvent($strEvent, $intCount = 4){
        $arrScores = $this->GetTopScores($strEvent, $intCount);
        $fltTotal = 0;
        $intCounted = 0;
        foreach($arrScores as $strScore => $arrResults){
            foreach($arrResults as $intIndex => $objResult){

                $fltTotal += $objResult->Score;
                error_log($strEvent . " Adding: " . $objResult->Score . ' - ' . $fltTotal . ' - ' . $objResult->IdAtheleteObject->__toString());
                $intCounted += 1;
                if($intCounted >= $intCount){
                    return $fltTotal;
                }
            }
        }
        return $fltTotal;
    }
    public function GetTeamTotal($intCount = 4, $arrEvents = null){
        if(is_null($arrEvents)){
            $arrEvents = FFSEventData::$WOMENS_ARTISTIC_GYMNASTICS;
        }
        $intTotal = 0;
        foreach($arrEvents as $strEventKey => $strEventName){
            $intTotal += $this->TotalTopScoresByEvent($strEventKey, $intCount);
        }
        return $intTotal;
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
            case "Level":
                return $this->strLevel;
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
            case "Level":
                return $this->strLevel = $mixValue;
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