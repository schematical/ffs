<?php
class AssignmentListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrAssignments = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrAssignments);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idAssignment','idAssignment');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idDevice','idDevice');
	   		
		
	    	
	    	
	    	$this->AddColumn('idSession','idSession');
	   		
		
	    	
	    	
	    	$this->AddColumn('event','event');
	   		
		
	    	
	    	
	    	$this->AddColumn('apartatus','apartatus');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('idUser','idUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('revokeDate','revokeDate');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Assignment/' . $strActionParameter);
	}
	
  	
}
?>