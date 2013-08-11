<?php
class StripeDataListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrStripeDatas = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrStripeDatas);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idStripeData','idStripeData');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('data','data');
	   		
		
	    	
	    	
	    	$this->AddColumn('object','object');
	   		
		
	    	
	    	
	    	$this->AddColumn('idAuthUser','idAuthUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('idParentStripeData','idParentStripeData');
	   		
		
	    	
	    	
	    	$this->AddColumn('mode','mode');
	   		
		
	    	
	    	
	    	$this->AddColumn('instance_url','instance_url');
	   		
		
	    	
	    	
	    	$this->AddColumn('stripeId','stripeId');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/StripeData/' . $strActionParameter);
	}
	
  	
}
?>