<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload() {
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('Br_');
		$loader->registerNamespace('ZFDebug');
    }
	protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

	protected function _initJquery()
	{
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper');
        //$view->JQuery()->setLocalPath('/js/jquery-1.7.1.min.js');
        $view->JQuery()->enable();
	}

   protected function _initHeadMeta()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->headMeta()->appendHttpEquiv('Content-Type',
		                                   'text/html; charset=UTF-8')
		                 ->appendHttpEquiv('Content-Language', 'en-US');
		$view->headTitle('AssList');
		$view->headTitle()->setSeparator(' / ');
    }

	protected function _initFireBugLogger()
	{
		if(!$this->_isDebugEnabled('firebuglogger')) return false;
		if(!$this->hasPluginResource) return false;
		$loggerResource = $this->getPluginResource('log');
		$logger = $loggerResource->getLog();
		
		$fireLogger = new Zend_Log_Writer_Firebug();
		$fireLogger->addFilter(Zend_Log::DEBUG);
		$logger->addWriter($fireLogger);
		return $fireLogger;
		
	}
	
	protected function _initZFDebug()
	{
		if(!$this->_isDebugEnabled('zfdebug')) return false;
		if($this->hasPluginResource('db')) {
			$db = $this->getPluginResource('db')->getDbAdapter();			
		}
		$options = array(
			'plugins' => array('Variables',
		    'Database' => array('adapter' => $db), 
            //'File' => array('basePath' => '/path/to/project'),
            //'Cache' => array('backend' => $cache->getBackend()), 
            'Exception')		
		);
		$debug = new ZFDebug_Controller_Plugin_Debug($options);
	    $this->bootstrap('frontController');
	    $frontController = $this->getResource('frontController');
	    $frontController->registerPlugin($debug);
	}
	
	protected function _isDebugEnabled($mode, $onlyDevelopment = true) {
		$env = $this->_application->getEnvironment();
		if($env != 'development' and $onlyDevelopment === true) {
			return false;
		}
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
       	if($config->development->debugging->$mode->enable == false) return false;
		return true;
	}
}