<?php class home extends FFSHomeForm{
    public function Form_Create(){
        parent::Form_Create();
        if(
            (!$this->IsParent()) &&
            ($this->IsOrgManager())
        ){
            $this->Redirect('/org/index');
        }
    }
    public function QueryAtheletes(){
        return FFSApplication::GetAtheletesByParent();
    }

}
home::Run('home'); ?>