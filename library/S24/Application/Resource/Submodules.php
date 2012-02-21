<?php
/**
 * Studio 24 Application
 * 
 * @category   Studio 24
 * @package    S24_Application
 * @copyright  Copyright (c) 2009-2010 Studio 24 Ltd (www.studio24.net)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @author     Simon R Jones <simon@studio24.net>
 * @version    1.1
*/

/**
 * Sub-module bootstrap resource
 * 
 * Supports groups of sub-modules as per the following
 * examples (in these examples we assume the sub-module
 * folder is called 'admin').
 * 
 * www.domain.com/admin/
 * -> Module name: admin
 * -> Namespace: Admin
 * -> Module folder: application/admin-modules/default/
 * -> Controller namespace: Admin_IndexController
 * -> Resource namespace: Admin_Model_Name     
 * 
 * www.domain.com/admin/user/
 * -> Module name: adminUser 
 * -> Namespace: Admin
 * -> Module folder: application/admin-modules/user/
 * -> Controller namespace: AdminUser_IndexController
 * -> Resource namespace: AdminUser_Model_Name
 * 
 * The default routing supports ID as a third parameter, i.e.
 * 
 * www.domain.com/admin/user/groups/view/5
 * -> Module name: adminUser
 * -> Controller class: AdminUser_GroupsController
 * -> Controller file: application/admin-modules/user/controllers/GroupsController.php
 * -> Action: viewAction()
 * -> ID: 5
 * 
 * Enable in application.ini by setting the sub-module name and module dir path
 * resources.subModules.sub-module-name.directory = APPLICATION_PATH /path/to/sub-modules
 * 
 * Real-world examples would be:
 * resources.subModules.admin.directory = APPLICATION_PATH "/admin-modules"
 * resources.subModules.cms.directory = APPLICATION_PATH "/cms-modules"
 * 
 * This basically sets up the controller directory, routing and an 
 * autoloader for module resources
 * @link http://framework.zend.com/manual/en/zend.loader.autoloader-resource.html
 * 
 * You can disable automatic reation of routing with:
 * resources.subModules.cms.route = false
 * 
 * Please note you cannot have a normal ZF module or controller with the 
 * same name as the sub-module URL. For example, if the sub-module folder name
 * is 'admin' then the following module or controller cannot exist in your
 * application:
 * 
 * application/controllers/AdminController.php
 * application/modules/admin/
 */
class S24_Application_Resource_Submodules extends Zend_Application_Resource_ResourceAbstract {
    
	/**
	 * The URL used to serve the sub-modules
	 * 
	 * @var $_subModulesUrl string
	 */
	protected $_subModulesUrl;
	
    /**
     * The absolute path of the module directory where sub-modules are stored
     * 
     * @var string
     */
    protected $_subModulesDir;
    
    /**
     * List of admin modules
     * 
     * @var array
     */
    protected $_moduleList = array();
    
