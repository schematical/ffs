<?php

if(!defined('SERVER_ENV')){

	switch($_SERVER['SERVER_NAME']){
        case('local.tumblescore.com'):
        case('local.ffs.com'):
			define('SERVER_ENV', 'local');
			define('MLC_APPLICATION_NAME', 'ffs');
		break;
        /*case('beta.schematical.com'):
            define('SERVER_ENV', 'beta');
            define('MLC_APPLICATION_NAME', 'mde');
        break;*/
        case('tumblescore.com'):
        case('www.tumblescore.com'):
            define('SERVER_ENV', 'beta');
            define('MLC_APPLICATION_NAME', 'ffs');
        break;
	}
}
if(defined('SERVER_ENV')){
    define('MLC_APPLICATION_PREFIX', 'FFS');
	switch(SERVER_ENV){
		case('local'):			
			define('DB_1', serialize(array(
				'host'=>'localhost',
				'db_name'=>'ffs',
				'user'=>'root',
				'pass'=>'learnlearn'
			)));
			define('DB_0', serialize(array(
				'host'=>'localhost',
				'db_name'=>'util',
				'user'=>'root',
				'pass'=>'learnlearn'
			)));
            /*define('DB_2', serialize(array(
                'host'=>'localhost',
                'db_name'=>'ffs',
                'user'=>'root',
                'pass'=>'learnlearn'
            )));*/
			define('MLC_DISPLAY_EXCEPTIONS', '1');
		break;
        case('beta'):
            define('MLC_DISPLAY_EXCEPTIONS', '1');
        case('prod'):
            define('DB_1', serialize(array(
                'host'=>'lab.cv7i1bpkvj0w.us-east-1.rds.amazonaws.com',
                'db_name'=>'ffs',
                'user'=>'evillabs',
                'pass'=>'gaM3rPuPu'
            )));
            define('DB_0', serialize(array(
                'host'=>'lab.cv7i1bpkvj0w.us-east-1.rds.amazonaws.com',
                'db_name'=>'ffs',
                'user'=>'evillabs',
                'pass'=>'gaM3rPuPu'
            )));

        break;
	}

    define('POSTMARKAPP_API_KEY', 'e2e62665-0392-40e7-ac3f-a1dfb5c9349c');
    define('POSTMARKAPP_MAIL_FROM_ADDRESS', 'mlea@schematical.com');
    define('POSTMARKAPP_MAIL_FROM_NAME', 'Matt Lea');
    define('FOURSQUARE_CLIENT_ID', 'FOMG2MGP42L4NETX02VOHLUUOYQDXVX1JLXNZBFBRP02B2DH');
	define('FOURSQUARE_CLIENT_SECRET', 'EIZUVCO0CZDII2EV0H01ILCKNL1ZNP3GG0WAF00QIIY0JMVZ');
	define('FOURSQUARE_PUSH_SECRET', '5TV4JTRBMQTBYH31CHNYHIDHQDIDL4DX0EHD2EXMVUDSQCXT');
	
	define('TWITTER_CONSUMER_KEY', 'kvTfv7VCfcxhm8yi2SxNbA');
	define('TWITTER_CONSUMER_SECRET', 'ig1mD43DZTTePqWrm7a09LH2ibMNssb9CcbZYPqzDzk');
	if(array_key_exists('SERVER_NAME', $_SERVER)){
		define('TWITTER_OAUTH_CALLBACK', 'http://' . $_SERVER['SERVER_NAME']. '/twitter/callback.php');
	}
	define('MAILCHIMP_LIST_ID', 'd8d9a8f9ab');
	define('AWS_ACCESS_KEY', 'AKIAIWAM5VQTMEM73MFA');
	define('AWS_ACCESS_SECRET', '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');
    define('AWS_BUCKET', 'mlc_mde');
    define('AWS_ASSET_PATH', '/assets');

    define('EVERNOTE_OAUTH_CONSUMER_KEY', 'mlconsulting');
    define('EVERNOTE_OAUTH_CONSUMER_SECRET', '3d4f4117399d24a0');
    if(array_key_exists('SERVER_NAME', $_SERVER)){
        define('EVERNOTE_CALLBACK', 'http://' . $_SERVER['SERVER_NAME'] . '/launch/evernote.php');
    }
    define('EVERNOTE_SANDBOX', false);

    define('GM_API_KEY', '050aa1684c715b9795d6b52e0');

    define('TWILLIO_SID', 'ACeca98fd0024e6ec362a944d0e1f90fb3');
    define('TWILLIO_SECRET', '5efcff97088895cfdd492b60d6aba5d5');

    define('HIGHRISE_CLIENT_ID', '55001eaa23b0be125f81c82c77b2cfb2c83a361a');
    define('HIGHRISE_CLIENT_SECRET', '5739e9ad0e220b16f4ac8600b237c746ee5a8961');
    if(array_key_exists('SERVER_NAME', $_SERVER)){
        define('HIGHRISE_REDIRECT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/launch/highrise.php');
    }
    define('FFS_AWS_S3_CACHE_TIME', 3600);
    define('FFS_GIT_CACHE_TIME', 3600);
    define('__GIT_TMP_DIR__', '/var/www/fake_git');

    define('GRASSHOPPER_NUMBER', '1-888-879-7927');
    define('SALES_SUPPORT_EMAIL', 'hello@tumblescore.com');
    define('TECH_SUPPORT_EMAIL', 'techsupport@tumblescore.com');

	if(true){//We are live baby
        define('STRIPE_MODE', 'live');
        define('STRIPE_API_SECRET', 'sk_GTlGrn8L9erPQpTNvDiznek9BEVLE');
        define('STRIPE_API_PUBLIC', 'pk_tu8lmXHcSfLBFRiDbh67hGvg5z8vY');
	}else{
        define('STRIPE_MODE', 'test');
        define('STRIPE_API_SECRET', 'sk_sk3VF1S2GK9kwsa8PfLkQNWfma5pD');
        define('STRIPE_API_PUBLIC', 'pk_RXEN6DBtQiZeFKULC66vTD2ycP0hJ');
	}
    define('__MST_ACCOUNT__', '1');
}