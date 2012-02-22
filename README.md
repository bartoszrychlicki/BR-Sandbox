Author: Bartosz Rychlicki
E-mail: b@br-design.pl
Date: 14-02-2012

# BR-SANDBOX #
## Brief description ##
BR-SANDBOX is just a simple Zend Framework Project (v. 1.11) with some 
sample code and tools setup for ease of use on later project. 

Im initlializing compontents such as:
* Zend_Log
* ZFDebug
* Layout
* Zend_Test
* Front Controller plugins

Also, I'm making few libraries of my own for later use in the "Br" domain.

For the time I'm writing this, it's only an private, test project to learn Git and ZF bit more.
It could evolve to something more like BR-Framework witch will be extended ZF with some
custom libraries.

## Important changes and functions that You should know ##
### Submodules ###
Thanks to Front Controller Resource S24_Application_Resource application can be structured in submodules fashion. For example:

	application
	- defulat (this is the default module)
	- admin-modules
	- front-modules

`@file library/S24/Application/Resource/Submodules.php`

### Module layouts
By the Front Controller plugin Br_Controller_Action we change the way that layouts are autoloaded. 
Basicly what we do is to search application/layouts folder for a $module.phtml file, and if found then it's assigned to a view, if not, we load the default.phtml file. 

## TODO
@ initialization of Zend_Log or Zend_Db via Action Controller helper rather than init method of Br_Controller_Action