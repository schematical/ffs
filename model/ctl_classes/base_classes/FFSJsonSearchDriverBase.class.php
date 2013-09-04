<?php
/**
* Class and Function List:
* Function list:
* - InitForm()
* - GetAssignmentOwnerQuery()
* - _searchAssignment()
* - GetAtheleteOwnerQuery()
* - _searchAthelete()
* - GetCompetitionOwnerQuery()
* - _searchCompetition()
* - GetDeviceOwnerQuery()
* - _searchDevice()
* - GetEnrollmentOwnerQuery()
* - _searchEnrollment()
* - GetOrgOwnerQuery()
* - _searchOrg()
* - GetOrgCompetitionOwnerQuery()
* - _searchOrgCompetition()
* - GetParentMessageOwnerQuery()
* - _searchParentMessage()
* - GetResultOwnerQuery()
* - _searchResult()
* - GetSessionOwnerQuery()
* - _searchSession()
* Classes list:
* - FFSJsonSearchDriverBase
*/
class FFSJsonSearchDriverBase {
    public function InitForm(MJaxForm $objForm) {
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'assignment', '_searchAssignment', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'athelete', '_searchAthelete', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'competition', '_searchCompetition', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'device', '_searchDevice', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'enrollment', '_searchEnrollment', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'org', '_searchOrg', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'orgcompetition', '_searchOrgCompetition', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'parentmessage', '_searchParentMessage', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'result', '_searchResult', $this);
        $objForm->AddRoute(array(
            'get',
            'post'
        ) , 'session', '_searchSession', $this);
    }
    public function GetAssignmentOwnerQuery() {
        return '';
    }
    public function _searchAssignment($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'event')) {
            $arrOrConditions[] = sprintf('event LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'apartatus')) {
            $arrOrConditions[] = sprintf('apartatus LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetAssignmentOwnerQuery();
        $arrAssignments = Assignment::Query($strQuery);
        foreach ($arrAssignments as $strKey => $objAssignment) {
            $arrData[$strKey] = array(
                'value' => 'Assignment_' . $objAssignment->idAssignment,
                'text' => $objAssignment->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Device----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrDevices = Device::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrDevices as $objDevice) {
                    $arrData[] = array(
                        'value' => 'Device_' . $objDevice->GetId() ,
                        'text' => $objDevice->__toString()
                    );
                }
            }
            /*---------------End load: Device----------------------*/
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrSessions as $objSession) {
                    $arrData[] = array(
                        'value' => 'Session_' . $objSession->GetId() ,
                        'text' => $objSession->__toString()
                    );
                }
            }
            /*---------------End load: Session----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetAtheleteOwnerQuery() {
        return '';
    }
    public function _searchAthelete($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'firstName')) {
            $arrOrConditions[] = sprintf('firstName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'lastName')) {
            $arrOrConditions[] = sprintf('lastName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'memType')) {
            $arrOrConditions[] = sprintf('memType LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'memId')) {
            $arrOrConditions[] = sprintf('memId LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'level')) {
            $arrOrConditions[] = sprintf('level LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetAtheleteOwnerQuery();
        $arrAtheletes = Athelete::Query($strQuery);
        foreach ($arrAtheletes as $strKey => $objAthelete) {
            $arrData[$strKey] = array(
                'value' => 'Athelete_' . $objAthelete->idAthelete,
                'text' => $objAthelete->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrOrgs as $objOrg) {
                    $arrData[] = array(
                        'value' => 'Org_' . $objOrg->GetId() ,
                        'text' => $objOrg->__toString()
                    );
                }
            }
            /*---------------End load: Org----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetCompetitionOwnerQuery() {
        return '';
    }
    public function _searchCompetition($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'namespace')) {
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetCompetitionOwnerQuery();
        $arrCompetitions = Competition::Query($strQuery);
        foreach ($arrCompetitions as $strKey => $objCompetition) {
            $arrData[$strKey] = array(
                'value' => 'Competition_' . $objCompetition->idCompetition,
                'text' => $objCompetition->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrOrgs as $objOrg) {
                    $arrData[] = array(
                        'value' => 'Org_' . $objOrg->GetId() ,
                        'text' => $objOrg->__toString()
                    );
                }
            }
            /*---------------End load: Org----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetDeviceOwnerQuery() {
        return '';
    }
    public function _searchDevice($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'token')) {
            $arrOrConditions[] = sprintf('token LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteEmail')) {
            $arrOrConditions[] = sprintf('inviteEmail LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetDeviceOwnerQuery();
        $arrDevices = Device::Query($strQuery);
        foreach ($arrDevices as $strKey => $objDevice) {
            $arrData[$strKey] = array(
                'value' => 'Device_' . $objDevice->idDevice,
                'text' => $objDevice->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrOrgs as $objOrg) {
                    $arrData[] = array(
                        'value' => 'Org_' . $objOrg->GetId() ,
                        'text' => $objOrg->__toString()
                    );
                }
            }
            /*---------------End load: Org----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetEnrollmentOwnerQuery() {
        return '';
    }
    public function _searchEnrollment($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'flight')) {
            $arrOrConditions[] = sprintf('flight LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'division')) {
            $arrOrConditions[] = sprintf('division LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'ageGroup')) {
            $arrOrConditions[] = sprintf('ageGroup LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc1')) {
            $arrOrConditions[] = sprintf('misc1 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc2')) {
            $arrOrConditions[] = sprintf('misc2 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc3')) {
            $arrOrConditions[] = sprintf('misc3 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc4')) {
            $arrOrConditions[] = sprintf('misc4 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc5')) {
            $arrOrConditions[] = sprintf('misc5 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'level')) {
            $arrOrConditions[] = sprintf('level LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetEnrollmentOwnerQuery();
        $arrEnrollments = Enrollment::Query($strQuery);
        foreach ($arrEnrollments as $strKey => $objEnrollment) {
            $arrData[$strKey] = array(
                'value' => 'Enrollment_' . $objEnrollment->idEnrollment,
                'text' => $objEnrollment->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrAtheletes as $objAthelete) {
                    $arrData[] = array(
                        'value' => 'Athelete_' . $objAthelete->GetId() ,
                        'text' => $objAthelete->__toString()
                    );
                }
            }
            /*---------------End load: Athelete----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrCompetitions as $objCompetition) {
                    $arrData[] = array(
                        'value' => 'Competition_' . $objCompetition->GetId() ,
                        'text' => $objCompetition->__toString()
                    );
                }
            }
            /*---------------End load: Competition----------------------*/
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrSessions as $objSession) {
                    $arrData[] = array(
                        'value' => 'Session_' . $objSession->GetId() ,
                        'text' => $objSession->__toString()
                    );
                }
            }
            /*---------------End load: Session----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetOrgOwnerQuery() {
        return '';
    }
    public function _searchOrg($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'namespace')) {
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'clubNum')) {
            $arrOrConditions[] = sprintf('clubNum LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'clubType')) {
            $arrOrConditions[] = sprintf('clubType LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetOrgOwnerQuery();
        $arrOrgs = Org::Query($strQuery);
        foreach ($arrOrgs as $strKey => $objOrg) {
            $arrData[$strKey] = array(
                'value' => 'Org_' . $objOrg->idOrg,
                'text' => $objOrg->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetOrgCompetitionOwnerQuery() {
        return '';
    }
    public function _searchOrgCompetition($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetOrgCompetitionOwnerQuery();
        $arrOrgCompetitions = OrgCompetition::Query($strQuery);
        foreach ($arrOrgCompetitions as $strKey => $objOrgCompetition) {
            $arrData[$strKey] = array(
                'value' => 'OrgCompetition_' . $objOrgCompetition->idOrgCompetition,
                'text' => $objOrgCompetition->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrOrgs as $objOrg) {
                    $arrData[] = array(
                        'value' => 'Org_' . $objOrg->GetId() ,
                        'text' => $objOrg->__toString()
                    );
                }
            }
            /*---------------End load: Org----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrCompetitions as $objCompetition) {
                    $arrData[] = array(
                        'value' => 'Competition_' . $objCompetition->GetId() ,
                        'text' => $objCompetition->__toString()
                    );
                }
            }
            /*---------------End load: Competition----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetParentMessageOwnerQuery() {
        return '';
    }
    public function _searchParentMessage($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'atheleteName')) {
            $arrOrConditions[] = sprintf('atheleteName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteData')) {
            $arrOrConditions[] = sprintf('inviteData LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteType')) {
            $arrOrConditions[] = sprintf('inviteType LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteToken')) {
            $arrOrConditions[] = sprintf('inviteToken LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetParentMessageOwnerQuery();
        $arrParentMessages = ParentMessage::Query($strQuery);
        foreach ($arrParentMessages as $strKey => $objParentMessage) {
            $arrData[$strKey] = array(
                'value' => 'ParentMessage_' . $objParentMessage->idParentMessage,
                'text' => $objParentMessage->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrAtheletes as $objAthelete) {
                    $arrData[] = array(
                        'value' => 'Athelete_' . $objAthelete->GetId() ,
                        'text' => $objAthelete->__toString()
                    );
                }
            }
            /*---------------End load: Athelete----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrCompetitions as $objCompetition) {
                    $arrData[] = array(
                        'value' => 'Competition_' . $objCompetition->GetId() ,
                        'text' => $objCompetition->__toString()
                    );
                }
            }
            /*---------------End load: Competition----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetResultOwnerQuery() {
        return '';
    }
    public function _searchResult($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'score')) {
            $arrOrConditions[] = sprintf('score LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'judge')) {
            $arrOrConditions[] = sprintf('judge LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'event')) {
            $arrOrConditions[] = sprintf('event LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetResultOwnerQuery();
        $arrResults = Result::Query($strQuery);
        foreach ($arrResults as $strKey => $objResult) {
            $arrData[$strKey] = array(
                'value' => 'Result_' . $objResult->idResult,
                'text' => $objResult->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrSessions as $objSession) {
                    $arrData[] = array(
                        'value' => 'Session_' . $objSession->GetId() ,
                        'text' => $objSession->__toString()
                    );
                }
            }
            /*---------------End load: Session----------------------*/
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrAtheletes as $objAthelete) {
                    $arrData[] = array(
                        'value' => 'Athelete_' . $objAthelete->GetId() ,
                        'text' => $objAthelete->__toString()
                    );
                }
            }
            /*---------------End load: Athelete----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
    public function GetSessionOwnerQuery() {
        return '';
    }
    public function _searchSession($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'equipmentSet')) {
            $arrOrConditions[] = sprintf('equipmentSet LIKE "%s%%"', strtolower($strSearch));
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetSessionOwnerQuery();
        $arrSessions = Session::Query($strQuery);
        foreach ($arrSessions as $strKey => $objSession) {
            $arrData[$strKey] = array(
                'value' => 'Session_' . $objSession->idSession,
                'text' => $objSession->__toString()
            );
        }
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0)) {
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions));
                foreach ($arrCompetitions as $objCompetition) {
                    $arrData[] = array(
                        'value' => 'Competition_' . $objCompetition->GetId() ,
                        'text' => $objCompetition->__toString()
                    );
                }
            }
            /*---------------End load: Competition----------------------*/
        }
        if (count($arrData) == 0) {
            $arrData[] = array(
                'value' => $strSearch,
                'text' => $strSearch
            );
        }
        die(json_encode($arrData));
    }
}
