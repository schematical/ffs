<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - Assignment()
* - Athelete()
* - Competition()
* - Device()
* - Enrollment()
* - Org()
* - ParentMessage()
* - Result()
* - Session()
* Classes list:
* - MLCApiHomeBase extends MLCApiClassBase
*/
class MLCApiHomeBase extends MLCApiClassBase {
    public function __construct() {
        MLCApiAuthDriver::Authenticate(false);
    }
    public function Assignment() {
        return new MLCApiAssignment();
    }
    public function Athelete() {
        return new MLCApiAthelete();
    }
    public function Competition() {
        return new MLCApiCompetition();
    }
    public function Device() {
        return new MLCApiDevice();
    }
    public function Enrollment() {
        return new MLCApiEnrollment();
    }
    public function Org() {
        return new MLCApiOrg();
    }
    public function ParentMessage() {
        return new MLCApiParentMessage();
    }
    public function Result() {
        return new MLCApiResult();
    }
    public function Session() {
        return new MLCApiSession();
    }
}
MLCApplicationBase::$arrClassFiles['MLCApiAssignment'] = __MODEL_APP_API__ . '/MLCApiAssignment.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiAssignmentObject'] = __MODEL_APP_API__ . '/MLCApiAssignmentObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiAthelete'] = __MODEL_APP_API__ . '/MLCApiAthelete.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiAtheleteObject'] = __MODEL_APP_API__ . '/MLCApiAtheleteObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiCompetition'] = __MODEL_APP_API__ . '/MLCApiCompetition.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiCompetitionObject'] = __MODEL_APP_API__ . '/MLCApiCompetitionObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiDevice'] = __MODEL_APP_API__ . '/MLCApiDevice.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiDeviceObject'] = __MODEL_APP_API__ . '/MLCApiDeviceObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiEnrollment'] = __MODEL_APP_API__ . '/MLCApiEnrollment.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiEnrollmentObject'] = __MODEL_APP_API__ . '/MLCApiEnrollmentObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiOrg'] = __MODEL_APP_API__ . '/MLCApiOrg.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiOrgObject'] = __MODEL_APP_API__ . '/MLCApiOrgObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiParentMessage'] = __MODEL_APP_API__ . '/MLCApiParentMessage.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiParentMessageObject'] = __MODEL_APP_API__ . '/MLCApiParentMessageObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiResult'] = __MODEL_APP_API__ . '/MLCApiResult.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiResultObject'] = __MODEL_APP_API__ . '/MLCApiResultObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiSession'] = __MODEL_APP_API__ . '/MLCApiSession.class.php';
MLCApplicationBase::$arrClassFiles['MLCApiSessionObject'] = __MODEL_APP_API__ . '/MLCApiSessionObject.class.php';
?>