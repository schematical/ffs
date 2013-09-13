<?php
class FFSSessionEnrollmentPanel extends MJaxPanel{

    public $arrLinks = array();
    public function __construct($objParentControl, $strControlId = null, $collSessions = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';

        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s .collapse").each(function(){ $(this).collapse("hide"); });',
                $this->strControlId
            )
        );
        if(!is_null($collSessions)){
            foreach($collSessions as $objSession){
                $this->AddSession($objSession);
            }
        }
    }
    public function AddSession($objSession){
        $lnkSession = new MJaxLinkButton($this);
        $lnkSession->Text = $objSession->Name;
        $lnkSession->AddCssClass('accordion-toggle');
        // data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        $lnkSession->AddAction($this,'lnkSession_click');
        $lnkSession->ActionParameter = $objSession;
        $this->arrLinks[$objSession->IdSession] = $lnkSession;

    }
    public function lnkSession_click($strFormId, $strControlId, $objSession){

        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s .collapse").each(function(){
                    var jThis = $(this);
                    var jLink = jThis.parent().find(".accordion-toggle");
                    if(jThis.attr("data-id-session") == "%s"){
                        jThis.collapse("show");
                        jLink.addClass("btn-primary");
                    }else{
                        jThis.collapse("hide");
                        jLink.removeClass("btn-primary");
                    }

                });',
                $this->strControlId,
                $objSession->IdSession
            )
        );
    }
    
}
