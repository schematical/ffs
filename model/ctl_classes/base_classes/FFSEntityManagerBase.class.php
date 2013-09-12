<?php
/**
* Class and Function List:
* Function list:
* - Populate()
* - Assignment()
* - Athelete()
* - Competition()
* - Device()
* - Enrollment()
* - Org()
* - OrgCompetition()
* - ParentMessage()
* - Result()
* - Session()
* - GetUrl()
* - GetAssignmentOwnerQuery()
* - SearchAssignment()
* - GetAtheleteOwnerQuery()
* - SearchAthelete()
* - GetCompetitionOwnerQuery()
* - SearchCompetition()
* - GetDeviceOwnerQuery()
* - SearchDevice()
* - GetEnrollmentOwnerQuery()
* - SearchEnrollment()
* - GetOrgOwnerQuery()
* - SearchOrg()
* - GetOrgCompetitionOwnerQuery()
* - SearchOrgCompetition()
* - GetParentMessageOwnerQuery()
* - SearchParentMessage()
* - GetResultOwnerQuery()
* - SearchResult()
* - GetSessionOwnerQuery()
* - SearchSession()
* Classes list:
* - FFSEntityManagerBase
*/
class FFSEntityManagerBase {
    protected $objAssignment = null;
    protected $objAthelete = null;
    protected $objCompetition = null;
    protected $objDevice = null;
    protected $objEnrollment = null;
    protected $objOrg = null;
    protected $objOrgCompetition = null;
    protected $objParentMessage = null;
    protected $objResult = null;
    protected $objSession = null;
    public function Populate() {
        $intIdAssignment = MLCApplication::QS(FFSQS::Assignment_IdAssignment);
        if (!is_null($intIdAssignment)) {
            $this->objAssignment = Assignment::Query('WHERE Assignment.idAssignment = ' . $intIdAssignment . ' ' . $this->GetAssignmentOwnerQuery() , true);
        }
        $intIdAthelete = MLCApplication::QS(FFSQS::Athelete_IdAthelete);
        if (!is_null($intIdAthelete)) {
            $this->objAthelete = Athelete::Query('WHERE Athelete.idAthelete = ' . $intIdAthelete . ' ' . $this->GetAtheleteOwnerQuery() , true);
        }
        $intIdCompetition = MLCApplication::QS(FFSQS::Competition_IdCompetition);
        if (!is_null($intIdCompetition)) {
            $this->objCompetition = Competition::Query('WHERE Competition.idCompetition = ' . $intIdCompetition . ' ' . $this->GetCompetitionOwnerQuery() , true);
        }
        $intIdDevice = MLCApplication::QS(FFSQS::Device_IdDevice);
        if (!is_null($intIdDevice)) {
            $this->objDevice = Device::Query('WHERE Device.idDevice = ' . $intIdDevice . ' ' . $this->GetDeviceOwnerQuery() , true);
        }
        $intIdEnrollment = MLCApplication::QS(FFSQS::Enrollment_IdEnrollment);
        if (!is_null($intIdEnrollment)) {
            $this->objEnrollment = Enrollment::Query('WHERE Enrollment.idEnrollment = ' . $intIdEnrollment . ' ' . $this->GetEnrollmentOwnerQuery() , true);
        }
        $intIdOrg = MLCApplication::QS(FFSQS::Org_IdOrg);
        if (!is_null($intIdOrg)) {
            $this->objOrg = Org::Query('WHERE Org.idOrg = ' . $intIdOrg . ' ' . $this->GetOrgOwnerQuery() , true);
        }
        $intIdOrgCompetition = MLCApplication::QS(FFSQS::OrgCompetition_IdOrgCompetition);
        if (!is_null($intIdOrgCompetition)) {
            $this->objOrgCompetition = OrgCompetition::Query('WHERE OrgCompetition.idOrgCompetition = ' . $intIdOrgCompetition . ' ' . $this->GetOrgCompetitionOwnerQuery() , true);
        }
        $intIdParentMessage = MLCApplication::QS(FFSQS::ParentMessage_IdParentMessage);
        if (!is_null($intIdParentMessage)) {
            $this->objParentMessage = ParentMessage::Query('WHERE ParentMessage.idParentMessage = ' . $intIdParentMessage . ' ' . $this->GetParentMessageOwnerQuery() , true);
        }
        $intIdResult = MLCApplication::QS(FFSQS::Result_IdResult);
        if (!is_null($intIdResult)) {
            $this->objResult = Result::Query('WHERE Result.idResult = ' . $intIdResult . ' ' . $this->GetResultOwnerQuery() , true);
        }
        $intIdSession = MLCApplication::QS(FFSQS::Session_IdSession);
        if (!is_null($intIdSession)) {
            $this->objSession = Session::Query('WHERE Session.idSession = ' . $intIdSession . ' ' . $this->GetSessionOwnerQuery() , true);
        }
    }
    public function Assignment(Assignment $objAssignment = null) {
        if (!is_null($objAssignment)) {
            $this->objAssignment = $objAssignment;
        } else {
            return $this->objAssignment;
        }
    }
    public function Athelete(Athelete $objAthelete = null) {
        if (!is_null($objAthelete)) {
            $this->objAthelete = $objAthelete;
        } else {
            return $this->objAthelete;
        }
    }
    public function Competition(Competition $objCompetition = null) {
        if (!is_null($objCompetition)) {
            $this->objCompetition = $objCompetition;
        } else {
            return $this->objCompetition;
        }
    }
    public function Device(Device $objDevice = null) {
        if (!is_null($objDevice)) {
            $this->objDevice = $objDevice;
        } else {
            return $this->objDevice;
        }
    }
    public function Enrollment(Enrollment $objEnrollment = null) {
        if (!is_null($objEnrollment)) {
            $this->objEnrollment = $objEnrollment;
        } else {
            return $this->objEnrollment;
        }
    }
    public function Org(Org $objOrg = null) {
        if (!is_null($objOrg)) {
            $this->objOrg = $objOrg;
        } else {
            return $this->objOrg;
        }
    }
    public function OrgCompetition(OrgCompetition $objOrgCompetition = null) {
        if (!is_null($objOrgCompetition)) {
            $this->objOrgCompetition = $objOrgCompetition;
        } else {
            return $this->objOrgCompetition;
        }
    }
    public function ParentMessage(ParentMessage $objParentMessage = null) {
        if (!is_null($objParentMessage)) {
            $this->objParentMessage = $objParentMessage;
        } else {
            return $this->objParentMessage;
        }
    }
    public function Result(Result $objResult = null) {
        if (!is_null($objResult)) {
            $this->objResult = $objResult;
        } else {
            return $this->objResult;
        }
    }
    public function Session(Session $objSession = null) {
        if (!is_null($objSession)) {
            $this->objSession = $objSession;
        } else {
            return $this->objSession;
        }
    }
    public function GetUrl($strBasePath, $arrExtraData = array()) {
        $arrQS = array();
        if (!is_null($this->objAssignment)) {
            $arrQS[FFSQS::Assignment_IdAssignment] = $this->objAssignment->getId();
        }
        if (!is_null($this->objAthelete)) {
            $arrQS[FFSQS::Athelete_IdAthelete] = $this->objAthelete->getId();
        }
        if (!is_null($this->objCompetition)) {
            $arrQS[FFSQS::Competition_IdCompetition] = $this->objCompetition->getId();
        }
        if (!is_null($this->objDevice)) {
            $arrQS[FFSQS::Device_IdDevice] = $this->objDevice->getId();
        }
        if (!is_null($this->objEnrollment)) {
            $arrQS[FFSQS::Enrollment_IdEnrollment] = $this->objEnrollment->getId();
        }
        if (!is_null($this->objOrg)) {
            $arrQS[FFSQS::Org_IdOrg] = $this->objOrg->getId();
        }
        if (!is_null($this->objOrgCompetition)) {
            $arrQS[FFSQS::OrgCompetition_IdOrgCompetition] = $this->objOrgCompetition->getId();
        }
        if (!is_null($this->objParentMessage)) {
            $arrQS[FFSQS::ParentMessage_IdParentMessage] = $this->objParentMessage->getId();
        }
        if (!is_null($this->objResult)) {
            $arrQS[FFSQS::Result_IdResult] = $this->objResult->getId();
        }
        if (!is_null($this->objSession)) {
            $arrQS[FFSQS::Session_IdSession] = $this->objSession->getId();
        }
        foreach ($arrExtraData as $strKey => $strData) {
            $arrQS[$strKey] = $strData;
        }
        return $strBasePath . '?' . http_build_query($arrQS);
    }
    public function GetAssignmentOwnerQuery() {
        return '';
    }
    public function SearchAssignment($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'event')) {
            $arrOrConditions[] = sprintf('Assignment_rel.event LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'apartatus')) {
            $arrOrConditions[] = sprintf('Assignment_rel.apartatus LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetAssignmentOwnerQuery();
        $arrAssignments = Assignment::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Device----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Device.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrDevices = Device::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetDeviceOwnerQuery());
                $arrAssignments = array_merge($arrAssignments, $arrDevices);
            }
            /*---------------End load: Device----------------------*/
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Session.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetSessionOwnerQuery());
                $arrAssignments = array_merge($arrAssignments, $arrSessions);
            }
            /*---------------End load: Session----------------------*/
        }
        return $arrAssignments;
    }
    public function GetAtheleteOwnerQuery() {
        return '';
    }
    public function SearchAthelete($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'firstName')) {
            $arrOrConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'lastName')) {
            $arrOrConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'memType')) {
            $arrOrConditions[] = sprintf('Athelete.memType LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'memId')) {
            $arrOrConditions[] = sprintf('Athelete.memId LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'level')) {
            $arrOrConditions[] = sprintf('Athelete.level LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetAtheleteOwnerQuery();
        $arrAtheletes = Athelete::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Org.namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Org.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetOrgOwnerQuery());
                $arrAtheletes = array_merge($arrAtheletes, $arrOrgs);
            }
            /*---------------End load: Org----------------------*/
        }
        return $arrAtheletes;
    }
    public function GetCompetitionOwnerQuery() {
        return '';
    }
    public function SearchCompetition($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('Competition.name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'namespace')) {
            $arrOrConditions[] = sprintf('Competition.namespace LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'clubType')) {
            $arrOrConditions[] = sprintf('Competition.clubType LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetCompetitionOwnerQuery();
        $arrCompetitions = Competition::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Org.namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Org.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetOrgOwnerQuery());
                $arrCompetitions = array_merge($arrCompetitions, $arrOrgs);
            }
            /*---------------End load: Org----------------------*/
        }
        return $arrCompetitions;
    }
    public function GetDeviceOwnerQuery() {
        return '';
    }
    public function SearchDevice($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('Device.name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'token')) {
            $arrOrConditions[] = sprintf('Device.token LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteEmail')) {
            $arrOrConditions[] = sprintf('Device.inviteEmail LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetDeviceOwnerQuery();
        $arrDevices = Device::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Org.namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Org.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetOrgOwnerQuery());
                $arrDevices = array_merge($arrDevices, $arrOrgs);
            }
            /*---------------End load: Org----------------------*/
        }
        return $arrDevices;
    }
    public function GetEnrollmentOwnerQuery() {
        return '';
    }
    public function SearchEnrollment($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'flight')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.flight LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'division')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.division LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'ageGroup')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.ageGroup LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc1')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.misc1 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc2')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.misc2 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc3')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.misc3 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc4')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.misc4 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'misc5')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.misc5 LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'level')) {
            $arrOrConditions[] = sprintf('Enrollment_rel.level LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetEnrollmentOwnerQuery();
        $arrEnrollments = Enrollment::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetAtheleteOwnerQuery());
                $arrEnrollments = array_merge($arrEnrollments, $arrAtheletes);
            }
            /*---------------End load: Athelete----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Competition.name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Competition.namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetCompetitionOwnerQuery());
                $arrEnrollments = array_merge($arrEnrollments, $arrCompetitions);
            }
            /*---------------End load: Competition----------------------*/
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Session.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetSessionOwnerQuery());
                $arrEnrollments = array_merge($arrEnrollments, $arrSessions);
            }
            /*---------------End load: Session----------------------*/
        }
        return $arrEnrollments;
    }
    public function GetOrgOwnerQuery() {
        return '';
    }
    public function SearchOrg($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'namespace')) {
            $arrOrConditions[] = sprintf('Org.namespace LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('Org.name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'clubNum')) {
            $arrOrConditions[] = sprintf('Org.clubNum LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'clubType')) {
            $arrOrConditions[] = sprintf('Org.clubType LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetOrgOwnerQuery();
        $arrOrgs = Org::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
        }
        return $arrOrgs;
    }
    public function GetOrgCompetitionOwnerQuery() {
        return '';
    }
    public function SearchOrgCompetition($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetOrgCompetitionOwnerQuery();
        $arrOrgCompetitions = OrgCompetition::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Org----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Org.namespace LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Org.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrOrgs = Org::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetOrgOwnerQuery());
                $arrOrgCompetitions = array_merge($arrOrgCompetitions, $arrOrgs);
            }
            /*---------------End load: Org----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Competition.name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Competition.namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetCompetitionOwnerQuery());
                $arrOrgCompetitions = array_merge($arrOrgCompetitions, $arrCompetitions);
            }
            /*---------------End load: Competition----------------------*/
        }
        return $arrOrgCompetitions;
    }
    public function GetParentMessageOwnerQuery() {
        return '';
    }
    public function SearchParentMessage($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'atheleteName')) {
            $arrOrConditions[] = sprintf('ParentMessage.atheleteName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'fromName')) {
            $arrOrConditions[] = sprintf('ParentMessage.fromName LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteData')) {
            $arrOrConditions[] = sprintf('ParentMessage.inviteData LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteType')) {
            $arrOrConditions[] = sprintf('ParentMessage.inviteType LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'inviteToken')) {
            $arrOrConditions[] = sprintf('ParentMessage.inviteToken LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetParentMessageOwnerQuery();
        $arrParentMessages = ParentMessage::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetAtheleteOwnerQuery());
                $arrParentMessages = array_merge($arrParentMessages, $arrAtheletes);
            }
            /*---------------End load: Athelete----------------------*/
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Competition.name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Competition.namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetCompetitionOwnerQuery());
                $arrParentMessages = array_merge($arrParentMessages, $arrCompetitions);
            }
            /*---------------End load: Competition----------------------*/
        }
        return $arrParentMessages;
    }
    public function GetResultOwnerQuery() {
        return '';
    }
    public function SearchResult($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'score')) {
            $arrOrConditions[] = sprintf('Result.score LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'judge')) {
            $arrOrConditions[] = sprintf('Result.judge LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'event')) {
            $arrOrConditions[] = sprintf('Result.event LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetResultOwnerQuery();
        $arrResults = Result::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Session----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Session.name LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrSessions = Session::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetSessionOwnerQuery());
                $arrResults = array_merge($arrResults, $arrSessions);
            }
            /*---------------End load: Session----------------------*/
            /*---------------Load by parent field: Athelete----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Athelete.firstName LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Athelete.lastName LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrAtheletes = Athelete::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetAtheleteOwnerQuery());
                $arrResults = array_merge($arrResults, $arrAtheletes);
            }
            /*---------------End load: Athelete----------------------*/
        }
        return $arrResults;
    }
    public function GetSessionOwnerQuery() {
        return '';
    }
    public function SearchSession($strSearch, $strField = null) {
        $arrData = array();
        $arrOrConditions = array();
        if ((is_null($strField)) || ($strField == 'name')) {
            $arrOrConditions[] = sprintf('Session.name LIKE "%s%%"', strtolower($strSearch));
        }
        if ((is_null($strField)) || ($strField == 'equipmentSet')) {
            $arrOrConditions[] = sprintf('Session.equipmentSet LIKE "%s%%"', strtolower($strSearch));
        }
        if (count($arrOrConditions) == 0) {
            $arrOrConditions[] = '1';
        }
        $strQuery = ' WHERE (' . implode(' OR ', $arrOrConditions) . ')' . $this->GetSessionOwnerQuery();
        $arrSessions = Session::Query($strQuery);
        if ((!is_null($strSearch)) && (strlen($strSearch) > 0) && (is_null($strField))) {
            /*---------------Load by parent field: Competition----------------------*/
            $arrOrConditions = array();
            $arrOrConditions[] = sprintf('Competition.name LIKE "%s%%"', strtolower($strSearch));
            $arrOrConditions[] = sprintf('Competition.namespace LIKE "%s%%"', strtolower($strSearch));
            if (count($arrOrConditions) > 0) {
                $arrCompetitions = Competition::Query('WHERE ' . implode(' OR ', $arrOrConditions) . ' ' . $this->GetCompetitionOwnerQuery());
                $arrSessions = array_merge($arrSessions, $arrCompetitions);
            }
            /*---------------End load: Competition----------------------*/
        }
        return $arrSessions;
    }
}
