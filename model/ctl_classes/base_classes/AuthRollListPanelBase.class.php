<?php
class AuthRollListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrAuthRolls = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrAuthRolls);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idAuthRoll','idAuthRoll');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idAuthUser','idAuthUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('idEntity','idEntity');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('entityType','entityType');
	   		
		
	    	
	    	
	    	$this->AddColumn('rollType','rollType');
	   		
		
	    	
	    	
	    	$this->AddColumn('data','data');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/AuthRoll/' . $strActionParameter);
	}
	
  	
}
?>