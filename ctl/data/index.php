<?php
/**
* Class and Function List:
* Function list:
* - Form_Create()
* - lnkManage_click()
* Classes list:
* - ControlIndex extends FFSForm
*/
class ControlIndex extends FFSForm {
    public $tblEntities = null;
    public function Form_Create() {
        parent::Form_Create();
        $this->tblEntities = new MJaxTable($this);
        $this->tblEntities->AddColumn('name', 'Name');
        $this->tblEntities->AddColumn('count', 'Count');
        $this->tblEntities->InitRowControl('manage', 'Manage', $this, 'lnkManage_click');
        //Assignment
        $arrData = array(
            'name' => "Assignment",
            'count' => Assignment::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Assignment";
        //Athelete
        $arrData = array(
            'name' => "Athelete",
            'count' => Athelete::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Athelete";
        //Competition
        $arrData = array(
            'name' => "Competition",
            'count' => Competition::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Competition";
        //Device
        $arrData = array(
            'name' => "Device",
            'count' => Device::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Device";
        //Enrollment
        $arrData = array(
            'name' => "Enrollment",
            'count' => Enrollment::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Enrollment";
        //Org
        $arrData = array(
            'name' => "Org",
            'count' => Org::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Org";
        //ParentMessage
        $arrData = array(
            'name' => "ParentMessage",
            'count' => ParentMessage::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "ParentMessage";
        //Result
        $arrData = array(
            'name' => "Result",
            'count' => Result::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Result";
        //Session
        $arrData = array(
            'name' => "Session",
            'count' => Session::QueryCount('WHERE 1')
        );
        $objRow = $this->tblEntities->AddRow($arrData);
        $objRow->ActionParameter = "Session";
        $this->tblEntities->RefreshControls();
        $this->AddWidget('Entities', '', $this->tblEntities);
    }
    public function lnkManage_click($strFormId, $strControlId, $strActionParameter) {
        $this->Redirect('/data/edit' . $strActionParameter);
    }
}
ControlIndex::Run('ControlIndex');
?>