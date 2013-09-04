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
    }

    public function SetupCols(){

            $this->AddColumn('atheleteName','Athlete', $this, 'render_atheleteName');

            $colSession = $this->AddColumn('idSession','Session');
            $colSession->RenderObject = $this;
            $colSession->RenderFunction = 'colSession_render';
            $colSession->EditCtlInitMethod = 'colSession_init';

            $colFlight = $this->AddColumn('flight','Flight');
            $colFlight->RenderObject = $this;
            $colFlight->RenderFunction = 'colMisc_render';
            $colFlight->EditCtlInitMethod = 'colMisc_init';

            $this->AddColumn('division','Division');

            
            $this->AddColumn('ageGroup','Age Group');

            $this->AddColumn('level','Level');
            
            if(false){
                $this->AddColumn('misc1','misc1');
                $this->AddColumn('misc2','misc2');
                $this->AddColumn('misc3','misc3');
                $this->AddColumn('misc4','misc4');
                $this->AddColumn('misc5','misc5');

            }
            //$this->AddColumn('creDate','creDate');

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
        $txtMisc = $objRow->GetData('txtMisc');
        if(is_null($txtMisc)){
            $txtMisc = new MJaxBSAutocompleteTextBox($objRow, '/' . FFSForm::$objCompetition->Namespace . '/data/search.enrollment_' . $strKey);
            $objEnrollment = $objRow->GetData('_entity');
            $txtMisc->SetValue($objEnrollment->{$strKey});
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
        //$lnkSession = $objRow->GetData('lnkSession');
        return $txtMisc;
    }
    public function txtMisc_select($strFormId, $strControlId, $objEnrollment){

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
    public function colSession_render($strData, $objRow, $objCol){
        if($objRow->IsSelected() && $objCol->IsSelected()){
            $strHtml = $objCol->RenderIndvControl($objRow);
        }else{
            $objEnrollment = $objRow->GetData('_entity');
            //_dv($objEnrollment->IdSession);
            $strHtml = $objEnrollment->IdSessionObject->__toString();
        }
        return $strHtml;
    }
    public function colSession_init($objRow, $mixData, $strKey){
        $txtSession = $objRow->GetData('txtSession');
        if(is_null($txtSession)){
            $txtSession = new MJaxBSAutocompleteTextBox($objRow, '/' . FFSForm::$objCompetition->Namespace . '/data/search.session');
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
    /*public function render_idSession($strData, $objRow, $objColumn){
        $lnkSession = $objRow->GetData('lnkSession');
        if(is_null($lnkSession)){

        }


        return $lnkSession->Render(false);
    }
    public function lnkSession_click($strFormId, $strControlId, $objEnrollment){
        $objRow = $this->objForm->Controls[$strControlId]->ParentControl;
        $txtSession = $objRow->GetData('txtSession');
        if(is_null($txtSession)){
            $txtSession = new MJaxBSAutocompleteTextBox($this, $this->objForm->objJsonSearchDriver, '_searchSession');
            $txtSession->AddAction(
                new MJaxBSAutocompleteSelectEvent(),
                new MJaxServerControlAction(
                    $this,
                    'txtSession_select'
                )
            );
            $objRow->SetData($txtSession, 'txtSession');
        }
        $lnkSession = $objRow->GetData('lnkSession');
        $lnkSession->ReplaceWith($txtSession);
    }*/

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

}
?>