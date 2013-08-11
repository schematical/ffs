<?php
class SessionListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrSessions = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrSessions);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idSession','idSession');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('startDate','startDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('endDate','endDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('idCompetition','idCompetition');
	   		
		
	    	
	    	
	    	$this->AddColumn('name','name');
	   		
		
	    	
	    	
	    	$this->AddColumn('notes','notes');
	   		
		
	    	
	    	
	    	$this->AddColumn('data','data');
	   		
		
	    	
	    	
	    	$this->AddColumn('equipmentSet','equipmentSet');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Session/' . $strActionParameter);
	}
	
  	
}
?>