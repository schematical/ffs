<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* Classes list:
* - EnrollmentListPanel extends EnrollmentListPanelBase
*/
require_once (__MODEL_APP_CONTROL__ . "/base_classes/EnrollmentListPanelBase.class.php");
class EnrollmentListPanel extends EnrollmentListPanelBase {
    public function __construct($objParentControl, $arrEnrollments = array()) {
        parent::__construct($objParentControl, $arrEnrollments);
        $this->AddCssClass('table table-striped table-bordered table-condensed');
        $this->strEditMode = MJaxTableEditMode::INLINE;
    }

    public function SetupCols(){

            $colAthelete = $this->AddColumn('atheleteName','Athlete');
            $colAthelete->RenderObject = $this;
            $colAthelete->RenderFunction = 'render_atheleteName';

            $colOrg = $this->AddColumn('IdOrgObject','Gym');
            $colOrg->RenderObject = $this;
            $colOrg->RenderFunction = 'render_org';

            $colSession = $this->AddColumn('idSession','Session');
            $colSession->RenderObject = $this;
            $colSession->RenderFunction = 'colSession_render';
            $colSession->EditCtlInitMethod = 'colSession_init';

            $colFlight = $this->AddSpecialColumn('flight','Flight');


            //$colDivision = $this->AddSpecialColumn('division','Division');


            $colBirth = $this->AddColumn('birthDate','Birth');
            $colBirth->RenderObject = $this;
            $colBirth->RenderFunction = 'render_atheleteBirthDate';
            $colBirth->Editable = true;
            $colBirth->EditControlClass = 'MJaxBSDateTimePicker';

            //$this->AddSpecialColumn('ageGroup','Age Group');

            $this->AddSpecialColumn('level','Level');
            
            if(false){
                $this->AddSpecialColumn('misc1','misc1');
                $this->AddSpecialColumn('misc2','misc2');
                $this->AddSpecialColumn('misc3','misc3');
                $this->AddSpecialColumn('misc4','misc4');
                $this->AddSpecialColumn('misc5','misc5');

            }
            //$this->AddColumn('creDate','creDate');

    }
    public function AddSpecialColumn($strKey, $strName){
        $colFlight = $this->AddColumn($strKey,$strName);
        $colFlight->RenderObject = $this;
        $colFlight->RenderFunction = 'colMisc_render';
        $colFlight->EditCtlInitMethod = 'colMisc_init';
        return $colFlight;
    }
    public function colMisc_render($strData, $objRow, $objCol){
        if($objRow->IsSelected() && $objCol->IsSelected()){
            $strHtml = $objCol->RenderIndvControl($objRow);
        }else{
            $objEnrollment = $objRow->GetData('_entity');
            //_dv($objEnrollment->IdSession);
            $strHtml = $objEnrollment->{$objCol->Key};
        }
        return $strHtml;
    }
    public function colMisc_init($objRow, $mixData, $strKey){
        $objEnrollment = $objRow->GetData('_entity');
        $txtMisc = $objRow->GetData('txtMisc');
        if(is_null($txtMisc)){

            $txtMisc = new MJaxBSAutocompleteTextBox($objRow);



            $txtMisc->ActionParameter = $objEnrollment;
            $txtMisc->AddAction(
                new MJaxChangeEvent(),
                new MJaxServerControlAction(
                    $this,
                    'txtMisc_select'
                )
            );
            $objRow->AddData($txtMisc, 'txtMisc');
        }

        $strUrl = '/' . $this->objForm->Competition()->Namespace . '/data/search?mjax-route-ext=enrollment_' . $strKey;
        if(!is_null($objEnrollment->IdSession)){
            $strUrl .= '&' . FFSQS::Session_IdSession . '=' . $objEnrollment->IdSession;
        }
        $txtMisc->Url = $strUrl;
        $txtMisc->SetValue($objEnrollment->{$strKey});
        //$lnkSession = $objRow->GetData('lnkSession');
        return $txtMisc;
    }
    public function txtMisc_select($strFormId, $strControlId, $objEnrollment){

        $strVal = $this->objForm->Controls[$strControlId]->GetValue();
        try{
            $objEnrollment->{$this->colSelected->Key} = $strVal;

        }catch(FFSUnregisteredDataException $e){
            $pnlConfirm = new MJaxBSConfirmPanel($this->rowSelected);
            $pnlConfirm->Text = sprintf(
                "There is no <b>%s</b> created called <b>%s</b> yet. Are you sure you want to add this <b>%s</b>",
                $this->colSelected->Title,
                $strVal,
                $this->colSelected->Title
            );
            $pnlConfirm->ActionParameter = $objEnrollment;
            $pnlConfirm->AddAction(
                new MJaxBSConfirmEvent(),
                new MJaxServerControlAction(
                    $this,
                    'txtMisc_confirm'
                )
            );
            $this->objForm->Alert(
                $pnlConfirm
            );
        }
        $objEnrollment->Save();
        $this->objForm->Controls[$strControlId]->ParentControl->UpdateRow($objEnrollment);
        $this->rowSelected->AddData($objEnrollment,'_entity');
        return;

    }
    public function txtMisc_confirm($strFormId, $strControlId, $objEnrollment){
        //Add value to allowed values
        $arrData = $objEnrollment->IdSessionObject->Data($this->colSelected->Key.'s');
        $txtMisc = $this->objForm->Controls[$strControlId]->ParentControl->GetData('txtMisc');
        $strVal = $txtMisc->GetValue();

        $arrData[$strVal] = $strVal;
        $objEnrollment->IdSessionObject->Data($this->colSelected->Key.'s', $arrData);

        $this->txtMisc_select($strFormId, $txtMisc->ControlId, $objEnrollment);
    }
    public function colSession_render($strData, $objRow, $objCol){
        if($objRow->IsSelected() && $objCol->IsSelected()){
            $strHtml = $objCol->RenderIndvControl($objRow);
        }else{
            $objEnrollment = $objRow->GetData('_entity');
            //_dv($objEnrollment->IdSession);
            if(is_null($objEnrollment->IdSessionObject)){
                $strHtml = 'Unassigned';
            }else{
                $strHtml = $objEnrollment->IdSessionObject->__toString();
            }
        }
        return $strHtml;
    }
    public function colSession_init($objRow, $mixData, $strKey){
        $txtSession = $objRow->GetData('txtSession');
        if(is_null($txtSession)){
            $txtSession = new MJaxBSAutocompleteTextBox($objRow);
            $txtSession->SetSearchEntity('session', 'name');

            $objEnrollment = $objRow->GetData('_entity');
            $txtSession->SetValue($objEnrollment->IdSessionObject);
            $txtSession->ActionParameter = $objEnrollment;
            $txtSession->AddAction(
                new MJaxChangeEvent(),
                new MJaxServerControlAction(
                    $this,
                    'txtSession_select'
                )
            );
            $objRow->AddData($txtSession, 'txtSession');
        }
        //$lnkSession = $objRow->GetData('lnkSession');
        return $txtSession;
    }
    public function txtSession_select($strFormId, $strControlId, $objEnrollment){

        $mixSession = $this->objForm->Controls[$strControlId]->GetValue();
        if(
            (is_object($mixSession)) &&
            ($mixSession instanceof Session)
        ){
            $objEnrollment->IdSessionObject = $mixSession;
            $objEnrollment->Save();
            $this->objForm->Controls[$strControlId]->ParentControl->UpdateRow($objEnrollment);
            $this->rowSelected->AddData($objEnrollment,'_entity');
            return;
        }
        $this->objForm->Alert(
            "No session with name '" . $mixSession. "' exists"
        );
    }

