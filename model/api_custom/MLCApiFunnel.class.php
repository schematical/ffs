<?php
MLCApplication::InitPackage('MLCMailChimp');
MLCApplication::InitPackage('MLCStripe');
class MLCApiFunnel extends MLCApiClassBase{
	protected $strClassName = 'MLCApiFunnel';
	
	public function  __call($strName, $arrArguments) {
        
		
        
     }
	public function FinalAction($arrPostData){
		//This class should create a json respons for each peace of the funnel
		//PARAMS
        //- StartDate
        $strStartDate = MLCApiDriver::GetQueryString(MLCApiFunnelQS::StartDate);
        if(is_null($strStartDate)){
        	$strStartDate = MLCDateTime::Now('-1 months');
		}
        //- EndDate
        $strEndDate = MLCApiDriver::GetQueryString(MLCApiFunnelQS::EndDate);
        if(is_null($strEndDate)){
        	$strEndDate = MLCDateTime::Now();
		}
        //ref Source?
		
		$arrResponse = array();
		//Mailchimpstats
		
		$arrResponse['mailchimp'] = MLCMailChimpDriver::GetCampaignAnalytics(
			array(
				'sendtime_start'=> $strStartDate,
				'sendtime_end'=> $strEndDate
			)
		);
		
		
		
		//Sources coming in to the site via REF
		
		$arrResponse['unique_visits_by_ref'] = MLCEventTrackingDriver::GetCount(
			array(
				MLCTrackingField::EventName => MLCEvent::PAGE_LOAD,
				MLCTrackingField::StartDate => $strStartDate,
				MLCTrackingField::EndDate => $strEndDate,
				MLCTrackingField::App => MLC_APPLICATION_NAME
			),
			array(
				MLCTrackingField::Ref,
				MLCTrackingField::Utma
			)
			
		);
		
		$arrResponse['page_views_per_user'] = MLCEventTrackingDriver::GetCount(
			array(
				MLCTrackingField::EventName => MLCEvent::PAGE_LOAD,
				MLCTrackingField::StartDate => $strStartDate,
				MLCTrackingField::EndDate =>$strEndDate,
				MLCTrackingField::App => MLC_APPLICATION_NAME
			),
			array(
				MLCTrackingField::Utma
				
			)
			
		);
		
		$strSimpleQuery = sprintf(
			'WHERE creDate > "%s" AND creDate < "%s"',
			$strStartDate,
			$strEndDate
		
		);
		
		
		//Signups
		$arrResponse['signups'] = AuthAccount::QueryCount(
			$strSimpleQuery
		);
		
		//Build
		$arrResponse['builds'] = MDEBuild::QueryCount(
			$strSimpleQuery
		);
		
		
		
		//Stripe 
		
		$arrResponse['payments'] = MLCStripeDriver::GetChargeCollectionTotalData(
			
		);
		
		return new MLCApiResponse($arrResponse);
	}
    	
	public function Query(){
	 	//Will need to accept QS Pramaeters of facebook, twitter, google
	}
}
abstract class MLCApiFunnelQS{
	const StartDate = 'start';
	const EndDate = 'end';
}
