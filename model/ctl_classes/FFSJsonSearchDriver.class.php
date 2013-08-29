<?php
/**
* Class and Function List:
* Function list:
* - _searchAssignment()
* - _searchAthelete()
* - _searchCompetition()
* - _searchDevice()
* - _searchEnrollment()
* - _searchOrg()
* - _searchParentMessage()
* - _searchResult()
* - _searchSession()
* Classes list:
* - FFSJsonSearchDriver
*/
class FFSJsonSearchDriver {
    public function _searchAssignment($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('event LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('apartatus LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrAssignments = Assignment::Query($strQuery);
        foreach ($arrAssignments as $strKey => $objAssignment) {
            $arrData[$strKey] = array(
                'value' => 'Assignment_' . $objAssignment->idAssignment,
                'text' => $objAssignment->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrDevices as $strKey => $objDevice){
                             $arrData[$strKey] = array(
                                    'value'=>$objDevice->GetId(),
                                    'text'=>$objDevice->Name
                             );
                         }
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrSessions as $strKey => $objSession){
                             $arrData[$strKey] = array(
                                    'value'=>$objSession->GetId(),
                                    'text'=>$objSession->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchAthelete($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('firstName LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('lastName LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('memType LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('memId LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('level LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrAtheletes = Athelete::Query($strQuery);
        foreach ($arrAtheletes as $strKey => $objAthelete) {
            $arrData[$strKey] = array(
                'value' => 'Athelete_' . $objAthelete->idAthelete,
                'text' => $objAthelete->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrOrgs as $strKey => $objOrg){
                             $arrData[$strKey] = array(
                                    'value'=>$objOrg->GetId(),
                                    'text'=>$objOrg->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchCompetition($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrCompetitions = Competition::Query($strQuery);
        foreach ($arrCompetitions as $strKey => $objCompetition) {
            $arrData[$strKey] = array(
                'value' => 'Competition_' . $objCompetition->idCompetition,
                'text' => $objCompetition->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrOrgs as $strKey => $objOrg){
                             $arrData[$strKey] = array(
                                    'value'=>$objOrg->GetId(),
                                    'text'=>$objOrg->Name
                             );
                         }
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchDevice($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('token LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('inviteEmail LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrDevices = Device::Query($strQuery);
        foreach ($arrDevices as $strKey => $objDevice) {
            $arrData[$strKey] = array(
                'value' => 'Device_' . $objDevice->idDevice,
                'text' => $objDevice->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
               
                    
               
                    
               
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrOrgs as $strKey => $objOrg){
                             $arrData[$strKey] = array(
                                    'value'=>$objOrg->GetId(),
                                    'text'=>$objOrg->Name
                             );
                         }
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchEnrollment($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('flight LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('division LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('ageGroup LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('misc1 LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('misc2 LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('misc3 LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('misc4 LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('misc5 LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('level LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrEnrollments = Enrollment::Query($strQuery);
        foreach ($arrEnrollments as $strKey => $objEnrollment) {
            $arrData[$strKey] = array(
                'value' => 'Enrollment_' . $objEnrollment->idEnrollment,
                'text' => $objEnrollment->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrAtheletes as $strKey => $objAthelete){
                             $arrData[$strKey] = array(
                                    'value'=>$objAthelete->GetId(),
                                    'text'=>$objAthelete->Name
                             );
                         }
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrCompetitions as $strKey => $objCompetition){
                             $arrData[$strKey] = array(
                                    'value'=>$objCompetition->GetId(),
                                    'text'=>$objCompetition->Name
                             );
                         }
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrSessions as $strKey => $objSession){
                             $arrData[$strKey] = array(
                                    'value'=>$objSession->GetId(),
                                    'text'=>$objSession->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchOrg($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('clubNum LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrOrgs = Org::Query($strQuery);
        foreach ($arrOrgs as $strKey => $objOrg) {
            $arrData[$strKey] = array(
                'value' => 'Org_' . $objOrg->idOrg,
                'text' => $objOrg->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchParentMessage($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('atheleteName LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('inviteData LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('inviteType LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('inviteToken LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrParentMessages = ParentMessage::Query($strQuery);
        foreach ($arrParentMessages as $strKey => $objParentMessage) {
            $arrData[$strKey] = array(
                'value' => 'ParentMessage_' . $objParentMessage->idParentMessage,
                'text' => $objParentMessage->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrAtheletes as $strKey => $objAthelete){
                             $arrData[$strKey] = array(
                                    'value'=>$objAthelete->GetId(),
                                    'text'=>$objAthelete->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrCompetitions as $strKey => $objCompetition){
                             $arrData[$strKey] = array(
                                    'value'=>$objCompetition->GetId(),
                                    'text'=>$objCompetition->Name
                             );
                         }
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchResult($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('score LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('judge LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('event LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrResults = Result::Query($strQuery);
        foreach ($arrResults as $strKey => $objResult) {
            $arrData[$strKey] = array(
                'value' => 'Result_' . $objResult->idResult,
                'text' => $objResult->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrSessions as $strKey => $objSession){
                             $arrData[$strKey] = array(
                                    'value'=>$objSession->GetId(),
                                    'text'=>$objSession->Name
                             );
                         }
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrAtheletes as $strKey => $objAthelete){
                             $arrData[$strKey] = array(
                                    'value'=>$objAthelete->GetId(),
                                    'text'=>$objAthelete->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
    public function _searchSession($objRoute) {
        $strSearch = $_POST['search'];
        $arrData = array();
        $arrOrConditions = array();
        $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        $arrOrConditions[] = sprintf('equipmentSet LIKE "%s%%"', strtolower($strSearch));
        $strQuery = ' WHERE ' . implode(' OR ', $arrOrConditions);
        $arrSessions = Session::Query($strQuery);
        foreach ($arrSessions as $strKey => $objSession) {
            $arrData[$strKey] = array(
                'value' => 'Session_' . $objSession->idSession,
                'text' => $objSession->__toString()
            );
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        /*
              
                    
               
                    
               
                    
               
                    
                         $arrAndConditions[] = sprintf(
                               'WHERE name LIKE "%s%%" or namespace LIKE "%s%%"',
                               strtolower($strSearch),
                               strtolower($strSearch)
                         );
                         foreach($arrCompetitions as $strKey => $objCompetition){
                             $arrData[$strKey] = array(
                                    'value'=>$objCompetition->GetId(),
                                    'text'=>$objCompetition->Name
                             );
                         }
                    
               
                    
               
                    
               
                    
               
                    
               
                    
               
        */
        die(json_encode($arrData));
    }
}
