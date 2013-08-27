<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - EnrollmentListPanel extends EnrollmentListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/EnrollmentListPanelBase.class.php");
class EnrollmentListPanel extends EnrollmentListPanelBase {
    public function __construct($objParentControl, $arrEnrollments = array()) {
        parent::__construct($objParentControl, $arrEnrollments);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
    }

    public function SetupCols(){
        
            
            //$this->AddColumn('idEnrollment','idEnrollment');

            $this->AddColumn('atheleteName','Athlete', $this, 'render_atheleteName');

            //$this->AddColumn('idCompetition','idCompetition');
            //$this->AddColumn('idSession','idSession');

            $this->AddColumn('flight','Flight');

            $this->AddColumn('division','Division');

            
            $this->AddColumn('ageGroup','Age Group');

            $this->AddColumn('level','Level');
            
            if(false){
                $this->AddColumn('misc1','misc1');
                $this->AddColumn('misc2','misc2');
                $this->AddColumn('misc3','misc3');
                $this->AddColumn('misc4','misc4');
                $this->AddColumn('misc5','misc5');

            }
            //$this->AddColumn('creDate','creDate');
            
            

            
        
    }
    public function render_atheleteName($intIdAthelete, $objRow){
        $intIdAthelete = $objRow->GetData('_entity')->IdAthelete;
        if(is_null($intIdAthelete)){
           return 'Unknown';
        }
        $objAthelete = Athelete::LoadById($intIdAthelete);
        $strReturn = $objAthelete->LastName . ', ' . $objAthelete->FirstName;
        return $strReturn;

    }

}
?>