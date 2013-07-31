<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - AWSInstance()
* - AuthSession()
* - MDEApp()
* - MDEAsset()
* - MDEBuild()
* - MDEBuildAssembly()
* - MDEPackage()
* - MDEThought()
* Classes list:
* - MLCEntityModelHomeBase extends MLCEntityModelClassBase
*/
class MLCEntityModelHomeBase extends MLCEntityModelClassBase {
    public function __construct() {
        //MLCEntityModelAuthDriver::Authenticate(false);
        
    }
    public function AWSInstance() {
        return new MLCEntityModelAWSInstance();
    }
    public function AuthSession() {
        return new MLCEntityModelAuthSession();
    }
    public function MDEApp() {
        return new MLCEntityModelMDEApp();
    }
    public function MDEAsset() {
        return new MLCEntityModelMDEAsset();
    }
    public function MDEBuild() {
        return new MLCEntityModelMDEBuild();
    }
    public function MDEBuildAssembly() {
        return new MLCEntityModelMDEBuildAssembly();
    }
    public function MDEPackage() {
        return new MLCEntityModelMDEPackage();
    }
    public function MDEThought() {
        return new MLCEntityModelMDEThought();
    }
}
MLCApplicationBase::$arrClassFiles['MLCEntityModelAWSInstance'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelAWSInstance.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelAWSInstanceObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelAWSInstanceObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelAuthSession'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelAuthSession.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelAuthSessionObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelAuthSessionObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEApp'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEApp.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEAppObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEAppObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEAsset'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEAsset.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEAssetObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEAssetObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEBuild'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEBuild.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEBuildObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEBuildObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEBuildAssembly'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEBuildAssembly.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEBuildAssemblyObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEBuildAssemblyObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEPackage'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEPackage.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEPackageObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEPackageObject.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEThought'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEThought.class.php';
MLCApplicationBase::$arrClassFiles['MLCEntityModelMDEThoughtObject'] = __MODEL_APP_ENTITY_MODEL__ . '/MLCEntityModelMDEThoughtObject.class.php';
?>