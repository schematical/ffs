<?php
class home extends FFSHomeForm{
    public function Form_Create(){
        parent::Form_Create();
    }
    public function QueryAtheletes(){
        return FFSApplication::GetAtheletesByOrgManager();
    }
}
home::Run('home'); ?>