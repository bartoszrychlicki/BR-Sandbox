<?php
/**
 * @author Bartosz Rychlicki <b@br-design.pl>
 */
abstract class Br_Controller_Action extends Zend_Controller_Action {

    protected $_log             = null;
    protected $_config          = null;
    protected $_isAjax          = null;
    protected $_db				= null;
	protected $_logger			= null;

    public function init() {

        $request = $this->getRequest();
        $this->_isAjax          = $this->_request->isXmlHttpRequest();
        
		/* Add Zend_Log */
		$loggerResource = $this->getFrontController()
							->getParam('bootstrap')
							->getPluginResource('log');
		$this->_logger = $loggerResource->getLog();
		
        /* Initialize action controller here */
        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
        
        /* Fetching users for menu in the top */
        $user = new Application_Model_DbTable_User();
        $this->view->userslist = $user->fetchAll()->toArray();

        /* Fetching DB adapter */
        $resource = $this->getFrontController()
            ->getParam('bootstrap')
            ->getPluginResource('db');
		$this->_db = $resource->getDbAdapter();
        
        /* Init navigation */
        $this->_initNavigation();

    }
    
    public function back() {
        $back = $_SERVER['HTTP_REFERER'];
        $this->_redirect($back);
    }

    public function preDispatch()
    {


    }

    /**
     * Initialize navigation
     * @access protected
     */
    protected function _initNavigation() {

        $resource           = 'navigation';
        $pages              = null;

        $filename = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'navigation.xml';

        if ( is_readable($filename) ) {
            $pages = new Zend_Config_Xml($filename, 'nav');
        }

        $container = new Zend_Navigation($pages);
        Zend_Registry::set(get_class($container), $container);

        return $container;
    }
}