<?php
class FFSForm extends MJaxWAdminForm{
    public function Form_Create(){
        parent::Form_Create();
        $this->AddHeaderNav('Home', 'icon-home');
    }
}