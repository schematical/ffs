<?php
class EnrollmentListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrEnrollments = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrEnrollments);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idEnrollment','idEnrollment');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idAthelete','idAthelete');
	   		
		
	    	
	    	
	    	$this->AddColumn('idCompetition','idCompetition');
	   		
		
	    	
	    	
	    	$this->AddColumn('idSession','idSession');
	   		
		
	    	
	    	
	    	$this->AddColumn('flight','flight');
	   		
		
	    	
	    	
	    	$this->AddColumn('division','division');
	   		
		
	    	
	    	
	    	$this->AddColumn('ageGroup','ageGroup');
	   		
		
	    	
	    	
	    	$this->AddColumn('misc1','misc1');
	   		
		
	    	
	    	
	    	$this->AddColumn('misc2','misc2');
	   		
		
	    	
	    	
	    	$this->AddColumn('misc3','misc3');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Enrollment/' . $strActionParameter);
	}
	
  	
}
?>