<?php
require_once(__MODEL_APP_DATALAYER_DIR__ . "/base_classes/AtheleteBase.class.php");
class Athelete extends AtheleteBase {
    public function __toString(){
        return $this->LastName . ', ' . $this->FirstName;
    }
    public function CreateEnrollmentFromCompetition($objCompetition) {
        $objEnrollment = parent::CreateEnrollmentFromCompetition($objCompetition);
        $objEnrollment->Level = $this->Level;
        //TODO Figure out age groupings
        $objEnrollment->Save();
        return $objEnrollment;
    }
    public function CreateEnrollmentFromSession($objSession) {
        $objEnrollment = parent::CreateEnrollmentFromSession($objSession);
        $objEnrollment->Level = $this->Level;
        //TODO Figure out age groupings
        $objEnrollment->Save();
        return $objEnrollment;
    }

}


?>