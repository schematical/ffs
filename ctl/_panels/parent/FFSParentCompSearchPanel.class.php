<?php
class FFSParentCompSearchPanel extends MJaxPanel{
    public $txtComp = null;
    public $pnlCompEdit = null;
    public $txtHostOrg = null;
    public function __construct($objParentControl, $strControlId = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/parent/' . get_class($this) . '.tpl.php';
        $this->txtComp = new MJaxBSAutocompleteTextBox($this);
        $this->txtComp->SetSearchEntity('Competition', 'name');
        $this->txtComp->AddAction(
            new MJaxBSAutocompleteSelectEvent(),
            new MJaxServerControlAction(
                $this,
                'txtComp_select'
            )
        );


    }
    public function txtComp_select(){
        $objComp = $this->txtComp->GetValue();
        if(is_object($objComp)){
            //If an enrollment exists do nothing
            //IDK
            $this->objForm->Redirect(
                '/parent/scores',
                array(
                    FFSQS::Competition_IdCompetition => $objComp->IdCompetition
                )
            );
        }else{

            $this->objForm->Append(
                '#ffs-competition-select',
                '<div class="alert alert-info">We don\'t have this competition in our databases yet. Would you mind entering in some info on it?</div>'
            );

           /* $this->pnlCompEdit = new CompetitionEditPanel($this);
            $this->pnlCompEdit->AddAction(
                new MJaxDataEntitySaveEvent(),
                new MJaxServerControlAction(
                    $this,
                    'pnlCompEdit_click'
                )
            );
            $this->objForm->Append(
                '#ffs-competition-select',
                $this->pnlCompEdit
            );*/

            $this->txtHostOrg = new MJaxBSAutocompleteTextBox($this);
            $this->txtHostOrg->SetSearchEntity('Org', 'name');
            $this->txtHostOrg->AddAction(
                new MJaxBSAutocompleteSelectEvent(),
                new MJaxServerControlAction(
                    $this,
                    'txtHostOrg_select'
                )
            );
            $this->objForm->Append(
                '#ffs-competition-select',
                '<div class="control-group pull-left">
                    <label class="control-label">Host Gym Name:</label>
                    <div class="controls">' .
                    $this->txtHostOrg->Render(false) .
                    '</div>' .
                '</div>'
            );
        }
    }

    public function txtHostOrg_select($f, $c, $objOrg)
    {
        if(!is_object($objOrg)){
            //Create an unsanctioned competition
            $strOrgName = $objOrg;
            $objOrg = new Org();
            $objOrg->Name = $strOrgName;
            $objOrg->IdImportAuthUser = MLCAuthDriver::IdUser();
            $objOrg->Save();
        }
        $objComp = new Competition();
        $objComp->sanctioned = false;
        $objComp->Name = $this->txtComp->GetValue();
        $objComp->IdOrg = $objOrg->IdOrg;
        $objComp->Save();
        $this->objForm->Redirect(
            '/parent/scores',
            array(
                FFSQS::Competition_IdCompetition => $objComp->IdCompetition
            )
        );
    }
    
}