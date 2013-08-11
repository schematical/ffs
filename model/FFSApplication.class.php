<?php
abstract class FFSApplication{
    public static $strMaxDispTime = '- 1 minute';
    public static function ImportPTF($strLoc){
        $objProscore = Proscore::ImportFromFile($strLoc);
        /*foreach($objProscore->Data as $strKey => $arrDataObjects){
            echo $strKey . '=>' .  count($arrDataObjects) . "\n";
        }*/
        //_dv($objProscore->Data['Gyms']);
        //Create Competions
        $objProscore->ImportCompetitions();
        $objProscore->ImportOrgs();
        $objProscore->ImportAtheletes();

    }
    public static function QueMessage($mixAthelete, $strMessage, $objCompetition = null, $objParentMessage = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::$objCompetition;
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
    public static function InviteMessage($strInviteData, $strInviteType, $objCompetition = null, $objParentMessage = null){
        if(is_null($objCompetition)){
            $objCompetition = FFSForm::$objCompetition;
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
    public static function CreateParentMessageTokens($intCt){
        $arrParentMessage = array();
        for($i = 0; $i < $intCt; $i++){
            $objParentMessage = new ParentMessage();
            $objParentMessage->CreDate = MLCDateTime::Now();
            $objParentMessage->IdUser = MLCAuthDriver::IdUser();
            $objParentMessage->Save();
            $arrParentMessage[] = $objParentMessage;
        }
        return $arrParentMessage;
    }
    public static function GetQuedMessages(){
        //Query
        $arrMessage = ParentMessage::Query(
            sprintf(
                'WHERE idCompetition = %s AND (dispDate > "%s" OR dispDate IS NULL)',
                FFSForm::$objCompetition->IdCompetition,
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
            $objCompetition = FFSForm::$objCompetition;
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
    public static function GetActiveCompetitons(){
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
}