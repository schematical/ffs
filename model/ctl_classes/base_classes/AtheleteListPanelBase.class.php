<?php
class AtheleteListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrAtheletes = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrAtheletes);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idAthelete','idAthelete');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idOrg','idOrg');
	   		
		
	    	
	    	
	    	$this->AddColumn('firstName','firstName');
	   		
		
	    	
	    	
	    	$this->AddColumn('lastName','lastName');
	   		
		
	    	
	    	
	    	$this->AddColumn('birthDate','birthDate');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Athelete/' . $strActionParameter);
	}
	
  	
}
?>