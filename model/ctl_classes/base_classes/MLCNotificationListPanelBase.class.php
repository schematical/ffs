<?php
class MLCNotificationListPanelBase extends MJaxTable{
	public function __construct($objParentControl, $arrMLCNotifications = array()){
	
		parent::__construct($objParentControl);
		
		$this->SetupCols();
		$this->SetDataEntites($arrMLCNotifications);
		foreach($this->Rows as $intIndex => $objRow){
			$objRow->AddAction($this, 'objRow_click');
		}

	}
	public function SetupCols(){
		
	    	
	    	$this->AddColumn('idNotification','idNotification');
	   		
	    	
		
	    	
	    	
	    	$this->AddColumn('idUser','idUser');
	   		
		
	    	
	    	
	    	$this->AddColumn('creDate','creDate');
	   		
		
	    	
	    	
	    	$this->AddColumn('className','className');
	   		
		
	    	
	    	
	    	$this->AddColumn('data','data');
	   		
		
	    	
	    	
	    	$this->AddColumn('viewed','viewed');
	   		
		
	}
	public function objRow_click($strFomrId, $strControlId, $strActionParameter){

		$this->objForm->Redirect(__ENTITY_MODEL_DIR__ . '/MLCNotification/' . $strActionParameter);
	}
	
  	
}
?>