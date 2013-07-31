<?php
class CompetitionListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrCompetitions = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrCompetitions);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idCompetition','idCompetition');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('name','name');
	   		
		
	    	
	    	
	    	$this->AddColumn('longDesc','longDesc');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('startDate','startDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('endDate','endDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('idOrg','idOrg');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Competition/' . $strActionParameter);
	}
	
  	
}
?>