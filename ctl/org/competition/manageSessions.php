<?php
class SessionManageForm extends SessionManageFormBase
{
    protected $blnInlineEdit = false;

    public function Form_Create()
    {
        parent::Form_Create();

        $arrSessions = $this->Query();
        $this->InitList($arrSessions)->AddCssClass('span12');
        if (!$this->blnInlineEdit) {
            $this->InitEditPanel()->AddCssClass('span6');
        }

    }

    public function Query()
    {
        /*$arrSessions = Session::Query(
            sprintf(
                'WHERE 1'
            )
        );*/
        $arrSessions = FFSForm::$objCompetition->GetSessionArr();

        return $arrSessions;
    }

    public function InitList($arrSessions)
    {

        $wgtSession = parent::InitList($arrSessions);
        if ($this->blnInlineEdit) {
            $this->lstSessions->InitRemoveButtons();
            $this->lstSessions->InitEditControls();
            $this->lstSessions->AddEmptyRow();
        } else {
            $this->lstSessions->InitRowControl(
                'edit',
                'Edit',
                $this,
                'lnkEdit_click'
            );

            //$this->InitEditPanel();
        }
        $this->AddJSCall(
            sprintf(
                "$(function(){
                    $('#%s').slimScroll({
                        width: '100%%',
                        height: '100%%'
                    });
                });",
                $this->lstSessions->ControlId
            )
        );
        return $wgtSession;
    }

    public function lnkEdit_click($strFormId, $strControlId, $strActionParameter)
    {
        $this->pnlEdit->SetSession(
            Session::LoadById($strActionParameter)
        );

        $this->lstSessions->SelectedRow = $this->arrControls[$strControlId]->ParentControl;
    }

    public function lstSession_editInit()
    {
        //_dv($this->lstSessions->SelectedRow);
    }

    public function lstSession_editSave()
    {
        $objSession = Session::LoadById($this->lstSessions->SelectedRow->ActionParameter);
        /*
        if (is_null($objSession)) {
            $objSession = new Session();
        }
         */
        $this->lstSessions->SelectedRow->UpdateEntity(
            $objSession
        );
    }
    public function pnlEdit_save($strFormId, $strControlId, $objSession)
    {
        //_dv($objSession);
        $this->UpdateTable($objSession);
    }

    public function UpdateTable($objSession){


        //_dv($objSession);

        if(!is_null($this->lstSessions->SelectedRow)){
            $this->lstSessions->SelectedRow->UpdateRow(
                $objSession
            );
        }else{
            $objSession->IdCompetition = FFSForm::$objCompetition->IdCompetition;
            $objSession->Save();
            //_dv($objSession);
            $objRow = $this->lstSessions->AddRow(
                $objSession
            );

        }
    }

}

SessionManageForm::Run('SessionManageForm');

