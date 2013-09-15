<?php
class FFSSessionEnrollmentPanel extends MJaxPanel{

    public $arrLinks = array();
    public $arrStats = array();
    public $arrViewAllLinks = array();
    public function __construct($objParentControl, $strControlId = null, $collSessions = null){
        parent::__construct($objParentControl, $strControlId);
        $this->strTemplate = __VIEW_ACTIVE_APP_DIR__ . '/www/_panels/' . get_class($this) . '.tpl.php';

        $this->objForm->AddJSCall(
            sprintf(
                '$("#%s .collapse").each(function(){ $(this).collapse("hide"); });',
                $this->strControlId
            )
        );
        $this->InitUnenrolled();
        if(!is_null($collSessions)){
            foreach($collSessions as $objSession){
                $this->AddSession($objSession);
            }
        }
    }
    public function InitUnenrolled(){
        $lnkSession = new MJaxLinkButton($this);
        $lnkSession->Text = 'Unassigned';
        $lnkSession->AddCssClass('accordion-toggle btn-info');
        // data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        $lnkSession->AddAction($this,'lnkSession_click');
        $lnkSession->ActionParameter = null;
        $this->arrLinks[-1] = $lnkSession;

        $lnkViewAll = new MJaxLinkButton($this);
        //$lnkViewAll->AddCssClass('btn btn-large');
        $lnkViewAll->Text = "View All";
        $lnkViewAll->AddAction($this, 'lnkViewAll_click');
        $lnkViewAll->ActionParameter = null;
        $arrEnrollment = Enrollment::Query('WHERE Enrollment_rel.idSession IS NULL');
        $arrOrgs = array();
        foreach($arrEnrollment as $objEnrollemnt){
            $arrOrgs[$objEnrollemnt->IdAtheleteObject->IdOrg] = 1;
        }
        $this->arrStats[-1] = array(
            'athelete_ct' => $arrEnrollment->Length(),
            'org_ct' => count($arrOrgs),
            'spaces_left'=> null
        );
        $this->arrViewAllLinks[-1] = $lnkViewAll;
    }

    public function AddSession(Session $objSession){
        $lnkSession = new MJaxLinkButton($this);
        $lnkSession->Text = $objSession->Name;
        $lnkSession->AddCssClass('accordion-toggle');
        // data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        $lnkSession->AddAction($this,'lnkSession_click');
        $lnkSession->ActionParameter = $objSession;
        $this->arrLinks[$objSession->IdSession] = $lnkSession;

        //Set up stats
        $arrEnrollment = $objSession->GetEnrollmentArr();
        $arrOrgs = array();
        foreach($arrEnrollment as $objEnrollemnt){
            $arrOrgs[$objEnrollemnt->IdAtheleteObject->IdOrg] = 1;
        }

        $intSpacesLeft = null;
        $intCapacity = $objSession->Data('athelete_capacity');
        if(!is_null($intCapacity)){
               $intSpacesLeft = $intCapacity  - $arrEnrollment->Length();
        }
        $this->arrStats[$objSession->IdSession] = array(
            'athelete_ct' => $arrEnrollment->Length(),
            'org_ct' => count($arrOrgs),
            'spaces_left'=> $intSpacesLeft
        );


        $lnkViewAll = new MJaxLinkButton($this);
        //$lnkViewAll->AddCssClass('btn btn-large');
        $lnkViewAll->Text = "View All";
        $lnkViewAll->AddAction($this, 'lnkViewAll_click');
        $lnkViewAll->ActionParameter = $objSession;

        $this->arrViewAllLinks[$objSession->IdSession] = $lnkViewAll;
    }
    public function lnkViewAll_click($strFormId, $strControlId, $objSession){

        $this->strActionParameter = $objSession;
        $this->TriggerEvent('ffs-session-enroll-panel-view-all');
    }
    public function lnkSession_click($strFormId, $strControlId, $objSession){
        $this->FocusSession($objSession);
        $this->TriggerEvent('ffs-session-enroll-panel-select-session');
    }
    public function FocusSession($objSession){
        $this->strActionParameter = $objSession;
        if(is_null($objSession)){
            $intIdSession = -1;
        }else{
            $intIdSession = $objSession->IdSession;
        }
        $this->objForm->AddJSCall(
            sprintf(
                '$(document).one("mjax-page-load", function(){
                    $("#%s .collapse").each(function(){
                        var jThis = $(this);
                        var jLink = jThis.parent().find(".accordion-toggle");
                        if(jThis.attr("data-id-session") == "%s"){
                            jThis.collapse("show");
                            jLink.addClass("btn-primary");
                        }else{
                            jThis.collapse("hide");
                            jLink.removeClass("btn-primary");
                        }

                    });
                });',
                $this->strControlId,
                $intIdSession
            )
        );
    }
    
}
class FFSSessionEnrollPanelSelectSessionEvent extends MJaxEventBase{
    protected $strEventName = 'ffs-session-enroll-panel-select-session';
}
class FFSSessionEnrollPanelViewAllEvent extends MJaxEventBase{
    protected $strEventName = 'ffs-session-enroll-panel-view-all';
}
