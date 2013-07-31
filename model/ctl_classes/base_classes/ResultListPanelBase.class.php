<?php
class ResultListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrResults = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrResults);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idResult','idResult');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idSession','idSession');
	   		
		
	    	
	    	
	    	$this->AddColumn('idAthelete','idAthelete');
	   		
		
	    	
	    	
	    	$this->AddColumn('score','score');
	   		
		
	    	
	    	
	    	$this->AddColumn('judge','judge');
	   		
		
	    	
	    	
	    	$this->AddColumn('flag','flag');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Result/' . $strActionParameter);
	}
	
  	
}
?>