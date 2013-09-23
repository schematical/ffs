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
    public static function LoadByAtheleteCollAndCompetition(MLCBaseEntityCollection $arrAtheletes, Competition $objComp){
        $arrIdAtheletes = $arrAtheletes->GetIDsAsArray();

        $strQuery = sprintf(
            'WHERE Result.idAthelete IN(%s) AND Result.idCompetition = %s',
            implode(',', $arrIdAtheletes),
            $objComp->IdCompetition
        );
        return self::Query($strQuery);
    }
    public static function LoadByAtheleteColl(MLCBaseEntityCollection $arrAtheletes){
        $arrIdAtheletes = $arrAtheletes->GetIDsAsArray();

        $strQuery = sprintf(
            'WHERE Result.idAthelete IN(%s)',
            implode(',', $arrIdAtheletes)
        );
        return self::Query($strQuery);
    }

    public static function GroupByAthelete($arrResults){
        $arrReturn = array();
        foreach($arrResults as $objResult){
            if(!array_key_exists($objResult->IdAthelete, $arrReturn)){
                $arrReturn[$objResult->IdAthelete] = new FFSResultCollection();
                $arrReturn[$objResult->IdAthelete]->Athelete = $objResult->IdAtheleteObject;
                $arrReturn[$objResult->IdAthelete]->ToStringField = 'Athelete';
            }
            $arrReturn[$objResult->IdAthelete][] = $objResult;
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
                $arrReturn[$objResult->IdCompetition]->ToStringField = 'Competition';
            }
            $arrReturn[$objResult->IdCompetition][] = $objResult;
        }
        return $arrReturn;
    }
    public static function GroupByLevel($arrResults){
        $arrReturn = array();
        foreach($arrResults as $objResult){
            if(!array_key_exists($objResult->IdAtheleteObject->Level, $arrReturn)){
                $arrReturn[$objResult->IdAtheleteObject->Level] = new FFSResultCollection();
                $arrReturn[$objResult->IdAtheleteObject->Level]->Level = $objResult->IdAtheleteObject->Level;
                $arrReturn[$objResult->IdAtheleteObject->Level]->ToStringField = 'Competition';
            }
            $arrReturn[$objResult->IdAtheleteObject->Level][] = $objResult;
        }
        return $arrReturn;
    }

}


?>