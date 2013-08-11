<?php
class OrgListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrOrgs = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrOrgs);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idOrg','idOrg');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('namespace','namespace');
	   		
		
	    	
	    	
	    	$this->AddColumn('name','name');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('psData','psData');
	   		
		
	    	
	    	
	    	$this->AddColumn('idImportAuthUser','idImportAuthUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('clubNum','clubNum');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Org/' . $strActionParameter);
	}
	
  	
}
?>