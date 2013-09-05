<?php
abstract class FFSApplication{
    const ORG_INCOME_PERCENT = .5;

    public static $strMaxDispTime = '- 1 minute';
    public static function SortChronologically($arrEntities, $strDateField = 'CreDate'){

        $arrReturn = array();

        foreach($arrEntities as $intIndex => $objEntity){

            try{
                $intTime = strtotime($objEntity->$strDateField);
            }catch(Exception $e){
                throw new Exception("Objects(" . get_class($objEntity) . ") passed in to this method must have a '" . $strDateField . "'");
            }
            while(array_key_exists($intTime, $arrReturn)){
                $intTime += 1;
            }

            $arrReturn[$intTime] = $objEntity;
        }
        return array_values($arrReturn);

    }
    public static function GetEnrollmentsBySession($objSession, $strSearch = null){

    }
    public static function GetDevicesByOrg($objOrg = null, $strSearch = null){
        if(is_null($objOrg)){
            $objOrg = FFSForm::Org();
        }
        $arrDevices = Device::Query(
            sprintf(
                'WHERE idOrg = %s AND (name LIKE "%s%%" OR inviteEmail LIKE "%s%%")',
                $objOrg->IdOrg,
                $strSearch,
                $strSearch
            )
        );
        return $arrDevices;
    }
    public static function GetDevicesByCompetiton($objCompetition = null, $strSearch = null){
        $arrSessions = self::GetActiveSessions($objCompetition);

        $arrReturn = array();
        foreach($arrSessions as $objSession){
            $arrAssignments = Assignment::LoadCollByIdSession($objSession->IdSession)->getCollection();

            foreach($arrAssignments as $intIndex => $objAssignment){

                if(!array_key_exists($objAssignment->IdDevice, $arrReturn)){
                    $arrReturn[$objAssignment->IdDevice] = $objAssignment->IdDeviceObject;
                }
            }
        }

        return $arrReturn;
    }
    public static function GetResultsBySessionGroupByAthelete($objSession){
        $arrResults = Result::LoadCollByIdSession($objSession->IdSession)->getCollection();
        //die("fuck");
        $arrAtheleteResults = array();
        foreach($arrResults as $intIndex => $objResult){
            if(!array_key_exists($objResult->IdAthelete, $arrAtheleteResults)){
                $arrAtheleteResults[$objResult->IdAthelete] = array();
            }
            $arrAtheleteResults[$objResult->IdAthelete][] = $objResult;
        }
        //_dk($arrAtheleteResults);
        return $arrAtheleteResults;
    }
    public static function GetAssignmentsByCompetiton($objCompetition = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::Competition();
        }
        if(is_null($objCompetition)){
            throw new Exception("Must pass in a valid competition");
        }
        $arrReturn = array();
        //Load all sessions for a competition
        $arrSessions = Session::LoadCollByIdCompetition(
            $objCompetition->IdCompetition
        )->GetCollection();
        //Do a merge by id
        foreach($arrSessions as $intIndex => $objSession){
            $arrAssignments = Assignment::LoadCollByIdSession($objSession->IdSession)->GetCollection();
            $arrReturn = array_merge($arrAssignments, $arrReturn);
        }
        return $arrReturn;
    }

    public static function GetOrgs(){
        return MLCAuthDriver::GetRolls(FFSRoll::ORG_MANAGER);
    }
    public static function ImportPTF($strLoc){
        $objProscore = Proscore::ImportFromFile($strLoc);
        /*foreach($objProscore->Data as $strKey => $arrDataObjects){
            echo $strKey . '=>' .  count($arrDataObjects) . "\n";
        }*/
        //_dv($objProscore->Data['Gyms']);
        //Create Competions
        //echo("h1\n");
        $arrComp = $objProscore->ImportCompetitions();
        //echo("h2\n");
        //if(!is_null(MLCAuthDriver::User())){
        $arrOrgs = $objProscore->ImportOrgs();
        //echo("h3\n");
        //}
        $arrAtheltes = $objProscore->ImportAtheletes(
            !is_null(MLCAuthDriver::User())
        );
        //echo("h4\n");

    }
    public static function QueMessage($mixAthelete, $strMessage, $objCompetition = null, $objParentMessage = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::Competition();
        }
        if(is_string($objParentMessage)){
            $objParentMessage = ParentMessage::LoadSingleByField('token', $objParentMessage);
        }
        if(is_null($objParentMessage)){
            //Load a message token
            $objParentMessage = FFSApplication::GetAvailableMessageToken();
        }
        if(is_null($objParentMessage)){
            throw new Exception("You do not have enough Message Credits to do this operation");
        }
        $objParentMessage->Message = $strMessage;
        if(is_int($mixAthelete)){
            $mixAthelete = Athelete::LoadById($mixAthelete);
        }
        if(is_object($mixAthelete)){
            $objParentMessage->IdAthelete = $mixAthelete;
            $objParentMessage->AtheleteName = $mixAthelete->FirstName . ' ' . $mixAthelete->LastName;
        }
        if(is_string($mixAthelete)){
            $objParentMessage->AtheleteName = $mixAthelete;
        }

        $objParentMessage->QueDate = MLCDateTime::Now();
        $objParentMessage->IdCompetition = $objCompetition->IdCompetition;
        $objParentMessage->Save();
        return $objParentMessage;

    }
    public static function InviteDevice($strEmail, $strName = null){
        $objDevice = new Device();
        $objDevice->InviteEmail = $strEmail;
        $objDevice->IdOrg = FFSForm::Org()->IdOrg;
        $objDevice->CreDate=  MLCDateTime::Now();
        $objDevice->Token = rand(0,9999) .'-'. time();
        $objDevice->Name = $strName;
        $objDevice->Save();


        return $objDevice;
    }
    public static function UnqueMessage($objParentMessage){
        if(!is_null($objParentMessage)){
            $objParentMessage->QueDate = null;
            $objParentMessage->Save();
        }
        //Prob should send message to Sender

    }
    public static function InviteMessage($strInviteData, $strInviteType, $objCompetition = null, $objParentMessage = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::Competition();
        }
        if(is_null($objParentMessage)){
            //Load a message token
            $objParentMessage = FFSApplication::GetAvailableMessageTokens();
        }
        if(is_null($objParentMessage)){
            throw new Exception("You do not have enough Message Credits to do this operation");
        }

        $objParentMessage->InviteData = $strInviteData;
        $objParentMessage->InviteType = $strInviteType;
        $objParentMessage->InviteToken = time() . '-' . rand(0,9999);
        $objParentMessage->IdCompetition = $objCompetition->IdCompetition;
        $objParentMessage->Save();

        //Send Actual Invite

        switch($objParentMessage->InviteType){
            case(FFSInviteType::EMAIL):
            default:
                MLCApplication::InitPackage('MLCPostmark');
                $objEmail = MLCPostmarkDriver::ComposeFromTemplate(
                    __ASSETS_ACTIVE_APP_DIR__ . '/email/Invite.email.php',
                    array(
                        'PARENT_MESSAGE' => $objParentMessage
                    )
                );
                $objEmail->addTo(
                    $objParentMessage->InviteData
                );
                $objEmail->Subject('Cheer on ' . $objParentMessage->AtheleteName);
                $objEmail->Send();
            break;
        }

        return $objParentMessage;

    }
    public static function GetAvailableMessageTokens($blnAsArray = false){
        if(is_null(MLCAuthDriver::User())){
            if($blnAsArray){
                return array();
            }else{
                return null;
            }
        }
        return ParentMessage::Query(
            sprintf(
                'WHERE idUser = %s AND (queDate IS NULL AND inviteViewDate IS NULL)',
                MLCAuthDriver::IdUser()
            ),
            !$blnAsArray
        );
    }
    public static function CreateParentMessageTokens($intCt, $objStripeData = null){
        $arrParentMessage = array();
        for($i = 0; $i < $intCt; $i++){
            $objParentMessage = new ParentMessage();
            $objParentMessage->CreDate = MLCDateTime::Now();
            $objParentMessage->IdUser = MLCAuthDriver::IdUser();
            if(!is_null($objStripeData)){
                $objParentMessage->IdStripeData = $objStripeData->IdStripeData;
            }
            $objParentMessage->Save();
            $arrParentMessage[] = $objParentMessage;
        }
        return $arrParentMessage;
    }
    public static function GetCompetitionIncomeTotal($objCompetition){
        MLCApplication::InitPackage('MLCStripe');
        $arrParentMessages = ParentMessage::LoadCollByIdCompetition($objCompetition->IdCompetition)->getCollection();
        $arrStripeData = array();
        foreach($arrParentMessages as $intIndex => $objParentMessage){
            if(
                (!is_null($objParentMessage->IdStripeData)) &&
                (!array_key_exists($objParentMessage->IdStripeData, $arrStripeData))
            ){
                $arrStripeData[$objParentMessage->IdStripeData] = StripeData::LoadById($objParentMessage->IdStripeData);
            }
        }
        $fltTotal = 0;
        foreach($arrStripeData as $intIdStripeData => $objStripeData){
            $arrData = json_decode($objStripeData->Data, true);
            $fltTotal += $arrData['amount']/100;
        }
        return $fltTotal;
    }
    public static function GetCompetitionIncomeForOrg($objCompetition){
        $fltTotal = self::GetCompetitionIncomeTotal($objCompetition);
        return $fltTotal * self::ORG_INCOME_PERCENT;
    }
    public static function GetQuedMessages(){
        //Query
        $arrMessage = ParentMessage::Query(
            sprintf(
                'WHERE idCompetition = %s AND (dispDate > "%s" OR dispDate IS NULL)',
                FFSForm::Competition()->IdCompetition,
                MLCDateTime::Now(self::$strMaxDispTime)
            )
        );
        return $arrMessage;

    }
    public static function GetQuedResult($arrEquipmentSet = array()){
        //Query
        $arrSessions = self::GetActiveSessions(null, $arrEquipmentSet);

        //_dv($arrSessions);
        $arrReturn = array();
        foreach($arrSessions as $intIndex => $objSession){
            $arrResult = Result::Query(
                sprintf(
                    'WHERE idSession = %s AND (dispDate > "%s" OR dispDate IS NULL)',
                    $objSession->IdSession,
                    MLCDateTime::Now(self::$strMaxDispTime)
                )
            );
            //_dv($arrResult);
            foreach($arrResult as $intIndex2 => $objResult){
                $strKey = $objResult->IdAthelete . '-' . $objResult->Event;
                if(!array_key_exists($strKey, $arrReturn)){
                    $arrReturn[$strKey] = array();
                }
                $arrReturn[$strKey][$objResult->Judge] = $objResult;
            }
        }
        return $arrReturn;

    }
    public static function AvgResults($arrResults){
        $intIdAthelete = null;
        $strEventName = null;
        $intIdSession = null;
        //These three must match or throw an exception
        $fltTotal = 0;
        foreach($arrResults as $strJudgeName => $objResult){
            if(is_null($intIdAthelete)){
                $intIdAthelete = $objResult->IdAthelete;
                $strEventName = $objResult->Event;
                $intIdSession = $objResult->IdSession;
            }else{
                if(
                    $intIdAthelete != $objResult->IdAthelete ||
                    $strEventName != $objResult->Event ||
                    $intIdSession != $objResult->Session
                ){
                    throw new Exception("Cannot avg scores that are not from a single athelete on a single session on an event");
                }
            }
            $fltTotal += $objResult->Score;
        }
        return $fltTotal/count($arrResults);
    }
    public static function GetActiveSessions($objCompetition = null, $arrEquipmentSet = array()){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::Competition();
        }
        if(is_null($objCompetition)){
            throw new Exception("No valid competition passed in");
        }
        $strQuery = sprintf(
            ' WHERE idCompetition = %s AND startDate < "%s" AND endDate > "%s"',
            $objCompetition->IdCompetition,
            MLCDateTime::Now(),
            MLCDateTime::Now()
        );
        if(count($arrEquipmentSet) > 0){
            $strQuery .= sprintf(
                ' AND equipmentSet IN "%s"',
                implode('","',$arrEquipmentSet)
            );
        }
        $arrSessions = Session::Query(
            $strQuery
        );
        return $arrSessions;
    }
    public static function GetActiveCompetitions(){
        //Get user orgs by roll
        $arrRolls = MLCAuthDriver::GetRolls(FFSRoll::ORG_MANAGER);
        //_dv($arrRolls);
        $arrComp = array();
        foreach($arrRolls as $intIndex => $objRoll){

            $arrComp = array_merge(
                $arrComp,
                Competition::Query(
                    sprintf(
                        'WHERE idOrg = %s AND 1',
                        $objRoll->GetEntity()->IdOrg
                    )
                )
            );
        }

        return $arrComp;
    }
    public static function GetInvitedOrgsByCompetition(Competition $objCompetition = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::Competition();
        }
        $arrOrgCompetitions = OrgCompetition::LoadCollByIdCompetition($objCompetition->IdCompetition)->getCollection();

        $arrOrgs = array();
        foreach($arrOrgCompetitions as $objOrgCompetition){
            $arrOrgs[] = $objOrgCompetition->IdOrgObject;
        }
        return $arrOrgs;
    }
    public static function InviteOrgToCompetition(Org $objOrg, Competition $objCompetition){

        $objOrgCompetition = OrgCompetition::Query(
            sprintf(
                'WHERE idOrg = %s AND idCompetition = %s',
                $objOrg->IdOrg,
                $objCompetition->IdCompetition
            )
        );
        $objOrgCompetition = new OrgCompetition();
        $objOrgCompetition->IdOrg = $objOrg->IdOrg;
        $objOrgCompetition->IdCompetition = $objCompetition->IdCompetition;
        $objOrgCompetition->CreDate = MLCDateTime::Now();
        $objOrgCompetition->IdAuthUser = MLCAuthDriver::IdUser();
        $objOrgCompetition->Save();
        return $objOrgCompetition;
    }
}