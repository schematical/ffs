<?php
class DeviceListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrDevices = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrDevices);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idDevice','idDevice');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('name','name');
	   		
		
	    	
	    	
	    	$this->AddColumn('token','token');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('inviteEmail','inviteEmail');
	   		
		
	    	
	    	
	    	$this->AddColumn('idOrg','idOrg');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/Device/' . $strActionParameter);
	}
	
  	
}
?>