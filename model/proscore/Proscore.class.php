<?php
class Proscore{
    protected $arrData = array();
    public static function ImportFromFile($strFile){
        $handle = @fopen($strFile, "r");
        $arrLines = array();
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $arrLines[] = $buffer;
            }
            if (!feof($handle)) {
                throw new Exception("Error: unexpected fgets() fail reading '" . $strFile . "'\n");
            }
            fclose($handle);
        }
        $objProscore = new Proscore();
        $arrSectionData = array();
        $strHeader = null;
        $strId = null;
        foreach($arrLines as $intIndex => $strData){
            $strData = str_replace("\n","", $strData);
            //echo "Parsing: ". $strData . ' - ' . strlen($strData) . "\n";
            if(strlen($strData) < 2){
                //End section

                if(!is_null($strId)){
                    $objPSData = new ProscoreData($strHeader, $strId, $arrSectionData);
                    if(!array_key_exists($strHeader, $objProscore->arrData)){
                        $objProscore->arrData[$strHeader] = array();
                    }
                    $objProscore->arrData[$strHeader][(int)$strId] = $objPSData;
                }
                $strId = null;
                $strHeader = null;
                $arrSectionData = array();
            }elseif(substr($strData, 0, 1) == '['){
                //We know it is a header
                $intPos = strpos($strData, '-');
                if($intPos !== false){
                    $strHeader = substr($strData, 1, $intPos - 1);
                    $intLen =  strlen($strData) - ($intPos + 3);
                    $strSubData = substr(
                        $strData,
                        $intPos + 1,
                       $intLen
                    );
                    //_dv($strData . ' - ' .$strSubData . ' - ' . $intLen);
                    $strId = (int)ltrim(
                        $strSubData,
                        '0'
                    );
                    //_dv($strId);
                }else{
                    //We know there is a parent here to be found
                    //$strHeader = substr($strData, 1, strlen($strData) - 1);
                    //$strId = null;
                }
            }else{
                //This should be data
                if(!is_null($strHeader)){
                    $arrParts = explode('=', $strData);
                    if(count($arrParts) == 2){
                        $arrSectionData[$arrParts[0]] = $arrParts[1];
                    }else{
                       //die($strHeader . ' - ' . $strData);
                        $arrSectionData[$arrParts[0]] = '';
                    }
                }
            }
        }

        return $objProscore;

    }
    public function ImportIndOrg($objPSData){
        $objOrg = null;
        if(strlen($objPSData->ClubNum) > 1){
            $objOrg = Org::Query(
                sprintf(
                    'WHERE clubNum = %s',
                    $objPSData->ClubNum
                ),
                true
            );
        }

        if(!is_null(MLCAuthDriver::User())){
            $objOrg = Org::Query(
                sprintf(
                    'WHERE name = "%s" AND idImportAuthUser = %s',
                    $objPSData->__get('Official Name'),
                    MLCAuthDriver::IdUser()
                ),
                true
            );
        }
        if(is_null($objOrg)){
            $objOrg = new Org();
        }
        $objOrg->Name = $objPSData->__get('Official Name');


        $objOrg->IdImportAuthUser = MLCAuthDriver::IdUser();
        $objOrg->_PsData = $objPSData->__toJson();
        $objOrg->CreDate = MLCDateTime::Now();
        $objOrg->ClubNum = $objPSData->ClubNum;
        $objOrg->Save();
        $objPSData->DataEntity = $objOrg;
        return $objOrg;
    }
    public function ImportHostOrg($objPSData){
        $objOrg = Org::Query(
            sprintf(
                'WHERE  clubNum = %s',
                $objPSData->ProNumber
            ),
            true
        );
        if(is_null($objOrg)){
            $objOrg = new Org();
        }
        $objOrg->Name = $objPSData->__get('Facility');


        //$objOrg->IdImportAuthUser = MLCAuthDriver::IdUser();
        $objOrg->_PsData = $objPSData->__toJson();
        $objOrg->CreDate = MLCDateTime::Now();
        $objOrg->ClubNum = $objPSData->ProNumber;
        $objOrg->Save();
        $objPSData->DataEntity = $objOrg;
        return $objOrg;
    }
    public function ImportCompetitions(){
        $arrReturn = array();
        foreach($this->arrData['Meets'] as $intId => $objPSData){
            FFSForm::Org($this->ImportHostOrg($objPSData));
            $objCompetition = Competition::Query(
                sprintf(
                    'WHERE name = "%s" AND idOrg = %s',
                    $objPSData->Name,
                    FFSForm::Org()->IdOrg
                ),
                true
            );
            if(is_null($objCompetition)){
                $objCompetition = new Competition();
            }
            $objCompetition->Name = $objPSData->Name;
            $objCompetition->Namespace = FFSRewriteHandeler::ConvertToNamespace($objPSData->Name);
            $objCompetition->CreDate = MLCDateTime::Now();

            $objCompetition->StartDate =  MLCDateTime::Parse($objPSData->Start_Date);
            //_dv($objCompetition->StartDate);
            $objCompetition->EndDate = MLCDateTime::Parse($objPSData->End_Date);
            $objCompetition->IdOrg = FFSForm::Org()->IdOrg;

            $objCompetition->Save();
            $objPSData->DataEntity = $objCompetition;
            $arrReturn[] = $objCompetition;
            FFSForm::Competition($objCompetition);


            $this->ImportSessions();
        }
        return $arrReturn;
    }
    public function ImportSessions(){
        //Create Sessions
        $arrReturn = array();
        //_dv($this->arrData['Meets']);
        foreach($this->arrData['Sessions'] as $intId => $objPSData){
            $intIndex = (int)$objPSData->MeetID;
            if(!array_key_exists($intIndex, $this->arrData['Meets'])){
                //_dv($intIndex);
                //_dv(array_keys($this->arrData['Meets']));
                throw new Exception("No Meet with ID: " . $intIndex);
            }
            $intIdCompetition = $this->arrData['Meets'][(int)$intIndex]->DataEntity->IdCompetition;
            $objSession = Session::Query(
                sprintf(
                    'WHERE name = "%s" AND idCompetition = %s',
                    $objPSData->Session,
                    $intIdCompetition
                ),
                true
            );
            if(is_null($objSession)){
                $objSession = new Session();
            }
            //_dv($objPSData);
            $objSession->IdCompetition = $intIdCompetition;

            $objSession->Name = $objPSData->Session;
            $objSession->Notes = $objPSData->Desc;
            $objSession->StartDate =  MLCDateTime::Parse($objPSData->SDate . ' ' . $objPSData->Open_Warmup);
            //_dv($objSession->StartDate);
            $objSession->EndDate = MLCDateTime::Parse($objPSData->SDate . ' ' . $objPSData->Awards);
            $objSession->Save();
            $arrReturn[] = $objSession;
        }
        return $arrReturn;
    }
    public function ImportOrgs(){
        //Import Orgs
        $arrReturn = array();

        foreach($this->arrData['Gyms'] as $intId => $objPSData){
            $objOrg = $this->ImportIndOrg($objPSData);

            $arrReturn[] = $objOrg;

        }
        return $arrReturn;
    }


    //Import Coaches/Invite?
    public function ImportCoaches($objOrg){

    }

    //Import Athelete?
    public function ImportAtheletes($blnImportScores = true){

        $arrReturn = array();
        //_dv($this->arrData['Gymnasts']);
        foreach($this->arrData['Gymnasts'] as $intId => $objPSData){
            $objAthelete = Athelete::Query(
                sprintf(
                    'WHERE memType ="%s" AND memId = "%s"',
                    FFSMemType::USAG,
                    $objPSData->USAG
                ),
                true
            );
            if(is_null($objAthelete)){
                $objAthelete = new Athelete();
            }
            $objAthelete->FirstName = $objPSData->First_Name;
            $objAthelete->LastName = $objPSData->Last_Name;
            $objAthelete->BirthDate = MLCDateTime::Parse($objPSData->Birthday);
            $objAthelete->Level = $objPSData->Level;

            $objAthelete->MemType = FFSMemType::USAG;
            $objAthelete->MemId = $objPSData->USAG;

            $objOrg = $this->arrData['Gyms'][(int)$objPSData->Gym]->DataEntity;
            $objAthelete->IdOrg = $objOrg->IdOrg;


            $objAthelete->_PsData = $objPSData->__toJson();
            $objAthelete->CreDate = MLCDateTime::Now();
            $objAthelete->Save();
            $objPSData->DataEntity = $objAthelete;

            $arrReturn[] = $objAthelete;







            if($blnImportScores){
                $objEnrollment = $this->ImportAtheleteEnrollment($objAthelete, $objPSData);
                $this->ImportAtheleteScores($objAthelete, $objEnrollment, $objPSData);
            }

        }
        return $arrReturn;
    }
    public function ImportAtheleteEnrollment($objAthelete, $objPSData){
        //Create an enrolment for the athelete

        //Find the Competition
        $objCompetition = $this->arrData['Meets'][(int)$objPSData->MeetID]->DataEntity;

        $objSession = Session::Query(
            sprintf(
                'WHERE idCompetition = %s AND name = "%s"',
                $objCompetition->IdCompetition,
                $objPSData->Session
            ),
            true
        );
        $objEnrollment = Enrollment::Query(
            sprintf(
                'WHERE idSession = %s AND idAthelete = %s',
                $objSession->IdSession,
                $objAthelete->IdAthelete
            ),
            true
        );
        if(is_null($objEnrollment)){
            $objEnrollment = new Enrollment();
        }
        $objEnrollment->IdAthelete = $objAthelete->IdAthelete;
        $objEnrollment->IdCompetition = $objCompetition->IdCompetition;
        $objEnrollment->IdSession = $objSession->IdSession;
        $objEnrollment->Flight = $objPSData->Flight;
        $objEnrollment->Save();
        return $objEnrollment;
    }
    public function ImportAtheleteScores($objAthelete, $objEnrollment,  $objPSData = null){



        if(is_null($objPSData)){
            throw new Exception("Did not write this yet");
        }
        for($intEvent = 1; $intEvent <= 6; $intEvent++){

            $strEventName = $this->arrData['Events'][1]->__get('Event' . $intEvent);
            for($intJudge = 1; $intJudge <= 7; $intJudge++){
                $fltScore = $objPSData->__get(
                    'E' . $intEvent . 'S' . $intJudge
                );
                error_log("IMporting Result:" . 'E' . $intEvent . 'S' . $intJudge);
                if(strlen($fltScore) != 0){
                    $strJudgeName = $strEventName . '-judge-' . $intJudge;
                    $objResult = Result::Query(
                        sprintf(
                            'WHERE idAthelete = %s AND idSession = %s AND event = "%s" AND judge="%s"',
                            $objAthelete->IdAthelete,
                            $objEnrollment->IdSession,
                            $strEventName,
                            $strJudgeName

                        ),
                        true
                    );
                    if(is_null($objResult)){
                        $objResult = new Result();
                        $objResult->IdAthelete = $objAthelete->IdAthelete;
                        $objResult->IdSession = $objEnrollment->IdSession;
                        $objResult->CreDate = MLCDateTime::Now();
                    }

                    $objResult->Score = $fltScore;
                    $objResult->Judge = $strJudgeName;
                    $objResult->Event = $strEventName;

                    $objResult->Save();

                }
            }
        }
        //_dv("End");

    }
    /////////////////////////
    // Public Properties: GET
    /////////////////////////
    public function __get($strName)
    {
        switch ($strName) {
            case "Data":
                return $this->arrData;

            default:
                throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }

    /////////////////////////
    // Public Properties: SET
    /////////////////////////
    public function __set($strName, $mixValue)
    {
        switch ($strName) {

            case "Data":
                  return $this->arrData = $mixValue;
            default:
                throw new Exception("Not porperty exists with name '" . $strName . "' in class " . __CLASS__);
        }
    }

}