    /**
     * Initialize sub-modules
     * 
     * Defined by Zend_Application_Resource_Resource
     * 
     * @return void
     * @throws Zend_Application_Resource_Exception
     */
    public function init()
    { 
    	// Dependency tracking
        $bootstrap = $this->getBootstrap();
        $bootstrap->bootstrap('FrontController');
        $front = $bootstrap->getResource('FrontController');
        
        // Set options
        $options = $this->getOptions();
        
        // Loop through resources.subModules.name.modules_dir = /path/to/sub-modules
        foreach ($options as $name => $values) {
        	
        	if (!isset($values['directory'])) {
        		throw new Zend_Application_Resource_Exception(
	            	"You must configure resources.subModules.name.directory to use
	            	sub-modules"
	            );
        	}
        	$enableRoute = true;
        	if (isset($values['route'])) {
        		$enableRoute = (bool) $values['route'];
        	}
        	
        	$this->_subModulesUrl = $name;
        	$this->_subModulesDir = $values['directory'];
        
	        // Check there isn't a normal module with the same module-url name
	        $modules = $front->getControllerDirectory();
	        if (array_key_exists($name, $modules)) {
	            throw new Zend_Application_Resource_Exception(
	            	"Cannot set up sub-modules at " . $this->_subModulesDir .
	                " since you have a normal $name module at " . $modules[$name]
	            );
	        }
	        
	        // Check there isn't a normal controller with the same module-url name
	        $controllerName = ucfirst($name) . 'Controller';
	        $controllerPath = $modules['default'] . '/' . $controllerName . '.php';
	        if (file_exists($controllerPath)) {
	        	throw new Zend_Application_Resource_Exception(
	            	"Cannot set up sub-modules at " . $this->_subModulesDir .
	                " since you have a normal $controllerName controller at " . $controllerPath
	            );
	        }
	        
	        // Register all modules in the sub-module directory
	        try {
	            $dir = new DirectoryIterator($this->_subModulesDir);
	        } catch (Exception $e) {
	            throw new Zend_Application_Resource_Exception(
	            	'Sub-module directory ' . $this->_subModulesDir . ' not readable'
	            );
	        }
	        
	        /**
	         * First setup default module if it exists
	         * 
	         * This is important to ensure that the default module
	         * has its routing setup before other modules
	         */
	        $defaultModule = $this->_subModulesDir . '/default'; 
	        if (is_dir($defaultModule)) {
	       		$this->_setupModule('default', $defaultModule, $front, $enableRoute);
	        }
	        
	        foreach ($dir as $file) {
	        	// Ignore non-folders, the default and SCCS folders
	            if ($file->isDot() || 
	            	!$file->isDir() || 
	            	($file->getFilename() == 'default') ||
	            	preg_match('/^[^a-z]/i', $file->getFilename()) ||
	            	'CVS' == $file->getFilename()
	            ) {
	                continue;
	            }
        		
				// Setup other modules
	            $this->_setupModule($file->getFilename(), $file->getPathname(), $front, $enableRoute);
	        }
	        
        } // end of loop through resources.subModules.name = /path/to/sub-modules

        return $this;
    }
    
    
	/**
	 * Setup module
	 * 
	 * @param string $folderName Folder name (should be lower-case camel caps)
	 * @param string $moduleDirectory Path to module directory
	 */    
    protected function _setupModule ($folderName, $moduleDirectory, Zend_Controller_Front $front, $enableRoute = true)
    {
        if ($folderName == 'default') {
            $moduleName = $this->_subModulesUrl;
        } else {
            $moduleName = $this->_subModulesUrl . ucfirst($folderName);
        }
        $baseDir =  $moduleDirectory;
        $controllerDir = $baseDir . '/' . $front->getModuleControllerDirectoryName();
            
        // Register controllers
        $front->addControllerDirectory($controllerDir, $moduleName);
            
        // Register routing
        if ($enableRoute) {
        	if ($folderName == 'default') {
                // URL format: http://domain.com/sub-module/
                $urlFormat = $this->_subModulesUrl . '/:controller/:action';
            } else {
                // URL format: http://domain.com/sub-module/module/
                $urlFormat = $this->_subModulesUrl . '/' . 
                			 $this->_formatUrlString($folderName) . "/:controller/:action";
            }
            $route = new Zend_Controller_Router_Route($urlFormat . '/*', 
                            array ( 'module'        => $moduleName,
                                    'controller'    => false, 
                                    'action'        => false)
                            );
            $router = $front->getRouter();
            $router->addRoute($moduleName, $route);
            unset($route);
            
            // ID route
            $route = new Zend_Controller_Router_Route($urlFormat . '/:id/*', 
                            array ( 'module'        => $moduleName,
                                    'controller'    => false, 
                                    'action'        => false, 
                                    'id'            => false ),
                            array ( 'id' => '\d+' )
                            );
            $router = $front->getRouter();
            $router->addRoute($moduleName.'Id', $route);
        }
            
        // Autoloader
        $autoloader = new Zend_Application_Module_Autoloader(array(
			'basePath'  => $baseDir,
			'namespace' => ucfirst($moduleName)
        ));
            
        $this->_moduleList[$moduleName] = $baseDir;
    }
    
    
    /**
     * Return module list
     * 
     * @return array List of sub-modules (key = module, value = module path)
     */
    public function getModuleList ()
    {
        return $this->_moduleList;
    }
    
    /**
     * Convert camel caps string to a URL string
     * 
     * Examples:
     * DirectoryName = directory-name
     * directoryName = directory-name
     *
     * @param string $string
     */
    protected function _formatUrlString ($string)
    {
        // Lower-case first character
        $string = strtolower(substr($string, 0, 1)) . substr($string, 1, strlen($string) - 1);
        
        // Convert camel-case string to URL friendly string
        $string = preg_replace('/([A-Z]{1})/', '-$1', $string);
        $string = strtolower($string);
        
        // Remove any erroneous characters
        $string = preg_replace('/[^a-z0-9\-]/', '', $string);
        
        return $string;
    }
    

    
}