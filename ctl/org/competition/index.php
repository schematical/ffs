<?php

class index extends FFSForm {
    public $pnlMessages = null;
    //public $pnlNav = null;
    public function Form_Create(){
        parent::Form_Create();
        $this->SecureCompetition();
            $this->AddWidget(
                FFSForm::Competition()->Name,
                'icon-home',
                new FFSOrgCompActivePanel($this, FFSForm::Competition())
            );

    }
}
index::Run('index');
?>