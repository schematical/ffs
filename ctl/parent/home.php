<?php
class home extends FFSForm{

    public $pnlComp = null;


    public function Form_Create(){
        parent::Form_Create();

        $this->pnlComp = new FFSParentCompSearchPanel($this);
        $wgtComp = $this->AddWidget(
            'Find  a competition',
            'icon-flag',
            $this->pnlComp
        );
    }
}
home::Run('home');