    //
    public function render_atheleteName($intIdAthelete, $objRow){
        $intIdAthelete = $objRow->GetData('_entity')->IdAthelete;
        if(is_null($intIdAthelete)){
           return 'Unknown';
        }
        $objAthelete = Athelete::LoadById($intIdAthelete);
        $strReturn = $objAthelete->LastName . ', ' . $objAthelete->FirstName;
        return $strReturn;

    }
    //
    public function render_org($strData, $objRow, $objCol){
        $objAthelete = $objRow->GetData('_entity')->IdAtheleteObject;
        if(is_null($objAthelete)){
            return 'Unknown';
        }

        return $objAthelete->IdOrgObject->__toString();

    }
    public function render_atheleteBirthDate($strData, $objRow, $objCol){
        if($objRow->IsSelected() && $objCol->IsSelected() && $objCol->Editable && $this->EditMode == MJaxTableEditMode::INLINE){
            return $objCol->RenderIndvControl($objRow);

        }else{
            $objAthelete = $objRow->GetData('_entity')->IdAtheleteObject;
            if(is_null($objAthelete)){
                return 'Unknown';
            }
            if(is_null($objAthelete->BirthDate)){
                return $objAthelete->BirthDate;
            }
            //return $objAthelete->BirthDate;
            return $this->RenderDate($objAthelete->BirthDate, $objRow);
        }
    }

}
?>