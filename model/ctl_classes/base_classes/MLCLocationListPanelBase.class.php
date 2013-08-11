<?php
class MLCLocationListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrMLCLocations = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrMLCLocations);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idLocation','idLocation');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('shortDesc','shortDesc');
	   		
		
	    	
	    	
	    	$this->AddColumn('address1','address1');
	   		
		
	    	
	    	
	    	$this->AddColumn('address2','address2');
	   		
		
	    	
	    	
	    	$this->AddColumn('city','city');
	   		
		
	    	
	    	
	    	$this->AddColumn('state','state');
	   		
		
	    	
	    	
	    	$this->AddColumn('zip','zip');
	   		
		
	    	
	    	
	    	$this->AddColumn('country','country');
	   		
		
	    	
	    	
	    	$this->AddColumn('lat','lat');
	   		
		
	    	
	    	
	    	$this->AddColumn('lng','lng');
	   		
		
	    	
	    	
	    	$this->AddColumn('idAccount','idAccount');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/MLCLocation/' . $strActionParameter);
	}
	
  	
}
?>