<?php
/**
* Class and Function List:
* Function list:
* - __call()
* Classes list:
* - MLCApiCompetitionObjectBase extends MLCApiObjectBase
*/
class MLCApiCompetitionObjectBase extends MLCApiObjectBase {
    protected $strClassName = 'Competition';
    public function __call($strName, $arrArguments) {
        switch ($strName) {
            case ('Competition'):
                //Load
                $objOrg = $this->GetEntity()->IdOrg;
                return new MLCApiOrgObject($objIdOrg);
            break;
            case ('enrollments'):
                $arrEnrollments = Enrollment::LoadCollByIdCompetition($this->GetEntity()->idCompetition)->GetCollection();
                return new MLCApiResponse($arrEnrollments);
            break;
            case ('orgcompetitions'):
                $arrOrgCompetitions = OrgCompetition::LoadCollByIdCompetition($this->GetEntity()->idCompetition)->GetCollection();
                return new MLCApiResponse($arrOrgCompetitions);
            break;
            case ('parentmessages'):
                $arrParentMessages = ParentMessage::LoadCollByIdCompetition($this->GetEntity()->idCompetition)->GetCollection();
                return new MLCApiResponse($arrParentMessages);
            break;
            case ('sessions'):
                $arrSessions = Session::LoadCollByIdCompetition($this->GetEntity()->idCompetition)->GetCollection();
                return new MLCApiResponse($arrSessions);
            break;
            default:
                return parent::__call($strName, $arrArguments);
        }
    }
}
